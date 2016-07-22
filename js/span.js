//mylink - class for span without property target=_blank (for open new page in the new window)	
jQuery(document).ready(function($) {
	$('.seolink').replaceWith(function(){
		return '<a href="' + $(this).attr('rel')
			    + '" title="' + $(this).attr('title')
	    		    + '">' + $(this).html() + '</a>';
	});
	$('.seolink_target').replaceWith(function(){
		return '<a href="' + $(this).attr('rel')
			    + '" title="' + $(this).attr('title')
	    		    + '"target=_blank>' + $(this).html() + '</a>';
	});
});
