<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'auth_name'];


    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'blog_id', 'id');
    }
}
