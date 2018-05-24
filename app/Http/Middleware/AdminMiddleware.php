<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware{

    public function handle($request, Closure $next){

        if($request->session()->has('username')){
            if($request->session()->get('role')=='admin'){
                return $next($request);
            }
        }
        else{
            return redirect('/');
        }

    }
}
