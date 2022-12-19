<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use User;
use Illuminate\Support\Facades\Auth;
class UserAccess
{
    
/*   public function handle(Request $request, Closure $next, $userType)
    {
        if(auth()->user()->type == $userType){
            return $next($request);
        }
        return response()->json(['You do not have permission to access for this page.']);
    }

*/

    public function handle( $request,Closure $next)
    {
        if (auth()->user()->tokenCan('role:customer')) {
            return $next($request);
        }
        return response()->json('Not Authorized', 401);
    }
}
