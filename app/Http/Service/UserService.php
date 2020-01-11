<?php


namespace App\Http\Service;


use \App\Models\User;


class UserService 
{
    
    public function getCount()
    {
        return User::all()->count();
    }
    
    public function getAll()
    {
        return User::all();
    }

    public function deleteById($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getType($id)
    {
        return User::where('id', $id)->first()->user_type;
    }
    
    public function update($id, $name, $email, $type)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name'=>$name,
            'email'=>$email,
            'user_type'=>$type
        ]);
    }
}
