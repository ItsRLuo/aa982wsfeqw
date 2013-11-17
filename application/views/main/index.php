<?php
echo "<title>U of T Theater - Home Page</title>";
echo "<h1>U of T Theater - Home Page</h1>";

echo "<h2>Pages</h2>";

 echo anchor('main/showShowtimes','Show Showtimes') . "<br />";
 echo anchor('main/selectMovieVenueView', 'Buy A Ticket') . "<br />";
 echo anchor('main/admin', 'Admin Page') . "<br />";

 echo "<h2>Scripts</h2>";
 
 echo anchor('sqlcontroller/populateTicketTables', "Populate Ticket Table") . "<br />";
 echo anchor('sqlcontroller/populateMainTables', 'Populate Database') . "<br />";
 echo anchor('sqlcontroller/deleteMainTables', 'Delete Database') . "<br />";  
 
?>

