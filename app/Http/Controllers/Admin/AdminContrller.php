<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use \App\Service\AdminService as adminService;
use \App\Service\BlogService as blogService;
use \App\Service\UserService as userService;
use \App\Service\CommentService as commentService;

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
        $comment_count = $commentService->getCount($blogs);

        return view('admin.dashboard.index', [
            'user_count'=>$user_count,
            'blogs'=>$blogs,
            'comment_count'=>$comment_count
        ]);
    }

}
