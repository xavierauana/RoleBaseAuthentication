<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 6:22 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Contracts;


    use Illuminate\Http\Request;

    interface RoleInterface
    {
        public function permissions();

        public function updatePermissions($permissions);

        public function updateRoleRecord(Request $request);
        public function createRoleRecord(Request $request);

        public function save();
    }