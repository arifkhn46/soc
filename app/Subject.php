<?php

namespace App;

use App\ContentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    /**
     * Database table name.
     */
    protected $table = 'subjects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'user_id', 'category_id',
    ];

    /**
     * A subject can blongs to many content repositories.
     */
    public function contentRepositories()
    {
        return $this->belongsToMany(ContentRepository::class);
    }
}
