<?php

namespace App\Service;

use \App\Models\User;

class AdminService
{
    public function abortAdmin($user_id)
    {
        $user = User::findOrFail($user_id);
        $user_type = $user->user_type;
        
        if($user_type != User::ADMIN_TYPE)
        {
            abort(403);
        }
    }
}
