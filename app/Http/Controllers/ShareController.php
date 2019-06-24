<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use App\Project;
use App\Metadata;

class ShareController extends Controller
{
    public function share_project_url ($id){
        $project = Project::where('project_share_id', '=', $id)->first();
        $stories = Story::where('project_id', '=', $project->id)->orderBy('story_date', 'desc')->simplePaginate(15);
        return view('projects.show', compact('stories', 'project'));
    }
}
