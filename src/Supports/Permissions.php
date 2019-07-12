<?php

class Permission 
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
     * Give permission for specific role
     * 
     * @return void
     */
    public function givePermission($permission)
    {
        if (!is_int($permission)) {
            $permission = $this->permissions()->firstOrCreate(['permission' => $permission])->id;
        }

        return $this->permissions()->attach($permission);
    }

    /**
     * Determine specific role has given permission
     * 
     * @return boolean
     */
    public function hasPermission(string $permission)
    {
        return $this->permissions()->where('name', $permission)->first() ? true : false;
    }
}
