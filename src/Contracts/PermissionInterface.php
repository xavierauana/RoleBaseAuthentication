<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 6:23 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Contracts;


    interface PermissionInterface
    {
        public function roles();
        public function save();
    }