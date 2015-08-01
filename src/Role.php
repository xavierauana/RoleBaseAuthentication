<?php

namespace Xavierau\RoleBaseAuthentication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

class Role extends Model implements RoleInterface
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function updatePermissions($permissions)
    {
        if($permissions)
        {
            $this->permissions()->sync($permissions);
        }else{
            $permissionIds = $this->permissions()->lists('id')->toArray();
            $this->permissions()->detach($permissionIds);
        }
    }

    public function updateRoleRecord(Request $request)
    {
        $roleName = $request->get("role");
        $permissions = $request->get("permissions");
        $this->code = strtolower($roleName);
        $this->display = ucwords($roleName);
        $this->save();
        $this->updatePermissions($permissions);
    }

    public function createRoleRecord(Request $request)
    {
        $this->updateRoleRecord($request);
    }
}
