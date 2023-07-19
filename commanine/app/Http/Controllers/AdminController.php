<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function adminRegist() {
        // session(['admin' => 'administrator']);
        return view('adminRegist');
    }
    public function adminLogin() {
        session(['admin' => 'administrator']);
        return redirect()->route('users.login');
    }
    public function adminLogout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.regist');
    }
    public function adminUsers() {
        $users = DB::table('users')
        // ->dd();
        ->paginate(15);
        return view('adminUser')->with('users',$users);
    }
    public function adminUsersSearch(Request $request){
        $users = DB::table('users')->where('user_email','LIKE','%' . $request->users . '%')->orWhere('user_name','LIKE','%' . $request->users . '%')
        // ->dd();
        ->paginate(15);
        return view('adminUser')->with('users',$users);
    }

}
