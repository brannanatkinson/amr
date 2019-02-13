<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Media;
use App\Org;
use App\Story;
use DB;

class MediaController extends Controller
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
            $outlets = Org::orderBy('org_name', 'asc')->where('org_type', 'media')->get();
            return view('media.index', compact('outlets'));
        } else {
            $orgs = DB::table('stories')
              ->join('orgs', 'stories.org_id', '=', 'orgs.id')
              ->where('stories.client_id', '=', $user->client_id)
              ->select('orgs.id', 'orgs.org_name')
              ->distinct()
              ->orderBy('orgs.org_name')
              ->get();
            $outlets = Org::select('*')
                ->whereIn('id', $orgs->pluck('id'))
                ->orderBy('org_name')
                ->get();
            //dd($outlets);
            return view('media.index', compact('outlets'));
        }
        
        //return compact('outlets');
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
