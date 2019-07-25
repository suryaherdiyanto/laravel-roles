<?php

namespace Surya\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Surya\Role\Supports\Permissions;

class Role extends Model
{
    use Permissions;

    protected $fillable = [
        'id',
        'role'
    ];
}