<?php

namespace App\Http\Controllers;

use App\Models\PageModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ImageModel;

class HomeController extends Controller
{
    public function index(Request $req) {
        $limit = 8;
        $page = $req->input('page') ? (int)$req->input('page') : 1;
        $offset = ($page - 1) * $limit;

        $page_class = new PageModel();
        $links = $page_class->make_links($req->fullUrlWithQuery(['page' => $page]), $page);

        $query = "SELECT * FROM categories";
        $categories = DB::select($query);

        if($req->input('find')) {
            $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id
                        WHERE title LIKE :title LIMIT $limit OFFSET $offset";

            $title = "%" . $req->input('find') . "%";
            $rows = DB::select($query, ['title' => $title]);
        }elseif($req->input('cat')) {
            $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id
                        WHERE categories.id = :id LIMIT $limit OFFSET $offset";

            $id = $req->input('cat');
            $rows = DB::select($query, ['id' => $id]);
        }else{
            $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id
                        LIMIT $limit OFFSET $offset";
            $rows = DB::select($query);
        }

        $img = new ImageModel();

        //crop image
        foreach ($rows as $key => $row) {
            $rows[$key]->image = $img->get_thumb_post('uploads/' . $row->image);
        }

        $data['rows'] = $rows;
        $data['page_title'] = 'Home page';
        $data['links'] = $links;
        $data['categories'] = $categories;

        return view('index', $data);
    }

    public function save(Request $req) {
        $validated = $req->validate([
            'name' => 'required | string',
            'email' => 'required | email'
        ]);

        return view('index');
    }
}
