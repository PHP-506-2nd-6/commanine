<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
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
        // session(['admin' => 'administrator']);
        return redirect()->route('users.login')->with('flg', 1);
    }
    public function adminLoginPost(Request $request) {
        $error = '아이디와 비밀번호를 확인해주세요.';
            $admin = Admins::where('admin_id', $request->email)->first();
            // $user가 존재하지 않거나, 비밀번호가 일치하지 않을 경우
            if(!$admin || !($request->password === $admin->admin_pw)){
                return redirect()
                        ->back()
                        ->with('error',$error);
            }
            Auth::login($admin);
            session($admin->only('id','admin_id')); 
            // session()->forget('admin');
            return redirect()->intended(route('admin.regist'));
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

    public function adminHanoks(){
        // 쿼리
        // SELECT
        // id,
        // hanok_name,
        // hanok_img1,
        // hanok_addr
        // FROM hanoks han

        // ORDER BY han.hanok_name;
        $hanoks = DB::table('hanoks')->select('id','hanok_name','hanok_addr','hanok_img1')->paginate(15);
        return view('adminHanok')->with('hanoks',$hanoks);
    }
}
