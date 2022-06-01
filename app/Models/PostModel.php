<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Models\CategoryModel;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function post_category_get($category_id = '') {
        //use one to many
        return $this->hasMany(CategoryModel::class, 'id', 'category_id');

        /* use query - also works good
        $table = 'categories';
        $query = "SELECT category FROM $table WHERE id = :category_id";
        return $category = DB::select($query, ['category_id' => $category_id]);
        */
    }

    public function str_to_url($url) {
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, '-');
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;
    }
}
