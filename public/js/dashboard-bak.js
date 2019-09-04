$(document).ready(function () {
	$('#user_list').click(function() {
		show_user();
	});

	$('#import_user').click(function() {
		id	= $('#import_user').attr('data');
		// alert(id);
		show_ajax(id);
	});

	container_size();

	
});

function show_ajax(id) {
	$.ajax(
	{
		url:"Admin/"+id,
		success: function(result) {
			$('#dashboard').html(result);
			// body...
		}
	}

	)
}

function show_user() {
	$.ajax(
	{
		url:"Admin/Lihat_user",
		success: function(result) {
			$('#dashboard').html(result);
			// body...
		}
	}

	)
};

function container_size() {
	var a = $(document).height();
	height = a*70/100;
	// alert(height);
	$('.ajax-loading').height(height);
	// body...
}