<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginpost(Request $requset){
        
    }
    public function regist(){
        return view('regist');
    }
    public function registpost(Request $requset){
        
    }
    public function findPw(){
        return view('findpw');
    }
    public function findPwpost(Request $requset){
        
    }
    public function findId(){
        return view('findid');
    }
    public function findIdpost(Request $requset){
        
    }
}
