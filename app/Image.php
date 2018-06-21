<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use \Conner\Tagging\Taggable;

    protected $table = "image";

    public $fillable = [
        'titre', 'description', 'src'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'image_tag');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }    
}
