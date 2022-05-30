<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostModel;

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
                        'title' => 'required',
                        'file' => 'required|image',
                        'content' => 'required',
                    ]);

                    // we create 'my_disk' in App/Config/filesystem.php
                    // by default files saves in Storage/App/Public
                    $path = $req->file('file')->store('/', ['disk' => 'my_disk']);

                    $data['title'] = $req->input('title');
                    $data['category_id'] = 1;
                    $data['image'] = $path;
                    $data['content'] = $req->input('content');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->insert($data);
                }

                return view('admin.add_post', ['page_title' => 'New post']);
                break;

            case 'edit':
                $post = new PostModel();
                $row = $post->find($id);
                $query = "SELECT category FROM categories WHERE id = :category_id";
                $category = DB::select($query, ['category_id' => $row->category_id]);

                return view('admin.edit_post', [
                    'page_title' => 'Edit post',
                    'row' => $row,
                    'category' => $category
                ]);
                break;

            case 'delete':
                return view('admin.delete_post', ['page_title' => 'Delete post']);
                break;

            default:
                //$post = new PostModel();
                //$rows = $post->all();

                $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id";
                $rows = DB::select($query);

                $data['rows'] = $rows;
                $data['page_title'] = 'posts';

                return view('admin.posts', $data);
                break;
        }
    }

    public function categories(Request $req) {
        return view('admin.admin', ['page_title' => 'categories']);
    }

    public function users(Request $req) {
        return view('admin.admin', ['page_title' => 'users']);
    }

    public function save(Request $req) {
        $validated = $req->validate([
            'name' => 'required | string',
            'email' => 'required | email'
        ]);

        return view('view');
    }
}
