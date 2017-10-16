<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    
    /**
     * User role relationship.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Associate a role to a user.
     */
    public function attachRole($roleId)
    {
        $this->roles()->attach($roleId);
        return $this;
    }

    /**
     * Check if a user has given role.
     */
    public function hasRole($roleId)
    {
        return $this->roles()->where('id', $roleId)->exists();
    }
    
    /**
     * Check if a user is admin.
     */
    public function isAdmin()
    {
        return $this->hasRole(1);
    }
}
