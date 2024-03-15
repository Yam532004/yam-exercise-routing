<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // echo 'Middleware Request';
        if (!$this->isLogin()){
            return redirect(route('home'));
        }

        // if($request->is('admin')){
        //     echo 'Admin Area';
        // }


        return $next($request);
    }

    public function isLogin (){
        return true;
    }

}
