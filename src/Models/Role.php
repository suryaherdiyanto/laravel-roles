<?php

namespace Surya\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id',
        'role'
    ];

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permissions_roles');
    }

    public function givePermission(string $permission)
    {
        return $this->permissions()->firstOrCreate(['permission' => $permission]) ? true : false;
    }
}