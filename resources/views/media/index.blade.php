@extends('layout')

@section('content')



	
<div class="ui grid container">
	<div class="row">
		<div class="sixteen wide columns">
			<h2>Media Outlets</h4>
		</div>
	</div>


	<div class="row">
		<div class="sixteen wide columns">



			@foreach ($outlets as $outlet)


				<div class="media__name"><h3>{{ $outlet->org_name }}</h3> <span class="media__count">~ Mentions: {{ $outlet->stories->count() }} ~</span></div> 

				@if ($outlet->stories->count() > 0)

					<div class="row small-up-2 medium-up-3 large-up-4">

						@foreach ($outlet->stories as $story)

		  					<div class="column column-block">

								@include('media.story_card')

							</div>

						@endforeach


					</div>

				@endif

			@endforeach
		</div>
	</div>
		

</div>

@stop