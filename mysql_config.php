<?php
include_once ('includes/MySQLe.class.php');
$mysqli = new mysqle('localhost', 'root', 'PASSWORD', 'Database');
$mysqli->query("SET NAMES latin2");
$mysqli->query("SET CHARACTER SET latin2");
$mysqli->query("SET collation_connection = latin2_general_ci");
?>
