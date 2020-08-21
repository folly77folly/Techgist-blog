<?php

namespace App\Http\Middleware;

use Closure;
use App\StaticCollections\Role;

class AdminMiddleware
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
        $user = $request->user();
        if($user->role->id === Role::$ADMIN){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
