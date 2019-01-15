@extends('layout')

@section('content')

<div class="row">

	<div class="large-12 columns contact">

		<h1>Add New Contact</h1>

		{!! Form::open(['url' => '/contacts', 'class' => 'form-a']) !!}

		
			{{ csrf_field() }}

			<div class="row">
				<div class="columns small-3">
					{{ Form::label('contact_first_name', 'First Name') }}
					{{ Form::text('contact_first_name') }}
					<!--<label for="contact_first_name">First Name</label>
					<input type="text" name="contact_first_name" id=name="contact_first_name">-->
				</div>
				<div class="columns small-3">
					{{ Form::label('contact_last_name', 'Last Name') }}
					{{ Form::text('contact_last_name') }}
				</div>
				<div class="columns small-1">
					{{ Form::label('contact_suffix', 'Suffix') }}
					{{ Form::text('contact_suffix') }}
				</div>
			</div>

			<div class="row">
				<div class="columns small-4">
					{{ Form::label('contact_title', 'Title') }}
					{{ Form::text('contact_title') }}
				</div>
				<div class="columns small-4">
					{{ Form::label('contact_org', 'Organization') }}
					{{ Form::select('org_id', $orgs) }}
				</div>
				<div class="columns small-3">
					<button type="button" class="button primary new_org" id="new_org">Add New Organization</button>
				</div>
			</div>
				
			<hr>

			<div class="row">
				<div class="columns small-12">
					<h5>Contact Information</h5>
				</div>
			</div>
				
			<div class="row">
				<div class="columns small-3">
					<label for="contact_phone_mobile">Mobile</label>
					<input type="tel" name="contact_phone_mobile" id=name="contact_phone_mobile">
				</div>
				<div class="columns small-3">
					<label for="contact_phone_office">Office</label>
					<input type="tel" name="contact_phone_office" id=name="contact_phone_office">
				</div>
			</div>

			<div class="row">
				<div class="columns small-4">
					{{ Form::label('contact_email', 'Email') }}
					{{ Form::text('contact_email') }}
				</div>
				<div class="columns small-4">
					{{ Form::label('contact_website', 'Website') }}
					{{ Form::text('contact_website') }}
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="columns small-6">

					<h5>Social Media</h5>
					
					<div class="contactsocial contact__socialicon soc"><a class="soc-facebook" title="Facebook"></a></div>
					<div class="contactsocial contact__socialweb">www.facebook.com/</div>
					{{ Form::text('contact_fb', null ,['class' => 'contactsocial contact__socialhandle']) }}
					<div class="clearfix"></div>
				
					<div class="contactsocial contact__socialicon soc"><a class="soc-twitter" title="Facebook"></a></div>
					<div class="contactsocial contact__socialweb">www.twitter.com/</div>
					{{ Form::text('contact_twitter', null ,['class' => 'contactsocial contact__socialhandle']) }}
					<div class="clearfix"></div>
				
				
					<div class="contactsocial contact__socialicon soc"><a class="soc-linkedin" title="Facebook"></a></div>
					<div class="contactsocial contact__socialweb">www.linkedin.com/in/</div>
					{{ Form::text('contact_linkedin', null ,['class' => 'contactsocial contact__socialhandle']) }}
					<div class="clearfix"></div>
				
					<div class="contactsocial contact__socialicon soc"><a class="soc-instagram" title="Facebook"></a></div>
					<div class="contactsocial contact__socialweb">www.instagram.com/</div>
					{{ Form::text('contact_instagram', null ,['class' => 'contactsocial contact__socialhandle']) }}
					<div class="clearfix"></div>
					
				</div>
				<div class="columns small-6">
					{{ Form::label('contact_notes', 'Notes') }}
					{{ Form::textarea('contact_notes') }}
				</div>
			</div>

			<div class="div row">
				<div class="columns small-12 contact__buttons">
					{{Form::submit('Save Contact'), ['class' => 'button', 'id' => 'contact__button']}}
				</div>
			</div>
			


		{!! Form::close() !!}


		<div class="reveal" id="orgModal" data-reveal>
		  	<form action="">
		  	{{ csrf_field() }}
			{{ Form::label('org_name', 'Organization') }}
			{{ Form::text('org_name') }}
			{{ Form::label('org_tld', 'Website') }}
			{{ Form::text('org_tld') }}
			{{ Form::label('org_type', 'Media?') }}
			{{ Form::radio('org_type', 'yes') }}
			<span class="radio_option">Yes</span>
			{{ Form::radio('org_type', 'no', true) }}
			<span class="radio_option">No</span>
			<br />
		  	<button id="btn-save-org" class='button success'>Save New Organization</button>
		  	<button class="close-button" data-close aria-label="Close modal" type="button">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </form>


@stop