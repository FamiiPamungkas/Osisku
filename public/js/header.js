FontAwesomeConfig = { autoReplaceSvg: 'nest' }
$(document).ready(function () {
	// body...
	$('#mobile-nav-check').click(function() {
		// body...
		// alert('ok');
		if ($('#mobile-nav-check').prop('checked')==false) {
			$('.nav-absolute').hide();
			// $('.mobile-nav').css('position','relative');
			// $('section').css('margin-top','0');
		}else{
			$('.nav-absolute').show();
			$('.mobile-nav').css('position','fixed');
			// $('section').css('margin-top','70px');
		}

	});
	
});
