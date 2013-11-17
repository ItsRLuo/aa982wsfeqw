<?php
echo "<h1>U of T Theater - Admin</h1>";

echo anchor('main/populate','Populate Database') . "<br />";
echo anchor('main/delete','Delete Database') . "<br />";
echo anchor('main/ticketInfo', 'Display List of All Tickets Sold');
?>