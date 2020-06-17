<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\AuthorizableTrait;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, HasRoles, AuthorizableTrait;

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::parse($date)->format('d/m/Y');   
    }

    /**
     * Get the content repositories of the user.
     */
    public function contentRepositories()
    {
        return $this->hasMany('App\ContentRepository');
    }

    /**
     * Get the tasks a user have.
     */
    public function tasks()
    {
        return $this->hasMany(\App\Task::class, 'owner_id');
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this->email, config('soc.administrators'));
    }

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(getSuperAdminRoleName());
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isTeacher()
    {
        return in_array($this->email, config('soc.teachers'));
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getIsAdminTeacher()
    {
        return $this->isTeacher();
    }

    public function guardName()
    {
        return 'sanctum';
    }
}
