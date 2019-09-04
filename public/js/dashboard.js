$(document).ready(function () {
	
	$(document).ajaxStart(function () {
		// alert('Ajax jalan');
		$('.ajax-loading').css('display','block');
	});

	$(document).ajaxComplete(function () {
		$('.ajax-loading').css('display','none');

		var result = $('.ajax-result').attr('data-ajax');
		// alert(result);
		$('[data-class="'+result+'"]').addClass('nav-active');

		var parent = $('[data-class="'+result+'"]').attr('data-parent-menu');
		$('[data-class-parent="'+parent+'"]').addClass('nav-active-parent');
	});

	$('.side-menu').click(function() {
		$('.side-menu').removeClass('nav-active');
		$('.panel-title').removeClass('nav-active-parent');
		// $('.side-menu-parent').removeClass('nav-active-parent');
		var attr = $(this).attr('data-class');
		var data = attr.charAt(0).toUpperCase() + attr.slice(1);
    var param = $(this).attr('data-param');		
		show_ajax(data,param);
	});



	show_ajax('Overview');
	container_size();
});

function show_ajax(data,param) {
  // alert("Admin/"+data+'/'+param);
	$.ajax(
	{
		url:"Admin/"+data,
		success: function(result) {
			$('#ajax-container').html(result);
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
	var height = a*70/100;
	// alert(height);
	$('.ajax-loading').height(height);
	// body...
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}