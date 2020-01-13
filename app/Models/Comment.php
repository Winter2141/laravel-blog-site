<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title', 'body', 'auth_name', 'blog_id', 'auth_id'];

    public function blog() {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }

}
