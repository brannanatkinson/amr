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
				<hr>
				<h2 style="font-weight: bolder; text-align: center; padding-top: 20px;">{{ $outlet->org_name }}</h2> 
				<div style="text-align: center; margin-top: -10px; padding-bottom: 20px;" class="media__count">~ Mentions: {{ $outlet->stories->count() }} ~</div> 

				@if ($outlet->stories->count() > 0)

					<div class="row small-up-2 medium-up-3 large-up-4">
                        <div class="ui items">
						@foreach ($outlet->stories as $story)
							<div class="item">
							    <div class="image">
							        @if(strpos($story->story_url, 'twitter') == true )
							    	    <img style="height: 100px; object-fit: cover;" src="https://placehold.it/600/1CA1F2/ffffff" alt="" >
							    	@else
								        @if ( is_null($story->story_image) )
											<img style="height: 100px; object-fit: cover;" src="{{ url ('public/img/' . $story->id . '.jpg') }}" alt="">																			
									    @else
											<img style="height: 100px; object-fit: cover;" src="{{ $story->story_image }}" alt="" >
										{{-- @elseif(strpos($story->story_url, 'twitter') == true )
											<h3>placeholder:twitter</h3> --}}
										@endif
						            @endif
							    </div>
							    <div class="content">
							        <a class="header">{{ $story->headline() }}</a>
							        <div class="meta">
							            <span>Description</span>
							        </div>
								    <div class="extra">
								        Additional Details
								    </div>
							    </div>
							</div>
						@endforeach
						</div>


					</div>

				@endif

			@endforeach
		</div>
	</div>
		

</div>

@stop