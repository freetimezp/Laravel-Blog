<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\PostModel;
use App\Models\CategoryModel;
use App\Models\ImageModel;

class AdminController extends Controller
{
    //
    public function index(Request $req) {
        return view('admin.admin', ['page_title' => 'dashboard']);
    }

    public function posts(Request $req, $type = '', $id = '') {
        switch($type) {
            case 'add':
                if($req->method() == 'POST') {
                    $post = new PostModel();

                    $validated = $req->validate([
                        'title' => 'required|string',
                        'file' => 'required|image',
                        'category_id' => 'required',
                        'content' => 'required'
                    ]);

                    // we create 'my_disk' in App/Config/filesystem.php
                    // by default files saves in Storage/App/Public
                    $path = $req->file('file')->store('/', ['disk' => 'my_disk']);

                    $data['title'] = $req->input('title');
                    $data['image'] = $path;
                    $data['category_id'] = $req->input('category_id');
                    $data['content'] = $req->input('content');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $data['slag'] = $post->str_to_url($data['title']);

                    $post->insert($data);
                    return redirect('admin/posts');

                }

                $query = "SELECT * FROM categories";
                $categories = DB::select($query);

                return view('admin.add_post', [
                    'page_title' => 'New post',
                    'categories' => $categories
                ]);
                break;

            case 'edit':
                $post = new PostModel();
                $row = $post->find($id);

                //use one to many
                $category = $row->post_category_get()->first();

                //use query
                //$category = $post->post_category_get($row->category_id);

                if($req->method() == 'POST') {
                    $validated = $req->validate([
                        'title' => 'required',
                        'file' => 'image',
                        'content' => 'required',
                    ]);

                    // we create 'my_disk' in App/Config/filesystem.php
                    // by default files saves in Storage/App/Public
                    if($req->file('file')) {
                        //delete old image
                        $oldrow = $post->find($id);
                        if(file_exists('uploads/' . $oldrow->image)) {
                            unlink('uploads/' . $oldrow->image);
                        }

                        //save new image
                        $path = $req->file('file')->store('/', ['disk' => 'my_disk']);
                        $data['image'] = $path;
                    }

                    $data['title'] = $req->input('title');
                    $data['category_id'] = $req->input('category_id');
                    $data['content'] = $req->input('content');
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->where('id', $id)->update($data);

                    return redirect('admin/posts');
                }

                $row = $post->find($id);

                return view('admin.edit_post', [
                    'page_title' => 'Edit post',
                    'row' => $row,
                    'category' => $category
                ]);
                break;

            case 'delete':
                $post = new PostModel();
                $row = $post->find($id);

                //use one to many
                $category = $row->post_category_get()->first();

                //use query
                //$category = $post->post_category_get($row->category_id);

                if($req->method() == 'POST') {
                    //delete image
                    $oldrow = $post->find($id);
                    if(file_exists('uploads/' . $oldrow->image)) {
                        unlink('uploads/' . $oldrow->image);
                    }

                    $row->delete();
                    return redirect('admin/posts');
                }

                return view('admin.delete_post', [
                    'page_title' => 'Delete post',
                    'row' => $row,
                    'category' => $category
                ]);

                break;

            default:
                //$post = new PostModel();
                //$rows = $post->all();

                $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id";

                //crop image
                $img = new ImageModel();
                $rows = DB::select($query);

                foreach ($rows as $key => $row) {
                    $rows[$key]->image = $img->get_thumb('uploads/' . $row->image);
                }

                $data['rows'] = $rows;
                $data['page_title'] = 'Posts page';

                return view('admin.posts', $data);
                break;
        }
    }

    public function categories(Request $req, $type = '', $id = '') {
        switch ($type) {
            case 'add':
                if($req->method() == 'POST') {
                    $category = new CategoryModel();

                    $validated = $req->validate([
                        'category' => 'required|string',
                    ]);

                    $data['category'] = $req->input('category');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $category->insert($data);

                    return redirect('admin/categories');
                }

                return view('admin.add_category', ['page_title' => 'New category']);
                break;
            case 'edit':
                $category = new CategoryModel();
                $row = $category->find($id);

                if($req->method() == 'POST') {
                    $validated = $req->validate([
                        'category' => 'required|string',
                    ]);

                    $data['category'] = $req->input('category');
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $category->where('id', $id)->update($data);

                    return redirect('admin/categories');
                }

                $row = $category->find($id);

                return view('admin.edit_category', [
                    'page_title' => 'Edit category',
                    'row' => $row,
                ]);
                break;

            case 'delete':
                $category = new CategoryModel();
                $row = $category->find($id);

                if($req->method() == 'POST') {
                    $row->delete();
                    return redirect('admin/categories');
                }

                return view('admin.delete_category', [
                    'page_title' => 'Delete category',
                    'row' => $row
                ]);

                break;

            default:
                $category = new CategoryModel();
                $rows = $category->all();

                $data['rows'] = $rows;
                $data['page_title'] = 'Categories page';

                return view('admin.categories', $data);
                break;
        }
    }

    public function users(Request $req, $type = '', $id = '') {
        switch ($type) {
            case 'edit':
                $user = new User();
                $row = $user->find($id);

                if($req->method() == 'POST') {
                    $validated = $req->validate([
                        'name' => 'required|string',
                        'email' => 'required|email',
                    ]);

                    $data['name'] = $req->input('name');
                    $data['email'] = $req->input('email');
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    if(!empty($req->input('password'))) {
                        $data['password'] = Hash::make($req->input('password'));
                    }

                    $user->where('id', $id)->update($data);

                    return redirect('admin/users');
                }

                $row = $user->find($id);

                return view('admin.edit_user', [
                    'page_title' => 'Edit user',
                    'row' => $row
                ]);
                break;

            case 'delete':
                $user = new User();
                $row = $user->find($id);

                if($req->method() == 'POST') {
                    if($row->id != 1) {
                        $row->delete();
                    }

                    return redirect('admin/users');
                }

                return view('admin.delete_user', [
                    'page_title' => 'Delete user',
                    'row' => $row
                ]);

                break;

            default:
                $user = new User();
                $rows = $user->all();

                $data['rows'] = $rows;
                $data['page_title'] = 'Users page';

                return view('admin.users', $data);
                break;
        }


    }

    public function save(Request $req) {
        $validated = $req->validate([
            'name' => 'required | string',
            'email' => 'required | email'
        ]);

        return view('view');
    }
}
