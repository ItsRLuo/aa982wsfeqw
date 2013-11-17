<?php
echo "<h1>U of T Theater - Admin</h1>";

echo "<h2>Populate and Delete Tables</h2>";

echo anchor('main/populate', 'Populate Movie, Theater, and Showtime Tables') . "<br />";
echo anchor('main/delete', 'Delete Movie, Theater, and Showtime Tables') . "<br /><br />";

echo anchor('sqlcontroller/populateTicketTables', 'Populate Ticket Table') . "<br />";
echo anchor('sqlcontroller/deleteTicketTables', 'Delete Ticket Table') . "<br />";
echo anchor('main/ticketInfo', 'Display Ticket Table') . "<br /><br />";

// echo anchor('', 'Populate Theater Table') . "<br />";
// echo anchor('', 'Delete Theater Table') . "<br />";
// echo anchor('', 'Display Theater Table') . "<br /><br />";

// echo anchor('', 'Populate Showtime Table') . "<br />";
// echo anchor('', 'Delete Showtime Table') . "<br />";
echo anchor('main/showShowtimes', 'Display Showtime Table') . "<br /><br />";

// echo anchor('', 'Populate Movie Table') . "<br />";
// echo anchor('', 'Delete Movie Table') . "<br />";
// echo anchor('', 'Display Movie Table') . "<br /><br />";
?>