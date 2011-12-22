<?php
        require_once 'include/password/admin.php';
        $dbconn = pg_connect("host='localhost' dbname='Fantasy' user='Fantasy (administrador)' password='" . preg_replace("/\'/", "\\'", FANTASY_ADMIN_PSQL_PASSWORD) . "'") or die('pg_connect: ' . pg_last_error());
?>
