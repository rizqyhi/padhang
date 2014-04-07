// custom theme function
jQuery(document).ready(function($){
	var url = $('body.custom-background').css('background-image');
	url = url.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
	
	// init the Backstretch
	$.backstretch( url );
});