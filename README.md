# Laravel Role
Roles and permissions management for your Laravel application.
<hr>

## Installation
```
composer require surya/laravel-roles
```

## Setup
register the `RolesServiceProvider` in `config/app.php`
```
Surya\Role\RoleServiceProvider::class
```

then publish the migration
```
php artisan vendor publish --provider="Surya\Role\RoleServiceProvider" --tag="migrations"
```

migrate
```
php artisan migrate
```

## Usage
After the setup complete, next you've going to register the `Surya\Role\Supports\Roles` trait on `User` model.

```
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Surya\Role\Supports\Roles;

class User extends Authenticatable
{
    use Notifiable, Roles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

this trait would be handle your role and permission relationship and adding some functionality for example `assign new role to user`, `remove some role that user associated with`, `adding permissions` for spesific roles etc.

### Assign Role to User
To assign user for spesific role to might use `assignRole`
```
$user = App\User::find(1);
$user->assignRole('super admin');
```
with `assignRole` if role doesn't exists with that name, it will create new role and save it to database then assigning to user.

> If you reassign your user with other role, it will detach the old and replace the new one.

If you want assign more than one roles to user use `assignRoles` function.
```
$user = App\User::find(1);
$user->assignRoles([2, 4, 6]);
```
> If you use `assignRoles` you need to retrieve or create role with model `Surya\Role\Models\Role` and then pass array id of roles.

#### Other role method
Check for spesific role.
```
$user->hasRole('super admin');
```

Getting current user role.
```
$user->role()
```
It will return a `Surya\Role\Models\Role` object.

If you want only retrive role name use `getRole`.
```
$user->getRole()
```

Getting all roles associated with user.
```
$user->getAllRoles()
```
It will return collection object of role.

### Give Permission to Role
```
$user = App\User::find(1);

$user->assignRole('admin');

$user->role()->givePermission('create post');
```
You need to retrieve the `role` object first in order to give permission to spesific role.

Same as role, if you want give more than 1 permission you need to create or retrive it then pass array of permission id to `givePermissions` function.
```
$user = App\User::find(1);

$user->assignRole('admin');

$user->role()->givePermissions([1, 5, 9]);
```
You can pass collection of id or object of permissions.

## Authorize action
Use the built in laravel function to authorize the user in controller.
```
$this->authorize('create post')
```
or your might using `Gate` facade.
```
Gate::allows('create post')
```
or with `can` directive
```
@can('create post')

@elsecan
```