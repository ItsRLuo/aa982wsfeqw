<?php
echo "<title>U of T Theater - Home Page</title>";
echo "<h1>U of T Theater - Home Page</h1>";

echo "<h2>Pages</h2>";

#Display two option, buying tickets and admin
 echo anchor('main/selectMovieVenueView', 'Buy A Ticket') . "<br />";
 echo anchor('main/admin', 'Admin Page') . "<br />";
?>

