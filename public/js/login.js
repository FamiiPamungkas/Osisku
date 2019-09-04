$(document).ready(function () {
	// alert('Oke');

	login_align();
	$('input').focus(function() {
		// $('.error_message').fadeOut();
			resize_main();
	});

});

function login_align() {
	// $('section').height() = $(document).height()/2;
	sh	=	$(document).height()/1.5;
	$('section').css('height',sh);
	var a = $('.form-login').height();
	var b = $('section').height();
	var c = (b-a)/2-25;
	var d = $(document).height();
	var e = (d-100-$('section').height())/2-10;
	
	$('section').css('margin-top',e);
	$('.form-panel').css('height',sh);
	$('.form-login').css('margin-top',c);
	$('.form-login').css('margin-bottom',c);	
	// body...
}