<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dcategories extends Model
{
    protected $fillable = [
        'name', 'image'
    ];

    public function getRouteKeyName()
    {
        return 'name'; //don't uncomment this --> Article::where('slug', $article->first()); This will override laravel and will
        //retrieve the result by column named "name" or any other than id.
    }
}
