<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

	protected $fillable = [
        'contact_first_name', 'contact_last_name', 'contact_title', 'contact_phone_mobile', 
        'contact_phone_office', 'contact_email','contact_website', 'contact_fb', 
        'contact_twitter', 'contact_linkedin', 'contact_instagram'
    ];

    public function org()
    {
    	return $this->belongsTo('App\Org');
    }

    public function stories()
    {
    	return $this->hasMany('App\Story');
    }
}
