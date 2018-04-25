<?php

namespace App;

use App\Content;
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
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
