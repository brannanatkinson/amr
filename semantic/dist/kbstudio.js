jQuery(document).ready(function($){
	$('.masonry').masonry({
      // options
      itemSelector: '.masonry-item',
      //columnWidth: 200
    });
});
// SETTING THE HOMEPAGE HERO
jQuery(document).ready(function($) {    

	var theWindow        = $(window),
	    $bg              = $("#kbs__homepagehero"),
	    aspectRatio      = $bg.width() / $bg.height();
	//console.log('working');
	    			    		
	function resizeBg() {
		
		if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
		    $bg
		    	.removeClass()
		    	.addClass('bgheight');
		    $("#kbs__homepagegrid").css('height', $bg.height()-$('#kbs__mainmenu').height()-100);
		} else {
		    $bg
		    	.removeClass()
		    	.addClass('bgwidth');
		    $("#kbs__homepagegrid").css('width', $bg.width()-$('#kbs__mainmenu').height()-100);
		}
					
	}
	                   			
	theWindow.resize(resizeBg).trigger("resize");

});











