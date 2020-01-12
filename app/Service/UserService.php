<?php


namespace App\Service;

use \App\Models\User;
use Illuminate\Support\Arr;

class UserService 
{
    
    public function getCount()
    {
        return User::all()->count() - 1;
    }
    
    public function getAll()
    {
        $users = User::where('user_type', '<>', User::ADMIN_TYPE)->get();
        
        return $users;
    }

    public function deleteById($id)
    {

        $users = User::all();
        $user = $users->find($id);

        if($user == null)
        {
            return false;
        }

        $user->delete();

        return true;
    }

    public function getType($id)
    {
        $user = User::findOrFail($id);
        return $user->user_type;
    }
    
    public function update($user_info)
    {
        $users = User::all();
        $user = $users->find($user_info['id']);

        if($user == null)
        {
            return false;
        }

        $user->update([
            'name'=>$user_info['name'],
            'email'=>$user_info['email'],
            'user_type'=>$user_info['type']
        ]);

        return true;
    }
}
