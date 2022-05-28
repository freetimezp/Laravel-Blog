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

    public function posts(Request $req, $type = '') {
        if($type) {
            switch($type) {
                case 'add':
                    if($req->method() == 'POST') {
                        // we create 'my_disk' in App/Config/filesystem.php
                        // by default files saves in Storage/App/Public
                        $req->file('file')->store('/', ['disk' => 'my_disk']);
                    }

                    return view('admin.add_post', ['page_title' => 'New post']);
                    break;

                case 'edit':
                    return view('admin.edit_post', ['page_title' => 'Edit post']);
                    break;

                case 'delete':
                    return view('admin.delete_post', ['page_title' => 'Delete post']);
                    break;

                default:
                    return view('admin.posts', ['page_title' => 'posts']);
                    break;
            }
        }else{
            return view('admin.posts', ['page_title' => 'posts']);
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
