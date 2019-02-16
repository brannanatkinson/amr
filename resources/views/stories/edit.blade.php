@extends('layout')

@section('content')

	
	<form action="/stories/{{ $story->id }}" method="POST" enctype="multipart/form-data" class="ui form">
			{{ csrf_field() }}
            {{ method_field('PATCH')}}
			<div class="ui two column grid">
				<div class="ui left floated column">
					<h1 class="ui header">Update Mention</h1>
				</div>
				<div class="right floated right aligned column">
					<button type="submit" class='ui button'>Update Mention</button>
				</div>
			</div>
			<div class="three fields">
			    <div class="eight wide field">
				<label for="story_url">Story URL</label>
				<input class=" " type="text" value="{{ $story->story_url }}" id="story_url" name="story_url">
			    </div>
			    <div class="four wide field">
				    <label for="datepicker">Date</label>
				    <input type="text"  value="{{ $story->story_date }}" id="story_date" name="story_date">
			    </div>
			{{-- category --}}
			    <div class="three wide field">
				    <label for="datepicker">Category</label>
				    <div class="inline fields">
					    <div class="field">
					        <div class="ui radio checkbox">
						        <input type="radio" name="story_category" value="story">
					            <label for="">Story</label>
					        </div>
				        </div>
				        <div class="field">
					        <div class="ui radio checkbox">
						        <input type="radio" name="story_category" value="social">
					            <label for="">Social</label>
					        </div>
				        </div>
				        <div class="field">
    					    <div class="ui radio checkbox">
    						    <input type="radio" name="story_category" value="calendar">
    					        <label for="">Calendar</label>
    					    </div>
				        </div>
				    </div>
			    </div>
			</div>
			{{-- primary section --}}
			<div class="ui two column grid">
				<div class="six wide column">
					<div class="field">
                        <div style="width:100%; height:300px; object-fit: cover;">
                            @if ( is_null($story->story_image) )
                                <img id="ogImage" src="{{ url ('/img/' . $story->id . '.jpg') }}" style="width: 100%; object-fit:cover" alt="">
                                <input type="hidden" id="story_image" name="story_image">                              
                            @else
                                <img id="ogImage" src="{{ $story->story_image }}" style="width: 100%; object-fit:cover" alt="">
                                <input type="hidden"  value="{{ $story->story_image}}" id="story_image" name="story_image">
                            @endif

                        </div>
                        <input type="file" name="story_file" id="story_file" onchange="readURL(this);">
					</div>
				</div>
				<div class="ten wide column">
					<div class="fields">	
        				<div class="eight wide field">
        					<label for="clientSelect">Client</label>
        					<select name="client_id" id="clientSelect" class="ui dropdown">
        						<option value="" disabled selected hidden>Choose client...</option>
        						@foreach ( App\Client::all() as $client)
                                    @if ($client->id == $story->client_id)
                                        <option value="{{ $client->id }}" selected>{{ $client->client_name }}</option>
                                    @else
                                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                    @endif
                                @endforeach
        					</select>
        					
        				</div>
        				<div class="ten wide field">
        					<label for="projectSelect">Project <a href="#"><i id="newProject" class="ui grey plus circle icon"></i></a></label>
        					<select name="project_id" id="projectSelect" class="ui dropdown">
            					@foreach ( App\Project::all() as $project)
                                    @if ( $project->client_id == $story->client_id )
                                        @if ( $story->project_id == $project->id ) 
                                            <option value="{{ $project->id }}" selected>{{ $project->project_name }}</option>
                                        @else 
                                            <option value="{{ $project->id }}" >{{ $project->project_name }}</option>
                                        @endif 
                                    @endif
                                @endforeach
        					</select>
        				</div>
        			</div>
        			<div class="two fields">	
        				<div class="ten wide field">
        					<label for="mediaSelect">Media <a href="#"><i id="newMedia" class="ui grey plus circle icon"></i></a></label>
        					<select name="media_ident" id="mediaSelect" class="ui dropdown">
        						<option value="" disabled selected hidden>Choose media outlet...</option>
        						@foreach ( App\Org::all() as $outlet)
                                    @if ( $outlet->id == $story->org_id )
                                        <option value="{{ $outlet->id }}" selected>{{ $outlet->org_name }}</option>
                                    @else
                                        <option value="{{ $outlet->id }}">{{ $outlet->org_name }}</option>
                                    @endif
                                @endforeach
        					</select>	
        				</div>
        				<div class="four wide field">
        					<label>Paid</label>
        					<div class="ui toggle checkbox">
                                <input name="story_paid" type="checkbox" tabindex="0" class="hidden">
                                
                            </div>
        				</div>
        			</div>
				</div>
			</div>

            {{-- meta data --}}
			<h4 class="ui dividing header">Meta Data</h4>
			<input type="hidden" name="metaCount" id="metaCount" value="{{ $story->metadata->count() }}">
			<table id="metaTable" class="ui striped celled table">
				<thead>
    				<tr>
    				    <th>Meta Key</th>
    				    <th colspan="2">Meta Value</th>
    			    </tr>
    			</thead>

                @foreach( $story->metadata as $meta )
				<tr style="">
					<td class="collapsing">
						<select name="metaKey[]" class="ui dropdown" id="metaKey1">
							<option value="headline" @if ($meta->meta_type=='headline') selected @endif>Headline</option>
							<option value="description" @if ($meta->meta_type=='description') selected @endif>Description</option>
							<option value="note" @if ($meta->meta_type=='note') selected @endif>Note</option>
							<option value="attachment" @if ($meta->meta_type=='attachment') selected @endif>Attachment</option>
						</select>
					</td>
					<td>
						<input name="metaValue[]" type="text" value="{{ $meta->meta_value }}" id="metaValue1">
					</td>
                    <td class="right collapsing">
                        <i class="ui minus circle icon"></i>
                    </td>
				</tr>
                @endforeach
			</table>
			<h5><i id="addMeta" class="ui plus icon"></i> Add Meta Data</h5>
			
			<div class="ui divider"></div>
			<div class="ui grid">
				<div class="right aligned column">
					<button type="submit" class='ui button'>Update Mention</button>
				</div>
			</div>
	</form>	
		
		
		{{-- modal for Media --}}
		<div class="ui mini modal" id="mediaModal" data-reveal>
			<h4 class="header">Add New Outlet</h4>
			<div class="content">
    		  	<form action="" class="ui form">
    		  	{{ csrf_field() }}
          		  	<div class="field">
          		  	    <label for="addMedia">Media Name</label>
          			    <input type="text" name="addMedia" id="addMedia">
          			</div>
          			<div class="field">
          			    <label for="mediaURL">Media URL</label>
          			    <input type="text" name="mediaURL" id="mediaURL">
          			</div>
          		  	<button id='btn-save-media' class='ui button'>Save New Media</button>
    		    </form>
		    </div>

		</div>

		{{-- modal for Reporters --}}
		<div class="ui modal" id="reporterModal" data-reveal>
		  	<form action="">
		  	{{ csrf_field() }}
			<label for="addReporterFirst">Reporter First Name</label>
			<input type="text" name="ReporterModalFirst">
			<label for="addReporterLast">Reporter Last Name</label>
			<input type="text" name="ReporterModalLast">
		  	<button id="btn-save-reporter" class='button success'>Save New Reporter</button>
		  	<button class="close-button" data-close aria-label="Close modal" type="button">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </form>

		</div>

		{{-- modal for Projects --}}
		<div class="ui mini modal" id="projectModal" data-reveal>
			<div class="header">Add a New Project</div>
			<div class="content">
    		  	<form action="" class="ui form">
        		  	{{ csrf_field() }}
        		  	
        		  	<div class="field">
        		  		<label for="">Project Name</label>
        			    <input type="text" name="project_name">
        		  	</div>
        		  	<button id="btn-save-media" type="submit" class='ui button'>Save New Media</button>
    		    </form>
    		</div>

		</div>



		{{-- <p><a data-open="exampleModal1">Click me for a modal</a></p> --}}


	</div>
</div>

@stop