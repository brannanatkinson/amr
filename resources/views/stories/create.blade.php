@extends('layout')

@section('content')

	
	<form action="/stories" method="POST" enctype="multipart/form-data" class="ui form">
			{{ csrf_field() }}
			<div class="ui two column grid">
				<div class="ui left floated column">
					<h1 class="ui header">Add New Mention</h1>
				</div>
				<div class="right floated right aligned column">
					<button type="submit" class='ui button'>Save New Mention</button>
				</div>
			</div>
			<div class="three fields">
			    <div class="eight wide field">
				<label for="story_url">Story URL</label>
				<input class=" " type="text" id="story_url" name="story_url">
			    </div>
			    <div class="four wide field">
				    <label for="datepicker">Date</label>
				    <input type="text" id="story_date" name="story_date">
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
                        <div style="width:100%; height:300px; ">
                            <img src="" alt="" id="ogImage" style="height: 100%; width: 100%; object-fit: cover; background-color: #eee;">
                        </div>
						<input type="hidden" id="story_image" name="story_image">
                        <input type="file" name="story_file" id="story_file" onchange="readURL(this);">
					</div>
				</div>
				<div class="ten wide column">
					<div class="fields">	
        				<div class="eight wide field">
        					<label for="clientSelect">Client</label>
        					<select name="client_id" id="clientSelect" class="ui dropdown">
        						<option value="" disabled selected hidden>Choose client...</option>
        						@foreach ($clients as $client)
        							<option value="{{ $client->id }}">{{ $client->client_name }}</option>
        						@endforeach
        					</select>
        					
        				</div>
        				<div class="ten wide field">
        					<label for="projectSelect">Project <a href="#"><i id="newProject" class="ui grey plus circle icon"></i></a></label>
        					<select name="project_id" id="projectSelect" class="ui dropdown">
        					<option value="" disabled selected hidden>Select project...</option>
        					</select>
        				</div>
        			</div>
        			<div class="two fields">	
        				<div class="ten wide field">
        					<label for="mediaSelect">Media <a href="#"><i id="newMedia" class="ui grey plus circle icon"></i></a></label>
        					<select name="media_ident" id="mediaSelect" class="ui dropdown">
        						<option value="" disabled selected hidden>Choose media outlet...</option>
        						@foreach ($media as $outlet)
        							<option value="{{ $outlet->id }}">{{ $outlet->org_name }}</option>
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
			<input type="hidden" name="metaCount" id="metaCount" value="0">
			<table id="metaTable" class="ui striped celled table">
				<thead>
    				<tr>
    				    <th>Meta Key</th>
    				    <th colspan="2">Meta Value</th>
    			    </tr>
    			</thead>
				<tr style="display:none;">
					<td class="collapsing">
						<select name="metaKey[]" class="ui dropdown" id="metaKey1">
							<option value="headline">Headline</option>
							<option value="description">Description</option>
							<option value="note">Note</option>
							<option value="attachment">Attachment</option>
						</select>
					</td>
					<td>
						<input name="metaValue[]" type="text" value+"" id="metaValue1">
					</td>
                    <td class="right collapsing">
                        <i class="ui minus circle icon"></i>
                    </td>
				</tr>
			</table>
			<h5><i id="addMeta" class="ui plus icon"></i> Add Meta Data</h5>
			
			<div class="ui divider"></div>
			<div class="ui grid">
				<div class="right aligned column">
					<button type="submit" class='ui button'>Save New Mention</button>
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
        		  	<button id="btn-save-project" type="submit" class='ui button'>Save New Projects</button>
    		    </form>
    		</div>

		</div>



		{{-- <p><a data-open="exampleModal1">Click me for a modal</a></p> --}}


	</div>
</div>

@stop