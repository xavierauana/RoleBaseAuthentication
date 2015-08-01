<?php

    namespace Xavierau\RoleBaseAuthentication\Middleware;

use Closure;

class PermissionMiddleware extends UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $object, $action)
    {
        if($this->isUserAuthenticated()){
            if($request->user()->canDo($object, $action)){
                return $next($request);
            }
        }
        return $this->AuthenticationFails($request);
    }
}
