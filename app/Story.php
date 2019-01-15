<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

	protected $fillable = [
		'story_date', 
		'client_id', 
		'project_id', 
		'story_url', 
        'story_category',
        'story_image',
        'story_paid',
        'org_id'
	];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function org()
    {
    	return $this->belongsTo('App\Org');
    }
    public function getProjectName()
    {
        return Project::find($this->project_id)->project_name;
    }
    public function getClientName()
    {
        return Client::find($this->client_id)->client_name;
    }
    public function getOrgName()
    {
        return Org::find($this->org_id)->org_name;
    }
    public function metadata(){
        return $this->hasMany('App\Metadata');
    }
    public function headline()
    {
        // return $this->id;
        $meta = Metadata::where('story_id', '=', $this->id)->where('meta_type', '=', 'headline')->first();
        return $meta['meta_value'];
    }
}
