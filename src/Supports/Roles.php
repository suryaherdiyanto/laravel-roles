<?php

namespace Surya\Role\Supports;

use Surya\Role\Models\Role;

trait Roles
{

    /**
     * Initiate roles relation
     *
     * @return Surya\Role\Models\Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get all roles associate with user
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return $this->roles->all();
    }

    /**
     * Get role of the current user
     * if current user has more than one roles then the first role will return
     *
     * @return boolean
     */
    public function getRole()
    {
        $role = $this->role();

        return $role ? $role->role : false;
    }

    /**
     * Get user first role
     *
     * @return Surya\Role\Models\Role
     */
    public function role()
    {
        return $this->roles()->first();
    }

    /**
     * Assign current user role
     *
     * @param $role
     * @return mixed
     */
    public function assignRole($role)
    {
        if (!$this->getRole()) {
            $this->roles()->delete();
        }

        if (!is_int($role)) {
            $role = Role::firstOrCreate(['role' => $role])->id;
        }

        return $this->roles()->attach($role) ?: false;
    }

    /**
     * Detach current user roles
     *
     * @param $roles
     * @return mixed
     */
    public function removeRole($roles)
    {
        if (is_array($roles) || is_int($roles)) {
            return $this->detachRoles($roles);
        }

        $role = $this->roles()->where('role', $roles)->first();

        return $this->detachRoles($role->id);
    }

    /**
     * Assign current user with more than one roles
     *
     * @param array $roles
     * @return mixed
     */
    public function assignRoles(array $roles)
    {
        return $this->roles()->attach($roles);
    }

    /**
     * Determine current user has specific role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_int($role)) {
            return $this->roles()->find($role) ? true : false;
        }

        return $this->roles()->where('role', $role)->first() ? true : false;
    }

    /**
     * Detach current user role association
     *
     * @param $roles
     * @return mixed
     */
    private function detachRoles($roles)
    {
        return $this->roles()->detach($roles);
    }

}