<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
