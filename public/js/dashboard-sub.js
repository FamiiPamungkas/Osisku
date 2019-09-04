$(document).ready(function() {

	$('form').submit(function(event) {
		// if ($('#input-kelas').val() == '') {
		// 	alert('Form Kelas Masih fKosong');
		// 	event.preventDefault();

		// }else{
		var attr = $(this).attr('id');
		var fun = window[attr];
		// alert(url);
		if (typeof fun === "function") fun(attr);
		event.preventDefault();
		// alert('oke');

	// }

		// alert('Submitted'+attr);
	});

	


});
	
	function form_ajax(alamat,formData,ke) {
		// alert(alamat+' OKe');
		$.ajax({
			type 		: 'POST',
			url			: alamat,
			dataType	: 'json',
			data		: formData,
			success		: function(result) {
				// alert('oke');
				if ($.isEmptyObject(result.error)) {
					$('.print-error').css('display','none');
					// alert(result.success);
					refresh(ke);
				}else{
					$('.print-error').css('display','block');
					$('.print-error').html(result.error);
					// alert('eror cenah')

				}
				// refresh(ke);
				// alert('Ajax resultsss');
				// $('#ajax-kelas').html(result);
				// body...
			}
		});
		// alert(alamat);
	}

	function refresh(dari) {
		// alert(dari);
		$.ajax({
			url : dari,
			success	 : function (result) {
				$('#ajax-container').html(result);
				// body...
			}
		})
		// body...
	}

	function input_kelas(attr) {
		// alert('ooo');
		var data = {
			'kelas'		: $('[name="kelas"]').val(),
		}
		var	from = 'Admin/Parameter_kelas';
		var url = 'Admin/Input_kelas';
		form_ajax(url,data,from);
		// alert(url);
	
	}

	function import_useraaa() {
		// alert('sucasdcess');
		// 
		var kelas = $('[name="kelas"]').val();
		var file_data = $('#csv').prop('files')[0];
		var form_data = new FormData();

		form_data.append('file', file_data);
		form_data.append('kelas', kelas);
		// alert(kelas);
		var to = 'Admin/Input_user_import';
		var from = 'Admin/Import_user';
		$.ajax({
			url			: to,
			dataType	: 'script',
			cache 	: false,
			contentType	: false,
			processData : false,
			data 		: form_data,
			type 		:'post',
			success 	: function (result) {
				// alert(to);
				// body...
				// alert('berhasil');

				$('#ajax-container').html(result);
			}
		});
	}