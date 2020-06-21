<?php

namespace App\Model;

use App\Model\TimeTable;
use Illuminate\Database\Eloquent\Model;

class TimeTableTask extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time', 'time_table_id', 'completed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * The time table associated with the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function timeTable()
    {
        return $this->belongsTo(TimeTable::class);
    }

}
