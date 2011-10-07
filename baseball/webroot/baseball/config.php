<?
error_reporting(E_ALL);
$dbconn = pg_connect("host=localhost dbname=Baseball user=Baseball password=klasd864") or die('Could not connect: ' . pg_last_error());
?>
