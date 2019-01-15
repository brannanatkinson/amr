<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Org;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('contact_last_name')->get();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = Org::orderBy('org_name')->pluck('org_name', 'id');
        return view('contacts.create', compact('orgs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_contact = new Contact;
        $new_contact->contact_first_name = $request->contact_first_name;
        $new_contact->contact_last_name = $request->contact_last_name;
        $new_contact->contact_suffix = $request->contact_suffix;
        $new_contact->org_id = $request->org_id;
        $new_contact->contact_title = $request->contact_title;
        $new_contact->contact_phone_mobile = $request->contact_phone_mobile;
        $new_contact->contact_phone_office = $request->contact_phone_office;
        $new_contact->contact_email = $request->contact_email;
        $new_contact->contact_website = $request->contact_website;
        $new_contact->contact_fb = $request->contact_fb;
        $new_contact->contact_twitter = $request->contact_twitter;
        $new_contact->contact_linkedin = $request->contact_linkedin;
        $new_contact->contact_instagram = $request->contact_instagram;
        $new_contact->contact_notes = $request->contact_notes;
        $new_contact->save();

        $last_insert_id = $new_contact->id;

        return redirect()->action('ContactController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return compact('contact');
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
