<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['media_name'];

    public function stories()
    {
    	return $this->hasMany('App\Story')->orderBy('story_date', 'desc');
    }
}
