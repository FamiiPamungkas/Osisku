$(document).ready(function () {


	Countdown();
	// body...
});

function Countdown() {
	$('#timeout').hide();
	setInterval(function () {
		now = new Date();
		target = new Date('31/12/2018');

		interval = target-now;

		hari = Math.floor(interval/(60*60*1000*24));
		jam  = Math.floor(interval%(60*60*1000*24)/(60*60*1000));
		menit  = Math.floor(interval%(60*60*1000*24)%(60*60*1000)/(60*1000));
		detik  = Math.floor(interval%(60*60*1000*24)%(60*60*1000)%(60*1000)/(1000));
		$('#countdown-hari').html(hari);
		$('#countdown-jam').html(jam);
		$('#countdown-menit').html(menit);
		$('#countdown-detik').html(detik);		

		if (interval<1) {
			$('.countdown-time').hide();
			$('#timeout').show();	
		}						

	},1000);
	
}