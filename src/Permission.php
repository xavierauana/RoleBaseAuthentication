<?php

namespace Xavierau\RoleBaseAuthentication;

use Illuminate\Database\Eloquent\Model;
use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;

class Permission extends Model implements PermissionInterface
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
