<?php

namespace App;

use App\Asset;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'content_repository_id',
    ];

    /**
     * A content may have many assets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'contents_assets');
    }

    /**
     * Add an asset to the content.
     *
     * @param  array $asset
     * @return Model
     */
    public function addAsset($asset)
    {
        $asset = $this->assets()->create($asset);
        return $asset;
    }

}
