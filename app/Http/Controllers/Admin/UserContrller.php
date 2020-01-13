<?php

namespace App\Http\Controllers\Admin;

use \App\Service\AdminService as adminService;
use \App\Service\UserService as userService;
use \App\Service\BlogService as blogService;
use \App\Service\CommentService as commentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserContrller extends Controller
{
    
    public function user()
    {
        $adminService = new adminService();
        $userService = new userService();
    
        $adminService->abortAdmin(auth()->id());

        
        $users = $userService->getAll();
        
        return view('admin.user.user', [
            'users' => $users
        ]);
    }

    public function userDelete(Request $request)
    {
        $userService = new userService();
        $blogService = new blogService();
    
        if(!$userService->deleteById($request->select_id))
        {
            return back()->with('error', 'User Deleted Failed');
        }

        return back()->with('success', 'User Deleted Successfully');
    }

    public function userUpdate(Request $request)
    {
        $userService = new userService();
        $blogService = new blogService();
        $commentService = new commentService();

        $userinfo = [
            'id'=>$request->edit_id,
            'name'=>$request->user_name,
            'email'=>$request->user_email,
            'type'=>$request->user_type
        ];

        $bloguser = [
            'id'=>$request->edit_id,
            'name'=>$request->user_name
        ];

        if(!$userService->update($userinfo))
        {
            return back()->with('error','User Update Failed');
        }
        if(!$blogService->updateAuthName($bloguser))
        {
            return back()->with('error','Blog Auth Name Update Failed');
        }

        if(!$commentService->updateAuthName($bloguser))
        {
            return back()->with('error','Comment Auth Name Update Failed');
        }

        return back()->with('success', 'User Update Successfully');
    }
}
