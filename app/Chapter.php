<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{

    /**
     * Get the associated subject.
     */
    public function subject()
    {
        return $this->belongsTo(\App\Subject::class);
    }
}
