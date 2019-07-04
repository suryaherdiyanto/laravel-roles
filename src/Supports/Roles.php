<?php

namespace Surya\Role\Supports;

use Surya\Role\Models\Role;

trait Roles
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function permissions()
    {
        return $this->roles()->permissions();
    }

    public function role()
    {
        return $this->roles()->first()->role ?: '';
    }

    public function assignRole($role)
    {
        if (is_int($role)) {
            $hasRole = Role::find($role);
        }else{
            $hasRole = Role::where('role', $role)->first();
        }

        if ($hasRole) {
            return $this->roles()->attach($role);
        }

        return $this->roles()->attach($hasRole->id);
    }

    public function assignRoles(array $roles)
    {
        return $this->roles()->attach($roles);
    }

    public function hasRole($role)
    {
        if (is_int($role)) {
            return $this->roles()->find($role) ?: false;
        }

        return $this->roles()->where('role', $role)->first() ?: false;
    }
}