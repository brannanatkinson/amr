<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use App\Metadata;

class UpdateController extends Controller
{
    public function updateHeadlines()
    {
        // get all stories
        $stories = Story::all();
        // for each stories -- headline, description, notes -- if not null
        foreach ( $stories as $story )
        {
            if (!is_null($story->story_headline)){
                $meta_headline = Metadata::create([
                    'story_id' => $story->id,
                    'meta_type' => 'headline',
                    'meta_value' => $story->story_headline
                ]);
            }

            if (!is_null($story->story_description)){
                $meta_description = Metadata::create([
                    'story_id' => $story->id,
                    'meta_type' => 'description',
                    'meta_value' => $story->story_description
                ]);
            }

            if (!is_null($story->story_notes)){
                $meta_notes = Metadata::create([
                    'story_id' => $story->id,
                    'meta_type' => 'notes',
                    'meta_value' => $story->story_notes
                ]);
            }
        }
        return view('admin.index');
    } 
}
