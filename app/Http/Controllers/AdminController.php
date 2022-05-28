<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(Request $req) {
        return view('admin.admin', ['page_title' => 'dashboard']);
    }

    public function posts(Request $req) {
        return view('admin.posts', ['page_title' => 'posts']);
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
