<?
include "password.php";
$dbconn = pg_connect("host='localhost' dbname='TriplePlay' user='TriplePlay' password='" . TRIPLEPLAY_PSQL_PASSWORD . "'") or die('pg_connect: ' . pg_last_error());
?>
