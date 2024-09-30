<?php

namespace App\Http\Middleware\custom_middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->user_type=="customer"){

            return abort(403);
            // ti return to a website
        //  return redirect()->route('/you are-customer');
        }
        // if(!auth()->user()){
        //     return redirect()->route('login');
        //    }
        return $next($request);
    }
}
