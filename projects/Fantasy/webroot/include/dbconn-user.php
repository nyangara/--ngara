<?
        include_once 'include/password-user.php';
        $dbconn = pg_connect("host='localhost' dbname='Fantasy' user='Fantasy (usuario normal)' password='" . preg_replace("/\'/", "\\'", FANTASY_USER_PSQL_PASSWORD) . "'") or die('pg_connect: ' . pg_last_error());
?>
