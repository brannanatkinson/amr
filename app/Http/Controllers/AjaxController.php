<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use App\User;
use App\Media;
use App\Reporter;
use App\Project;
use App\Org;
use App\Contact;
use Embed\Embed;
use LayerShifter\TLDExtract;
use LayerShifter\TLDDatabase;
use LayerShifter\TLDESuppport;

class AjaxController extends Controller
{
    public function create_media(Request $request)
    {
        $new_media = new Org;
        $new_media->org_name = $request->media_name;
        $new_media->org_tld = $request->media_tld;
        $new_media->org_type = 'media';
        $new_media->save();

        return response()->json([
                'last_insert_id' => $new_media->id, 
                'org_name' => $new_media->org_name,
            ], 200);
    }

    public function get_urldata(Request $request)
    {
        // Return OpenGraph information
        $info = Embed::create($request->story_url);
        $storyDetails = array();
        $storyDetails['title'] = $info->title; //The page title
        $storyDetails['description'] = $info->description; //The page title
        $storyDetails['image'] = $info->image; //The page title

        // Extract TLD from inputted URL
        $tld_result = tld_extract($request->story_url);
        $media_domain = $tld_result->getRegistrableDomain();
        
        //If count of media_tld = 1, return media_id to set the mediaSelect
        //else, return null

        if (Org::where('org_tld', $media_domain)->count() == 1){ 

            $storyDetails['org_id'] = Org::where('org_tld', $media_domain)->first()->id;

        } else {

            $storyDetails['org_id'] = null;

        }

        return response()->json($storyDetails);
    }

    public function get_projects(Request $request)
    {
        $projects = Project::where('client_id', $request->client_id)->orderBy('project_name', 'asc')->get();
        return Response::json($projects);  	
    }

    public function get_contacts(Request $request)
    {
        $contacts = Contact::where('org_id', $request->mediaID)->get();
        return Response::json($contacts);   
    }

    public function create_project(Request $request)
    {
        $new_project = new Project;

        $new_project->client_id = $request->client_id;
        $new_project->project_name = $request->project_name;
        $new_project->save();
        return response()->json([
                'project_id' => $new_project->id,
                'project_name' => $new_project->project_name
            ], 200);	
    }
    /**
     * Process login_link from firstaccess.blade.php
     * @var book $request->login_link
     * @var user user authoized by 
     */
    public function loginlink(Request $request)
    {
        //dd($request);
        $user = User::find( Auth::id() );
        $user->login_link = 1;
        $user->save();
        return response()->json([
            'message' => 'success'
        ], 200);
    }

}
