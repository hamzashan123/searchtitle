<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\User;
use App\Documents;

class HomeController
{
    public function index()
    {
        $Administrator = 'Admin';
        $Users = 'User';
        $usersAdmin = User::whereHas('roles', function ($query) use ($Administrator){
            $query->where('title',$Administrator);
        })->count();
        $users = User::whereHas('roles', function ($query) use ($Users){
            $query->where('title',$Users);
        })->count();
        $documents = Documents::count();

        
        return view('home',compact('usersAdmin','users','documents'));
    }
}
