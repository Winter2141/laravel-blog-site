<?php

namespace App\Service;

use \App\Models\Comment;
use \App\Models\User;
use Illuminate\Http\Request;

class CommentService  
{
    
    public function commentStore($blog_id)
    {
        request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $values = request(['title', 'body']);
        $user_id = auth()->id();
        $data=User::where('id', $user_id)->first()->name;

        $values['auth_name'] = $data;
        $values['blog_id'] = $blog_id;
        $values['auth_id'] = $user_id;
        
        $comment = Comment::create($values);

        if ($comment != null) {
            return true;
        }
        return false;
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
    }

    public function getByBlogId($blog_id)        
    {
        if($blog_id == null)
        {
            return null;
        }

        return Comment::latest()->where('blog_id', $blog_id)->get();
    }

    public function deleteById($id)
    {
        $comments = Comment::all();
        $comment = $comments->find($id);

        if($comment == null)
        {
            return false;
        }

        $comment->delete();

        return true;
    }

    public function deleteByBlogId($id)
    {
        if($id == null)
        {
            return false;
        }

        $comments = Comment::where('blog_id', $id)->get();

        if($comments == null)
        {
            return false;
        }

        foreach ($comments as $comment) {
            $comment->delete();
        }

        return true;
    }

    public function getCount($blogs)
    {
        $count = 0;

        if ($blogs->count() == 0) {
            return 0;
        }

        return Comment::leftJoin('blogs', function($join) {

            $join->on('comments.blog_id', '=', 'blogs.id');

        })

        ->whereNotNull('blogs.id')

        ->count();

    }

    public function getAll()
    {
        return Comment::all();
    }

    public function update($comment_info)
    {
        $comments = Comment::all();
        $comment = $comments->find($comment_info['id']);

        if($comment == null)
        {
            return false;
        }

        $comment->update([
            'body' => $comment_info['body']
        ]);

        return true;
    }

    public function changeBlogTitle($comment_info)
    {
        if($comment_info['id'] == null)
        {
            return false;
        }

        $comments = Comment::where('blog_id', $comment_info['id'])->get();

        if($comments == null)
        {
            return false;
        }

        foreach ($comments as $comment) {
            $comment->update([
                'title'=>$comment_info['title']
            ]);
        }

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
        $comments = Comment::where('auth_id', $id)->get();

        if($comments == null)
        {
            return false;
        }

        foreach ($comments as $comment) {
            $comment->update([
                'auth_name'=>$name
            ]);
        }
        return true;
    }
}
