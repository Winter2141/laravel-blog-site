<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use \App\Http\Service\AdminService as adminService;
use \App\Http\Service\BlogService as blogService;
use \App\Http\Service\UserService as userService;
use \App\Http\Service\CommentService as commentService;


use Illuminate\Http\Request;



class AdminContrller extends Controller
{

    public function index()
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $adminService->abortAdmin(auth()->id());

        $user_count = $userService->getCount();
        $blogs = $blogService->getAssoc();
        $comment_count = $commentService->getCount();


        return view('/admin/user/index', [
            'user_count'=>$user_count,
            'blogs'=>$blogs,
            'comment_count'=>$comment_count
        ]);
    }


    public function user()
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $adminService->abortAdmin(auth()->id());

        
        $users = $userService->getAll();
        
        return view('/admin/user/user', [
            'users' => $users
        ]);
    }

    public function blog()
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $adminService->abortAdmin(auth()->id());


        $blogs = $blogService->getAll();

        return view('/admin/blog/blog', [
            'blogs' => $blogs
        ]);
    }

    public function comment($id)
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $adminService->abortAdmin(auth()->id());

        $current_blog = $blogService->getById($id);

        

        $comments = $commentService->getByBlogId($id);

        return view('/admin/blog/comment', [
            'comments' => $comments,
            'blog_title' => $current_blog->title
        ]);
    }

    public function userDelete(Request $request)
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $userService->deleteById($request->select_id);

        return back()->with('success', 'User Deleted Successfully');
    }

    public function blogDelete(Request $request)
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $blogService->deleteById($request->select_id);

        return back()->with('success', 'Blog Deleted Successfully');
    }

    public function commentDelete(Request $request)
    {
        $adminService = new adminService();
        $blogService = new blogService();
        $userService = new userService();
        $commentService = new commentService();
    
        $commentService->deleteById($request->select_id);

        return back()->with('success', 'Comment Deleted Successfully');
    }


    public function userUpdate(Request $request)
    {
        $userService = new userService();

        $result = $userService->update($request->edit_id, $request->user_name, $request->user_email, $request->user_type);

        if($result == 1)
        {
            return back()->with('success', 'User Update Successfully');
        }
        else {
            return back()->with('error','User Update Failed');
        }
    }

    public function blogUpdate(Request $request)
    {
        $blogService = new blogService();
        $commentService = new commentService();

        $blogService->update($request->edit_id, $request->title, $request->body);
        $commentService->changeBlogTitle($request->edit_id, $request->title);

        return back()->with('success', 'Blog Update Successfully');
    }

    public function commentUpdate(Request $request)
    {
        $commentService = new commentService();

        $retult = $commentService->update($request->edit_id, $request->body);

        return back()->with('success', 'Comment Update Successfully');
    }

    


}
