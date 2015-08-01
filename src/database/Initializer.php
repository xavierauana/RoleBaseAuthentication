<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 6:49 PM
     */

    namespace Xavierau\RoleBaseAuthentication\database;


    use Illuminate\Support\Facades\App;
    use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;
    use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

    class Initializer
    {
        private $permission;
        private $role;

        /**
         * Initializer constructor.
         *
         * @param $permission
         * @param $role
         */
        public function __construct()
        {
            $this->permission = App::make(PermissionInterface::class);
            $this->role       = App::make(RoleInterface::class);
        }


        public function initialize()
        {
            $permissionIds = $this->permission->lists('id')->toArray();
            $developer = $this->role->whereCode('developer')->first();
            $developer->permissions()->sync($permissionIds);
        }
    }