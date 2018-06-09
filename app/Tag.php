<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tagging_tags";
    public $timestamps = false;
    /**
     * The users that belong to the role.
     */
    public function images()
    {
        return $this->belongsToMany('App\Image', 'image_tag');
    }
}