<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Client;
use App\Project;
use App\Story;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ( $user->hasRole('siteadmin') ) {

            $clients = Client::orderby('client_name')->get();
            return view('projects.index', compact('clients'));

        } else {

            //get $clientID from clients_users table

            $clientID = DB::table('clients_users')->select('client_id')->where('user_id', '=', $user->id)->first();            
            $projects = Project::where('client_id', $user->client_id)->orderby('project_name','asc')->get();
            $clientName = Client::where('id', $user->client_id)->first();


            return view('projects.index',compact('projects', 'clientName'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // if ( Auth::user() ){
        //   $user = Auth::user();
        // }

        if ( Auth::user() && $user->hasRole('siteadmin') ){

            $project = Project::find($id);
            $stories = Story::where('project_id', '=', $id)->orderBy('story_date', 'desc')->simplePaginate(15);
            //return view('projects.show', compact('project'));
            return view('stories.index', compact('stories', 'project'));

        } else {

            //$clientID = DB::table('clients_users')->select('client_id')->where('user_id', '=', $user->id)->first();
            //dd(Auth::user()->client_id);
            $project = Project::find($id);
            $stories = Story::where('project_id', '=', $id)->orderBy('story_date', 'desc')->paginate(15);
            return view('stories.index', compact('stories', 'project'));
            // if ( $project->client_id == Auth::user()->client_id ){
                
            //     //return view('projects.show', compact('project'));
            // } else {
            //     return redirect('/projects');
            // }

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
