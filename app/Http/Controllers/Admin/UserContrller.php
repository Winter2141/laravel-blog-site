<?php

namespace App\Http\Controllers\Admin;

use \App\Service\AdminService as adminService;
use \App\Service\UserService as userService;
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
    
        if($userService->deleteById($request->select_id))
        {
            return back()->with('success', 'User Deleted Successfully');
        }

        return back()->with('error', 'User Deleted Failed');
    }

    public function userUpdate(Request $request)
    {
        $userService = new userService();
        $userinfo = [
            'id'=>$request->edit_id,
            'name'=>$request->user_name,
            'email'=>$request->user_email,
            'type'=>$request->user_type
        ];

        $result = $userService->update($userinfo);

        if($result == 1)
        {
            return back()->with('success', 'User Update Successfully');
        }
        else {
            return back()->with('error','User Update Failed');
        }
    }
}
