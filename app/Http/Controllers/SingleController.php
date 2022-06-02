<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    //
    public function index(Request $req, $slag = '') {
        $query = "SELECT * FROM categories";
        $rows = DB::select($query);

        $query = "SELECT * FROM posts WHERE slag = :slag";
        $row = DB::select($query, ['slag' => $slag]);
        if($row) {
            $query = "SELECT * FROM categories WHERE id = :id";
            $category = DB::select($query, ['id' => $row[0]->category_id]);
            $data['category'] = $category[0];
            $data['row'] = $row[0];
        }

        $data['rows'] = $rows;

        return view('single', $data);
    }

    public function save(Request $req) {
        $validated = $req->validate([
            'name' => 'required | string',
            'email' => 'required | email'
        ]);

        return view('single');
    }
}
