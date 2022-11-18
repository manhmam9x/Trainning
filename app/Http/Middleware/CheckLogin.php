<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();

            // kiểm tra trạng thái hoạt động của account
            if($user->is_active == 1)
            {
                return $next($request);
            }else
            {
                //return redirect()->route('admin.login');
                return Redirect::back()->withErrors(['msg' => 'Tài Khoản chưa được kích hoạt']);
            }
        }
    }
}
