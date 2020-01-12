<?php

namespace App\Http\Controllers\Admin;

use \App\Service\AdminService as adminService;
use \App\Service\BlogService as blogService;
use \App\Service\CommentService as commentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function comment($id)
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $commentService = new commentService();
    
        $adminService->abortAdmin(auth()->id());

        $current_blog = $blogService->getById($id);

        $comments = $commentService->getByBlogId($id);

        return view('admin.blog.comment', [
            'comments' => $comments,
            'blog_title' => $current_blog->title
        ]);
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

    public function commentUpdate(Request $request)
    {
        $commentService = new commentService();
        $comment = [
            'id'=>$request->edit_id,
            'body'=>$request->body
        ];

        $retult = $commentService->update( $comment );

        if($retult)
        {
            return back()->with('success', 'Comment Update Successfully');
        }

        return back()->with('error', 'Comment Update Failed');
    }
}
