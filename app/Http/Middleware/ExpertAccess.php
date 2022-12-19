<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use User;
use Illuminate\Support\Facades\Auth;
class ExpertAccess
{
    public function handle($request, Closure $next )
    {
        if (auth()->user()->tokenCan('role:driver')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);

    }
}

