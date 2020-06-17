<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can access his tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        if ($user->can('view_own_tasks')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create a task.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create_tasks')) {
            return true;
        }
    }

    /**
     * Determine if the given task can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return bool
     */
    public function update(User $user, Task $task)
    {
        if ($user->can('edit_own_tasks')) {
            return $user->id == $task->owner_id ||$user->id == $task->assignee_id;
        }
    }
}
