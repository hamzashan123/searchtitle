<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\User;
use App\Documents;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $Administrator = 'Admin';
        $Users = 'User';
        $usersAdmin = User::whereHas('roles', function ($query) use ($Administrator){
            $query->where('title',$Administrator);
        })->count();
        if(Auth::user()->roles[0]->title == 'User'){
        $users = User::whereHas('roles', function ($query) use ($Users){
            $query->where('register_by',Auth::user()->id)->where('title',$Users);
        })->count();
        $documents = Documents::where('user_id',Auth::user()->id)->count();
        }else{
            $users = User::whereHas('roles', function ($query) use ($Users){
                $query->where('title',$Users);
            })->count();
            $documents = Documents::count();
        }

        
        return view('home',compact('usersAdmin','users','documents'));
    }
}
