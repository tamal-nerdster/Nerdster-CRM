<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'admin'){
            return $next($request);
        }else{
            return redirect('dashboard')->with('error','Unauthorized access');
        }
    }
}
