<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginLink;
use App\User;
use Auth;

class SigninController extends Controller
{
    // Go to signin form
    public function index()
    {
        $user = Auth::user();
        Auth::logout($user);
    	return view('/signin.index');
    }

    /*
        Switch verification to just client
        Changed signed URLs to one for each client
        Get URL for client 
        Send email with client URL
        Rewrite email
    */

    // Get user submission 
    public function confirm(Request $request)
    {
        if ( User::where('email', '=', $request->email )->exists()) {
            $user = User::where('email', '=', $request->email)->first();
            $url = $user->signed_url;
            Mail::to($request->email)->send(new LoginLink($user, $url));
            $confirmation_details = [];
            $confirmation_details['email'] = $request->email;
            $confirmation_details['msg'] = true;
            return view('signin/confirmation', compact('confirmation_details'));
        } else {
            $confirmation_details['msg'] = false;
            return view('signin/confirmation', compact('confirmation_details'));
        }
    }

    // Auth user
    public function verify($id, Request $request)
    {
        if (! $request->hasValidSignature()) {
            dd('nope');
            abort(404);
        }
        $user = User::find($id);
        Auth::login($user);      
        return redirect()->route('dashboard');
    }

    // Auth user
    public function update(){
        $users = User::all();
        //dd($users);
        foreach($users as $user){
            dump( 'done')
        }
    }
    

}
