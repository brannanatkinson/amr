<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Story;
use DB;
use Auth;
use Carbon\Carbon;
use App\Client;
use App\Media;
use App\Org;
use App\Contact;
use App\Metadata;
use App\Events\NewMention;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ( $user->hasRole('siteadmin') ){

            $stories = Story::orderBy('story_date', 'desc')->paginate(15);
            //$stories = $first_stories::paginate(15);


        } else {
            //get >client_id from clients_users table
            //dd($user->client_id)
            $clientName = Client::find($user->client_id)->getClientName();


            // use >client_id to get data
            $stories = Story::where('client_id', $user->client_id)->orderBy('story_date', 'desc')->Paginate(15);
        }

        return view('stories.index', compact('stories', 'clientName'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //display blank story form

        $clients = Client::all();
        $media = Org::orderBy('org_name', 'asc')->where('org_type', 'media')->get();


        return view('stories.create', compact('clients', 'media'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add story to database        
        //dd($request);

        $date_submitted = $request->story_date;
        $date_formatted = date("Y-m-d", strtotime($date_submitted));

        //dd($request->media_id);
        $story = Story::create([
            'story_date' => $date_formatted,
            'story_url' => $request->story_url,
            'story_headline' => $request->story_headline,
            'client_id' => $request->client_id,
            'org_id' => $request->media_ident,
            'story_notes' => $request->story_notes,
            'story_image' => $request->story_image,
            'story_description' => $request->story_description,
            'project_id' => $request->project_id,
            'contact_id' => $request->contact_id
        ]);



        //fix this to upload any type of image file and use orginial file name
        // validate data

        // dd($request->metaCount > 0);

        if ($request->metaCount >0 )
        {
            $for_meta_count = $request->metaCount - 1;
            for($i=0; $i <= $for_meta_count; $i++)
            {
                $metadata = Metadata::create([
                    'story_id' => $story->id,
                    'meta_type' => $request->metaKey[$i],
                    'meta_value' => $request->metaValue[$i]
                ]);
            }
        }

        if (!is_null( $request->story_file) ){ 
            $imageName = $story->id . '.jpg';
            $request->file('story_file')->move(
                base_path() . '/public/img/', $imageName
            );
            $story->story_image = null;
            $story->save();
        }

        event(new NewMention($story));
        // flash message about new story added
        return redirect('/stories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //display story form with story data

        $clients = DB::table('clients')->orderby('client_name')->get();

        $orgs = DB::table('orgs')->orderby('org_name')->get();

        $projects = DB::table('projects')->orderby('project_name')->get();

        $media_id = Story::find($id)->org->id;

        $contacts = Contact::where('org_id', $media_id)->orderBy('contact_last_name')->get();

        $stories = DB::table('stories')
            ->leftjoin('orgs', 'stories.org_id', '=', 'orgs.id')
            ->leftjoin('clients', 'stories.client_id', '=', 'clients.id')
            ->leftjoin('projects', 'stories.project_id', '=', 'projects.id')
            ->select('stories.*')
            ->where('stories.id','=',$id)
            ->get();
            //dd($story,$clients, $orgs, $projects, $contacts);
            


        return view('stories.edit', compact('stories', 'clients', 'orgs', 'projects', 'contacts'));

        //return compact('stories', 'clients', 'media', 'projects');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update story record in the database

        $date_submitted = $request->story_date;
        $date_formatted = date("Y-m-d", strtotime($date_submitted));

        if (!is_null( $request->story_file) ){ 

            $imageName = $id . '.jpg';

            $request->file('story_file')->move(
                base_path() . '/public/img/', $imageName
            );
            
            $set_story_image = null;

        } else {

            $set_story_image = $request->story_image;
        }

        Story::where('id', $id)
            ->update([
                'story_date' => $date_formatted,
                'client_id' => $request->client_id,
                'project_id' => $request->project_id,
                'story_url' => $request->story_url,
                'story_headline' => $request->story_headline,
                'story_image' => $set_story_image,
                'story_description' => $request->story_description,
                'org_id' => $request->media_id,
                'story_notes' => $request->story_notes,
                'contact_id' => $request->contact_id

            ]);

        return redirect('/stories');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
