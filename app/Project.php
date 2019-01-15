<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

	protected $fillable = ['client_id', 'project_name', 'project_description'];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function stories()
    {
    	return $this->hasMany('App\Story')->orderBy('story_date', 'desc');
    }
    public function getClientName()
    {
    	//return "this";
    	//$client_id = $this->client();
    	return Client::find($this->client_id)->getClientName();
    }
}
