<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function usersList()
    {
        $users = User::all();
        $users = User::orderBy('verified', 'asc')->get();
        return view('admin.usersList', ['users' => $users]);
    }

    public function verifyUser($userId)
    {
        $user = User::find($userId);
        $user->verified = true;
        $user->save();

        return redirect()->back()->with('succes', 'User has been Verified Successfully');
    }
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success','User has been Deleted Succesfully');
    }
}
