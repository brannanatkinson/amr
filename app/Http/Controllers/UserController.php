<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use DB;
use App\User;
use App\Client;
use Form;
use HTML;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('last_name', 'asc')->get();
        return view('users/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::orderBy('client_name', 'asc')->get();
        return view('users/create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( User::where('email', '=', $request->email)->exists()){
            flash('User already exists');
            return redirect('/users');
        }
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            //'password'   => 'required'
        ]);
        if ($request->upload){
            $upload_name = $request->upload;
            $path = $upload_name->storeAs('photos', $upload_name->getClientOriginalName(), 'public' );
            $user = User::firstOrCreate([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'client_id'  => $request->client_id,
                'admin'      => $request->admin,
                'filepath'   => $path
            ]);
        } else {
            $user = User::firstOrCreate([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'client_id'  => $request->client_id,
                'admin'      => $request->admin,
                
            ]);
        }
        $user->signed_url = URL::signedRoute('signin.verify', ['id' => $user->id]);
        $user->save();
        
        flash('New user created')->success();
        return redirect('/users');
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
        $user = User::find($id);
        $clients = Client::all();
        $client_array = [];
        foreach($clients as $client){
            $client_array[$client->id] = $client->client_name;
        }
        $selectedClientID = $user['client_id'];
        return view('users/edit', compact('user', 'client_array', 'selectedClientID'));
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
        //dd($request);
        if ($request->upload){
            $upload_name = $request->upload;
            $path = $upload_name->storeAs('photos', $upload_name->getClientOriginalName(), 'public' );
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'client_id' => $request->client_id,
                    'admin' => $request->admin,
                    'filepath' => $path
                ]);
        } else {
            DB::table('users')
            ->where('id', $id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'client_id' => $request->client_id,
                'admin' => $request->admin,
            ]);
        }

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        flash('User deleted')->success();
        return redirect('/users');
    }

    // Function for creating signed URLs
    public function admin_create_signed_url()
    {
        
        $users = User::all();
        var_dump($users);
        // foreach ( $users as $user){
        //     $user_edit = DB::table('users')->where('id', $user->id)
        //         ->update([
        //             'signed_url' => URL::signedRoute('signin.verify', ['id' => $user->id])
        //         ]);
        // }
        // return redirect('/admin/users');
    }
}
