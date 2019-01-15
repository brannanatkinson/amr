@extends('layout')

@section('content')

<div class="row">

	<div class="large-12 columns contact">

		<h1>Contacts</h1>

		<div class="row">

			@foreach($contacts as $contact)
			
			

			<div class="large-4 medium-6 small-12 columns">
				
				<div class="card">
					<a href="/contacts/{{$contact->id}}">
					<div class="card-divider">
						<span class="contact__name">{{$contact->contact_first_name}} {{$contact->contact_last_name}}</span>
						<span class="contact__org">{{$contact->org->org_name}}</span>
					</div>
					</a>
					<div class="contact__details">
						<label>Title</label>{{$contact->contact_title}}<br />
						<label>Email</label><a href="mailto:{{$contact->contact_email}}">{{$contact->contact_email}}</a><br />
						<label>Mobile Phone</label>{{$contact->contact_phone_mobile}}<br />
						<label>Office Phone</label>{{$contact->contact_phone_office}}<br />
					</div>

				</div>
				
			</div>

			

			@endforeach

		</div>


@stop