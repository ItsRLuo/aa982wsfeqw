<?php
	echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/graphicSeatSelection.css'>";
	echo "Hello world";
	echo form_open("main/userInformation");
	
	echo "<div class='theaterContainer'>";
	echo "<div class='leftSeat'></div>";
	echo "<div class='rightSeat rs1'></div>";
	echo "<div class='rightSeat rs2'></div>";	
	echo "</div>";
	
	echo form_close();
	
?>