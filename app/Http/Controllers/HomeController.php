<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\ImageModel;

class HomeController extends Controller
{
    public function index(Request $req) {
        //print_r($req->input('find'));die;
        if($req->input('find')) {
            $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id
                        WHERE title LIKE :title";

            $title = "%" . $req->input('find') . "%";
            $rows = DB::select($query, ['title' => $title]);
        }else{
            $query = "SELECT posts.*, categories.category FROM posts JOIN categories ON posts.category_id = categories.id";
            $rows = DB::select($query);
        }

        $img = new ImageModel();

        //crop image
        foreach ($rows as $key => $row) {
            $rows[$key]->image = $img->get_thumb_post('uploads/' . $row->image);
        }

        $data['rows'] = $rows;
        $data['page_title'] = 'Home page';

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
