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
        if(auth()->user()->role != "admin"|| auth()->user()->role != "moderator" ){

            return abort(403);
            // to return to a website
            //  return redirect()->route('/you are-customer');
        }

        return $next($request);
    }
}
