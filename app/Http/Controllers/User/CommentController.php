<?php

namespace App\Http\Controllers\User;
use \App\Service\CommentService as commentService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    
    public function store($blog_id)
    {
        $commentService = new commentService();
    

        $result = $commentService->commentStore($blog_id);

        if ($result) {
            return redirect()->route('user.blog.show', ['blog' => $blog_id])->with('success', 'Message Send Successfully');
        }
        else {
            return redirect()->route('user.blog.show', ['blog' => $blog_id])->with('error', 'Message send failed');
        }
    }

    public function delete($comment_id)
    {
        $commentService = new commentService();
    
        if($commentService->delete($comment_id))
        {
            return back()->with('success', 'Comment Deleted Successfully');
        }

        return back()->with('error', 'Comment Deleted Failed');
    }

    public function commentDelete(Request $request)
    {
        $commentService = new commentService();
    
        if($commentService->deleteById($request->select_id))
        {
            return back()->with('success', 'Comment Deleted Successfully');
        }
        return back()->with('error', 'Comment Deleted Failed');
    }
}
