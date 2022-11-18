<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->route('admin.index');
        }else{
            return view('login.index');
        }
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Bạn cần nhập tên đăng nhập',
            'password.required' => 'Bạn cần nhập mật khẩu',
            'password.min' => 'Bạn cần nhập mật khẩu tối thiểu 6 kí tự'
        ]);

        $dataLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $checkLogin = Auth::attempt($dataLogin, $request->has('remember'));

        // Kiểm tra đăng nhập
        if($checkLogin){
            return redirect()->route('admin.index');
        }else
        {
            return Redirect::back()->withErrors(['msg' => 'Tài Khoản hoặc Mật Khẩu chưa chính xác']);
        }
    }

    public function Logout(){
        // Xử lý đăng xuất : xóa sạch session và cookie
        Auth::logout();

        // Xóa xong chuyền về trang login
        return redirect()->route('admin.login');
    }

   public function index(){
       if(Auth::check()){
           return view('index');
       }else{
           return redirect()->route('admin.login');
       }
    }
}
