<?php

echo "<h1>Pages</h1>";

 echo anchor('main/showShowtimes','Show Showtimes') . "<br />";
 echo anchor('main/selectMovieVenueView', 'Select Movie Venue') . "<br />";
 echo anchor('main/admin', 'Admin Page') . "<br />";

 echo "<h1>Scripts</h1>";
 
 echo anchor('main/populateTickets', "Populate Tickets") . "<br />";
 echo anchor('main/populate','Populate Database') . "<br />";
 echo anchor('main/delete','Delete Database') . "<br />";  
 
?>

