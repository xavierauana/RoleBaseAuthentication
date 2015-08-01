<?php

    namespace Xavierau\RoleBaseAuthentication\Middleware;

use Closure;

class RoleMiddleware extends UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if($this->isUserAuthenticated()){
            if($request->user()->hasRole($role)){
                return $next($request);
            }
        }
        return $this->AuthenticationFails($request);
    }


}
