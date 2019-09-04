$(document).ready(function () {

});

function Countdown() {

	setInterval(
		function () {
			mulai = $('[name="tgl_akhir"]').val();
			start = new Date(mulai);
			now = new Date();
			int = now - start;
			
			hari = Math.floor(int/(60*60*1000*24));
			jam  = Math.floor(int%(60*60*1000*24)/(60*60*1000));
			menit  = Math.floor(int%(60*60*1000*24)%(60*60*1000)/(60*1000));
			detik  = Math.floor(int%(60*60*1000*24)%(60*60*1000)%(60*1000)/(1000));

			$('#cd-hari').html(hari);
			$('#cd-jam').html(jam);
			$('#cd-menit').html(menit);
			$('#cd-detik').html(detik);		

			// $('#hari').html();
			if (int<0) {
				location.reload();
			}
		}
		,1000);

}