<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class LoginController extends Controller
{
    function GetLogin(){
        return view('backend.login.login');
    }
    function PostLogin(LoginRequest $r){
        $email=$r->email;
        $password=$r->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            return redirect('admin');
        }
        else{
            return redirect()->back()->with("thongbao","Tài khoản hoặc mật khẩu không chính xác ")->withInput();
        }
    }

}
