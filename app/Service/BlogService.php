<?php

namespace App\Service;

use \App\Models\Blog;
use \App\Models\User;

use Illuminate\Http\Request;

class BlogService
{
    public function getAssoc()
    {
        return Blog::latest()->get();
    }

    public function getAll()
    {
        return Blog::all();
    }
    
    public function deleteById($id)
    {
        $blogs = Blog::all();
        $blog = $blogs->find($id);
        
        if ($blog == null) {
            return false;
        }
        $blog->comments()->delete();
        $blog->delete();

        return true;
    }

    public function store($user_id)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $values = request(['title', 'body']);
        $values['user_id'] = $user_id;
        $data=User::where('id', $user_id)->first()->name;
        $values['auth_name'] = $data;
        
        $blog = Blog::create($values);

        if($blog != null)
        {
            return true;
        }

        return false;
    }

    public function getById($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog;
    }

    public function update($blog_info)
    {
        $blogs = Blog::all();
        $blog = $blogs->find($blog_info['id']);

        if ($blog == null) {
            return false;
        }

        $result = $blog->update([
            'title' => $blog_info['title'],
            'body' => $blog_info['body']
        ]);

        return true;
    }

    public function updateAuthName($user_info)
    {
        $name = $user_info['name'];
        $id = $user_info['id'];

        if($name == null || $id == null)
        {
            return false;
        }
        $blogs = Blog::where('user_id', $id)->get();

        if($blogs == null)
        {
            return false;
        }

        foreach ($blogs as $blog) {
            $blog->update([
                'auth_name'=>$name
            ]);
        }
        return true;
    }
}



