<?php

namespace App\Http\Controllers\Admin;

use \App\Service\AdminService as adminService;
use \App\Service\BlogService as blogService;
use \App\Service\CommentService as commentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    
    public function blog()
    {
        $adminService = new adminService();
        $blogService = new blogService();
    
        $adminService->abortAdmin(auth()->id());

        $blogs = $blogService->getAll();

        return view('admin.blog.blog', [
            'blogs' => $blogs
        ]);
    }

    public function blogDelete(Request $request)
    {
        $blogService = new blogService();
        $commentService = new commentService();
    
        if(!$blogService->deleteById($request->select_id))
        {
            return back()->with('error', 'Blog Deleted Failed');
        }
        return back()->with('success', 'Blog Deleted Successfully');
    }

    public function blogUpdate(Request $request)
    {
        $blogService = new blogService();
        $commentService = new commentService();
        $blog = [
            'id'=>$request->edit_id,
            'title'=>$request->title,
            'body'=>$request->body
        ];
        $comment = [
            'id'=>$request->edit_id,
            'title'=>$request->title
        ];

        if(!$blogService->update( $blog ))
        {
            return back()->with('error', 'Blog Update Failed');
        }
        if(!$commentService->changeBlogTitle( $comment ))
        {
            return back()->with('error', 'Comment Blog Title Update Failed');
        }
        
        return back()->with('success', 'Blog Update Successfully');
    }
}
