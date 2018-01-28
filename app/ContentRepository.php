<?php

namespace App;

use App\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentRepository extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title',
    ];

    /**
     * A content Repository can have may subjects
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * Add a new subject.
     */
    public function addSubject($subject)
    {
        $this->subjects()->save($subject);
    }
}
