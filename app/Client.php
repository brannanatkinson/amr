<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

	protected $fillable = [
		'client_name', 'client_logo', 'client_desc'
	];

    public function projects()
    {
    	return $this->hasMany('App\Project')->orderBy('project_name', 'asc');
    }

    public function stories()
    {
    	return $this->hasMany('App\Story');
    }

    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function getClientName(){
    	return $this->client_name;
    }
}
