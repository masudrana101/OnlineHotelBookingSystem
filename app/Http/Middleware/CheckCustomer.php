<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      if(Auth::user()){
        if (strtolower(Auth::user()->type) == "customer" && strtolower(Auth::user()->status) == "active"){
          return $next($request);
        }
      }
      Auth::logout();
      return redirect()->route('login');
    }
}
