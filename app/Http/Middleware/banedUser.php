<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class banedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->is_baned == 1){
            Auth::logout();
            return redirect()->route('login')->with('alert',['icon'=>'error','title'=>'You are baned.','message'=>'Please contact to admin.']);
        }
        return $next($request);
    }
}
