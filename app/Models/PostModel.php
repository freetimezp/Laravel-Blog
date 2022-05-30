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
}
