<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    protected $fillable = ['org_name'];

    public function stories()
    {
    	return $this->hasMany('App\Story')->orderBy('story_date', 'desc');
    }

    public function contacts()
    {
    	return $this->hasMany('App\Contact');
    }
}
