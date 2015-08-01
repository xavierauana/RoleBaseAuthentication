<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 1:45 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Middleware;

    use Illuminate\Contracts\Auth\Guard;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    abstract class UserAuthentication
    {

        protected function isUserAuthenticated()
        {
            if (Auth::guest()) {
                return false;
            }
            return true;
        }

        /**
         * @param $request
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
         */
        protected function AuthenticationFails(Request $request)
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }
    }