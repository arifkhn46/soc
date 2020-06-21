<?php

namespace App\Model;

use Carbon\Carbon;
use App\Model\TimeTableTask;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date', 'end_date', 'owner_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date'
    ];


    /**
     * Get time table duration
     */
    public function duration()
    {
        return $this->end_date->diffInDays($this->start_date);
    }

     /**
     * The tasks associated with the time table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(TimeTableTask::class);
    }

    /**
     * Add a task to the time table.
     *
     * @param  array $task
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTask($task)
    {
        $task['start_time'] = $this->getTaskTiming($task['day'], $task['start_time']);
        $task['end_time'] = $this->getTaskTiming($task['day'], $task['end_time']);

        return $this->tasks()->create($task);
    }

    public function getTaskTiming(int $day, string $timing)
    {
        return Carbon::parse($this->start_date->addDays($day)->format('Y-m-d') . ' ' . $timing);
    }
}
