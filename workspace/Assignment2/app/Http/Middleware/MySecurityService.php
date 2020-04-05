<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Utility\MyLoggerMono;

class MySecurityService
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
        $path = $request->path;
        MyLoggerMono::info("Entering my Security Service in handle() at path " . $path);
        
        $secureCheck = true;
        if($request->is('/') || $request->is('loginBlade') || $request->is('') || $request->is('doLoginBlade') 
            || $request->is('usersrest') || $request->is('usersrest/*') || $request->is('loggingService'))
        {
            $secureCheck = FALSE;
            MyLoggerMono::info($secureCheck ? "Security Middleware in handle() Needs Security" : 
                "Security Middleware in handle() No Needs Security");
        }
        
        if($secureCheck)
        {
            MyLoggerMono::info("Leaveing My Security Middlewaer in handel doing a redirect back to login");
            return redirect('/loginBlade');
        }
        
        return $next($request);
    }
}
