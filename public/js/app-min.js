$(document).ready(function(){var e=window.location.href,t=e.substr(e.lastIndexOf("/")+1);"edit"===t&&($("label[for='story_headline']").show(),$("label[for='mediaSelect']").show(),$("label[for='story_image']").show(),$("label[for='story_description']").show(),$("label[for='story_notes']").show(),$("#story_headline").show(),$("#story_image").show(),$("#addPhoto").show(),$("#story_file").show(),$("#story_description").show(),$("#projectSelect").show(),$("#addNewProject").show(),$("#mediaSelect").show(),$("#addMedia").show(),$("#story_notes").show(),$("#headline").focus()),$(document).on("keypress","form",function(e){return 13!==e.keyCode}),$("#addNewMedia").click(function(){$("#mediaModal").foundation("open")}),$("#addNewReporter").click(function(){$("#reporterModal").foundation("open")}),$("#addNewProject").click(function(){$("#projectModal").foundation("open")}),$("#clientSelect").change(function(e){$("label[for=project").show(),$("#projectSelect").show(),$("#addNewProject").show(),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),e.preventDefault(),$.ajax({url:"/ajax/get_projects",type:"POST",dataType:"json",data:{_token:$('meta[name="_token"]').attr("content"),client_id:$("#clientSelect").val()},success:function(e){$("#projectSelect").empty();for(var t=0;t<e.length;t++){var a=e[t],o="<option value='"+a.id+"' >"+a.project_name+"</option>";$("#projectSelect").append(o)}}})}),$("#btn-save-media").click(function(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),e.preventDefault(),$.ajax({url:"/ajax/create_media",type:"POST",dataType:"json",data:{_token:$('meta[name="_token"]').attr("content"),media_name:$('input[name="addMedia"').val(),media_tld:$('input[name="mediaURL"').val()},success:function(e){$("#mediaSelect").append("<option value='"+e.last_insert_id+"' >"+e.media_name+"</option>"),$("#mediaSelect").val(e.last_insert_id),$("#mediaModal").foundation("close")}})}),$("#btn-save-project").click(function(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),e.preventDefault(),$.ajax({url:"/ajax/create_project",type:"POST",dataType:"json",data:{_token:$('meta[name="_token"]').attr("content"),project_name:$('input[name="project_name"').val(),client_id:$("#clientSelect").val()},success:function(e){$("#projectSelect").append("<option value='"+e.project_id+"' >"+e.project_name+"</option>"),$("#projectSelect").val(e.project_id),$("#projectModal").foundation("close")}})}),$("#mediaSelector").change(function(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),e.preventDefault(),$.ajax({url:"/ajax/mediaupdate",type:"POST",dataType:"json",data:{_token:$('meta[name="_token"]').attr("content"),mediaID:$("#mediaSelector").val()},success:function(e){$("#reporterSelect").empty();for(var t=0;t<e.length;t++){var a=e[t],o="<option value='"+a.id+"' >"+a.firstname+" "+a.lastname+"</option>";$("#reporterSelect").append(o)}}})}),$("input[name='story_url']").change(function(){var e=$("input[name='story_url']").val();"twitter.com"==tld.getDomain(e)?($.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({url:"https://publish.twitter.com/oembed?url="+e,type:"GET",dataType:"jsonp",success:function(e){$("#twitterOembed").html(e.html)}}),$("label[for='story_notes']").show(),$("#story_notes").show(),$("#notes").focus()):($("#twitterOembed").hide(),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({url:"/ajax/get_urldata",type:"POST",data:{_token:$('meta[name="_token"]').attr("content"),story_url:$('input[name="story_url"').val()},dataType:"json",success:function(e){$("#story_headline").val(e.title),$("#ogImage").attr("src",e.image),$("#story_image").val(e.image),$("#story_description").val(e.description)}}),$("label[for='story_headline']").show(),$("label[for='mediaSelect']").show(),$("label[for='story_image']").show(),$("label[for='story_description']").show(),$("label[for='story_notes']").show(),$("#story_headline").show(),$("#story_image").show(),$("#addPhoto").show(),$("#story_file").show(),$("#story_description").show(),$("#mediaSelect").show(),$("#addMedia").show(),$("#story_notes").show(),$("#headline").focus())}),$(".twitterDisplay").each(function(){var e=$(this).html();$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({url:"https://publish.twitter.com/oembed?url="+e,type:"GET",context:this,dataType:"jsonp",success:function(e){$(this).html(e.html)}})})});