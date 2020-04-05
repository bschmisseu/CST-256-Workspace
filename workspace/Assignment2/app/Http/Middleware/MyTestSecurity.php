<?php

namespace App\Http\Middleware;

use App\Services\Utility\MyLoggerMono;
use Illuminate\Support\Facades\Cache;
use Closure;

class MyTestSecurity
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
        MyLoggerMono::info("Entering MyTestSecurity@handel()");
        
        if($request->userName != null)
        {
            $value = Cache::store("file")->get("mydata");
            if($value == null)
            {
                MyLoggerMono::info("Caching first time Username for " . $request->userName);
                Cache::store("file")->put("mydata", $request->userName, 1);
            }
        }
        
        else
        {
            $value = Cache::store("file")->get("mydata");
            
            if($value != null)
            {
                MyLoggerMono::info("Getting username from cache " . $value);
            }
            
            else
            {
                MyLoggerMono::info("Could not get Username from cache (data is older than a minute)");
            }
        }
        
        return $next($request);
    }
}
