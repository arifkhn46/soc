<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * Get the associated chapters.
     */
    public function chapters()
    {
        return $this->hasMany(\App\Chapter::class);
    }

    /**
     * Get the associated tasks.
     */
    public function tasks()
    {
        return $this->hasMany(\App\Task::class);
    }
}
