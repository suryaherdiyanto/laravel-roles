<?php

namespace Surya\Role\Supports;
use Surya\Role\Models\Permission;

trait Permissions
{
    /**
     * Make Relation to Role
     * 
     * @return Surya\Role\Models\Role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get all permissions for specific role
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions()
    {
        return $this->permissions()->all();
    }

    /**
     * Give permission for specific role
     * 
     * @return void
     */
    public function givePermission($permission)
    {
        if (!is_int($permission)) {
            $permission = $this->permissions()->firstOrCreate(['permission' => $permission])->id;
        }
        $this->permissions()->attach($permission);
        return true ?: false;
    }

    /**
     * Give multiple permissions to specific role
     * 
     * @return void
     */
    public function givePermissions(array $permissions)
    {
        return $this->permissions()->sync($permissions);
    }

    /**
     * Determine specific role has given permission
     * 
     * @return boolean
     */
    public function hasPermission(string $permission)
    {
        return $this->permissions()->where('permission', $permission)->first() ? true : false;
    }
}
