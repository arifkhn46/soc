<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'owner_id' => 'integer',
        'subject_id' => 'integer',
        'chapter_id' => 'integer',
        'type' => 'integer',
        'state' => 'integer',
        // 'assignee_id' => 'integer'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the associated subject.
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * Get the associated chapter.
     */
    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }

    /**
     * Get the owner of the task.
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the assignee of the task.
     */
    public function assignee()
    {
        return $this->belongsTo('App\User');
    }

}
