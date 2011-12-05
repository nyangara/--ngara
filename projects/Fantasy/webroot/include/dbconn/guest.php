<?
        require_once 'include/password/guest.php';
        $dbconn = pg_connect("host='localhost' dbname='Fantasy' user='Fantasy (visitante)' password='" . preg_replace("/\'/", "\\'", FANTASY_GUEST_PSQL_PASSWORD) . "'") or die('pg_connect: ' . pg_last_error());
?>
