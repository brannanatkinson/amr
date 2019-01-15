<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $fillable = [
        'story_id', 
        'meta_type', 
        'meta_value'
    ];
    public function story(){
        $this->belongsTo('App\Story');
    }
}
