<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_own_tasks',
            'view_any_task',
            'create_tasks',
            'edit_own_tasks',
            'edit_any_task',
            'delete_own_tasks',
            'delete_any_task'
        ];
    }
}
