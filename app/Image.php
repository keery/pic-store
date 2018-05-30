<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use \Conner\Tagging\Taggable;

    protected $table = "image";
    
}
