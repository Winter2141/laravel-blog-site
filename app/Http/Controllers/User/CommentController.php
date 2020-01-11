<?php

namespace App\Http\Controllers\User;
use \App\Http\Service\CommentService as commentService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    

    public function store($blog_id)
    {
        $commentService = new commentService();
    

        $result = $commentService->commentStore($blog_id, auth()->id());

        if ($result == 1) {
            return redirect()->route('user.blog.show', ['blog' => $blog_id])->with('success', 'Message Send Successfully');
        }
        else {
            return redirect()->route('user.blog.show', ['blog' => $blog_id])->with('error', 'Message send failed');
        }

    }

    public function delete($comment_id)
    {
        $commentService = new commentService();
    
        $commentService->delete($comment_id);

        return back()->with('success', 'Comment Deleted Successfully');
    }
}
