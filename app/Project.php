<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Story;
use App\Metadata;

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
    public function latestHeadline()
    {
        $story = Story::where('project_id', '=', $this->id)->orderBy('created_at', 'desc')->first();
        if (!is_null($story)){
            return $story->headline();
        }
    }
}
