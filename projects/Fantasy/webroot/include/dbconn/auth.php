<?php
        require_once 'include/password/auth.php';
        $dbconn = pg_connect("host='localhost' dbname='Fantasy' user='Fantasy (autenticación)' password='" . preg_replace("/\'/", "\\'", FANTASY_AUTH_PSQL_PASSWORD) . "'") or die('pg_connect: ' . pg_last_error());
?>
