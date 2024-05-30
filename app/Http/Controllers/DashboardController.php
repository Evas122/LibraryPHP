<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype=Auth()->user()->role;

            if($usertype=='student')
            {
                return view('student.dashboard');
            }
            else if($usertype=='admin')
            {
                return view('admin.dashboard');
            }
            else
            {
                return redirect()->back();
            }
        }

    }
}
