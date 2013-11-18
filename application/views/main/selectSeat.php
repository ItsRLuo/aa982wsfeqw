<?php
	/*
	 * This page is to let the user select a seating arrangement.
	 */

	echo "<h1>Select a Seat: </h1>";
	echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/graphicSeatSelection.css'>";
	echo "<script src=" . base_url() . "scripts/graphicSeatSelection.js></script>";
	
	echo form_open("main/userInformation");
	
	#This has the 3 seats
	echo "<div class='theaterContainer'>";
		echo "<div class='seat leftSeat seat1' value='1'></div>";
		echo "<div class='seat rightSeat rs1 seat3' value='3'></div>";
		echo "<div class='seat rightSeat rs2 seat2' value='2'></div>";
		
	echo "</div><br/>";
	
	#Sumbit the position of the seat the user will be sitting
	echo form_submit(array("name" => "Select seat", "value" => "Select seat", "id" => "submitSeatButton"));
	
	echo form_hidden("seatNo", "1");
	echo form_close();
	echo "<p class='seatsLeftError'></p>";

?>
<script>
$(document).ready(function() {
	var js_array = [<?php echo implode(',', $tickets_remaining) ?>];
	var seatStr = ".seat";

	
	$(seatStr).addClass("occupied");
	
	for (var i = 0; i < js_array.length; i++) {
		var classStr = seatStr.concat(js_array[i].toString());
		$(classStr).removeClass("occupied").addClass("vacant");
	}

	if (js_array.length == 0) {
		alert("Something's wrong...we're not considering theaters with no seats available..");
	} else {
		var minSeat = Math.min.apply(null, js_array);
		var classStr = seatStr.concat(minSeat.toString());
		$(classStr).addClass("selected");
	}

	$(".seat").bind("click", function() {
		if ($(this).hasClass("vacant")) {
			$(".selected").addClass("vacant");
			$(".selected").removeClass("selected");
			$("[name='seatNo']").attr("value", $(this).attr("value"));
			$(this).addClass("selected");
			$(this).removeClass("vacant");
		}
	});

	
});
</script>