<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ResetGlobalUniqueId
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
        Session::put('unique_id', 1); // Reset unique id used by tags
        Log::info('unique_id reset to: '.Session::get('unique_id'));
        return $next($request);
    }
}
