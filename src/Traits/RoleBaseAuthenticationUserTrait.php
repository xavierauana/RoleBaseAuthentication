<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 6:31 PM
     */

    namespace Xavierau\RoleBaseAuthentication\Traits;


    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\DB;
    use ReflectionClass;
    use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;
    use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

    trait RoleBaseAuthenticationUserTrait
    {
        public function roles()
        {
            $reflection = new ReflectionClass(App::make(RoleInterface::class));
            return $this->belongsToMany($reflection->getName());
        }

        /**
         * @param $role
         *
         * @return bool
         */
        public function hasRole($role)
        {
            $roleArray = $this->roles()->lists('code')->toArray();
            if(is_array($role))
            {
                foreach($role as $value)
                {
                    if(in_array(strtolower($value), $roleArray)) return true;
                }
                return false;
            }else{
                if(! in_array(strtolower($role), $roleArray)) return false;
                return true;
            }
        }

        public function canDo($object, $action)
        {
            $roleIds = $this->roles()->lists('id')->toArray();
            $permissionIds = DB::table('permission_role')->whereIn("role_id",$roleIds)->lists("permission_id");
            $permissions = App::make(PermissionInterface::class)->whereIn('id', $permissionIds)->get();
            $list = [];
            foreach($permissions as $permission)
            {
                if(isset($list[$permission->object])){
                    $list[$permission->object][] = $permission->action;
                }else{
                    $list[$permission->object] = [$permission->action];
                }
            }
            if(array_has($list, $object)){
                if(in_array($action,$list[$object])){
                    return true;
                }
            }
            return false;
        }
    }