<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    

    public function orgs()
    {
        $orgs = DB::table('orgs')
            ->join('stories', 'orgs.id', '=', 'stories.org_id')
            ->join('clients', 'clients.id', '=', 'stories.client_id')
            ->select('orgs.org_name')
            ->where('clients.id', $this->id)
            ->get();
        $unique = $orgs->unique()->sort();

        return $unique;
    }
}
