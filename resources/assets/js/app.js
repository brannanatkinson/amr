
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// *
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
 

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });



$(document).ready(function(){

// some test content

  $(document).on("keypress", "form", function(event) { 
    return event.keyCode !== 13;
  });

  $('#cogMenu').click(function(){
      $('.ui.sidebar')
        .sidebar('toggle')
      ;
  });
  $( "#datestart" ).datepicker();
            $( "#dateend" ).datepicker();
            $( "#story_date" ).datepicker();
            $('.ui.checkbox').checkbox();
            $('.ui.dropdown').dropdown();

  // modal reveeals

  // made fields visible on story edit.blade.php
  if($('#page_title').html() == "Edit Story"){
		$("label[for='story_headline']").show();
		$("label[for='mediaSelect']").show();
		$("label[for='story_image']").show();
		$("label[for='story_description']").show();
		$("label[for='story_notes']").show();
		$("label[for='contactSelect']").show();
		$('#projectSelect').show();
		$('#addNewProject').show();
		$('#story_headline').show();
		$("#story_image").show();
		$("#addPhoto").show();
		$("#story_file").show();
		$("#story_description").show();
		$("#mediaSelect").show();
		$("#addNewMedia").show();
		$("#contactSelect").show();
		$("#story_notes").show();
  }


  //revel project select and ajax request for projects
  $('#clientSelect').change(function(e){
  	$('label[for=project').show();
  	$('#projectSelect').show();
  	$('#addNewProject').show();
  	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});
  	e.preventDefault();
    $.ajax({
      url: '/ajax/get_projects',
      type: 'POST',
      dataType: "json",
      data: { '_token': $('meta[name="_token"]').attr('content'), 
      		  'client_id': $('#clientSelect').val() },
      success: function(data){
      	$('#projectSelect').empty();
      	for(var i =0;i < data.length;i++)
		{
		  var item = data[i];
		  var toAppend = "<option value='"+item.id + "' >" + item.project_name + "</option>";
        	$('#projectSelect').append(toAppend);
		}    		
      	
      }
    });
  });

// New Project button
	$('#newMedia').click(function(e){
		$('#mediaModal').modal('show');
	});

  // Save new media name
  $('#btn-save-media').click(function(e){
	  	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	  	e.preventDefault();
	    $.ajax({
	      url: '/ajax/create_media',
	      type: 'POST',
	      dataType: "json",
	      data: { '_token': $('meta[name="_token"]').attr('content'), 
		      	'media_name': $('input[name="addMedia"').val(),
		      	'media_tld': $('input[name="mediaURL"').val()
	      },
	      success: function(data){
	      	console.log(data.org_name);
	    	$('#mediaSelect').append("<option value='"+data.last_insert_id + "' >" + data.org_name + "</option>");
	    	$('#mediaSelect').val(data.last_insert_id);
	    	$('#mediaModal').foundation('close');

	      }
	    });
  }); //end #btn-save-media

  // New Project button
	$('#newProject').click(function(e){
		console.log('click');
		$('#projectModal').modal('show');
	});

  // Save new project
  $('#btn-save-project').click(function(e){
	  	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	  	e.preventDefault();
	    $.ajax({
	      url: '/ajax/create_project',
	      type: 'POST',
	      dataType: "json",
	      data: { '_token': $('meta[name="_token"]').attr('content'), 'project_name': $('input[name="project_name"').val(), 'client_id': $('#clientSelect').val()
	      },
	      success: function(data){
	    	$('#projectSelect').append("<option value='"+data.project_id + "' >" + data.project_name + "</option>");
	    	$('#projectSelect').val(data.project_id);
	    	$('#projectModal').foundation('close');

	      }
	    });
  }); //end #btn-save-media


// Get reporters after media update

	$('#mediaSelect').on('change', function(e){

		$("label[for='contactSelect']").show();
	    $('#contactSelect').show();

		$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});
	  	e.preventDefault();
	    $.ajax({
	      url: '/ajax/get_contacts',
	      type: 'POST',
	      dataType: "json",
	      data: { '_token': $('meta[name="_token"]').attr('content'), 'mediaID': $('#mediaSelect').val() },
	      success: function(data){
	      	$('#contactSelect').empty();
	      	for(var i =0;i < data.length;i++)
			{
			  var item = data[i];
			  var toAppend = "<option value='"+item.id + "' >" + item.contact_first_name + " " + item.contact_last_name + "</option>";
	        	$('#contactSelect').append(toAppend);
			}    		
	      	
	      }
	    });

	}); // end $(mediaSelector).change

// Check if Twitter

	$("input[name='story_url']").change(function(){

  	var urlCheck = $("input[name='story_url']").val();

  	if ( tld.getDomain( urlCheck ) == 'twitter.com' ){
  		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	    $.ajax({
	      url: 'https://publish.twitter.com/oembed?url=' + urlCheck,
	      type: 'GET',
	      dataType: "jsonp",
	      success: function(data){
	    	$('#twitterOembed').html(data.html);
	      }
	    });

  	} else { // pass ajax with URL
  		$('#twitterOembed').hide();
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	    $.ajax({
	      url: '/ajax/get_urldata',
	      type: 'POST',
	      data: { '_token': $('meta[name="_token"]').attr('content'), 'story_url': $('input[name="story_url"').val() },
	      dataType: "json",
	      success: function(data){
	    	// $('#story_headline').val(data.title);
	    	// $("#ogImage").attr("src",data.image);
	    	// $("#story_image").val(data.image);
	    	// $("#story_description").val(data.description);
	    	$("#ogImage").attr("src",data.image);
	    	$("#story_image").val(data.image);

            $('#metaTable tbody tr:first').css('display','table-row');
            $value = parseInt($('#metaCount').val(), 10)  +1;
            $('#metaCount').val($value);

	    	$('select[id="metaKey1"]').dropdown('set selected', 'headline');
	    	$('input[id="metaValue1"]').val(data.title);

	    	$value = parseInt($('#metaCount').val(), 10)  +1;
            $('#metaCount').val($value);
            $('#metaTable tr:last').after(
            	$('#metaTable tr:eq(1)').clone()
            );
            $('#metaTable tr:last td select').attr('name', 'metaKey[]');
            $('#metaTable tr:last td select').attr('id', 'metaKey' + $value);
            $('#metaTable tr:last td input').attr('name', 'metaValue[]');
            $('#metaTable tr:last td input').attr('id', 'metaValue' + $value);

            $id = $('#metaTable tr:last td select').attr('id');
            $('.ui.dropdown.selection > select[id="'+$id+'"] ~ div.menu').remove();
            $('select[id="'+$id+'"]').dropdown();
           

	    	$('select[id="metaKey2"]').dropdown('set selected', 'Description');
	    	$("input[id='metaValue2']").val(data.description);

	    	// if data.media_id is not null, set the value to mediaSelect

	    	// $("label[for='contactSelect']").show();
	    	// $('#contactSelect').show();

	    	if ('null' != data.org_id){
				$('#mediaSelect').val(data.org_id);
				$('#mediaSelect').trigger('change');
	    	}
	      }
	    });

		$('#headline').focus();
  	}
  });

	$('.twitterDisplay').each(function( ){
		var urlCheck = $(this).html();

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
	    $.ajax({
	      url: 'https://publish.twitter.com/oembed?url=' + urlCheck,
	      type: 'GET',
	      context: this,
	      dataType: "jsonp",
	      success: function(data){
	    	$(this).html(data.html);

	      }
	    });

	});

});

//increment metaCount
$('#addMeta').click(function(){
    if ( $('#metaCount').val() == 0 ){
        $('#metaTable tbody tr:first').css('display','table-row');
        $value = parseInt($('#metaCount').val(), 10)  +1;
        $('#metaCount').val($value);
    } else {
        $value = parseInt($('#metaCount').val(), 10)  +1;
        $('#metaCount').val($value);
        $('#metaTable tr:last').after(
        	$('#metaTable tr:eq(1)').clone()
        );
        $('#metaTable tr:last td select').attr('name', 'metaKey[]');
        $('#metaTable tr:last td select').attr('id', 'metaKey' + $value);
        $('#metaTable tr:last td input').attr('name', 'metaValue[]');
        $('#metaTable tr:last td input').attr('id', 'metaValue' + $value);
        $('#metaTable tr:last td input').val(null);
        $id = $('#metaTable tr:last td select').attr('id');
        $('.ui.dropdown.selection > select[id="'+$id+'"] ~ div.menu').remove();
        $('select[id="'+$id+'"]').dropdown();
    }
});

//add a row 

