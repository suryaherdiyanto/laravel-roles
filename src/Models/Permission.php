<?php

namespace Surya\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'id',
        'permission'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permissions_roles');
    }
}