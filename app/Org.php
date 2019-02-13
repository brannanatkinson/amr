<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    protected $fillable = ['org_name'];

    public function stories($id)
    {
        if (!is_null($id)){
            return $this->hasMany('App\Story')->where('client_id', $id)->orderBy('story_date', 'desc');
        } else {
            return $this->hasMany('App\Story')->orderBy('story_date', 'desc');
        }
    	
    }

    public function contacts()
    {
    	return $this->hasMany('App\Contact');
    }
}
