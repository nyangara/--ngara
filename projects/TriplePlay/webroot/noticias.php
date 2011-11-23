<?
include_once "config.php";
include_once "dbconn.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Noticias</title>
<style type="text/css">
<!--
body {
	background-color: #333;
}
-->
</style>
<style type="text/css">
<!--
a:link {
	color: #708403;
}
a:visited {
	color: #FFDDEE;
}
a:hover {
	color: #FFFFFF;
}
a:active {
	color: #FFFFFF;
}
body,td,th {
	color: #FFFFFF;
}
-->
</style></head>

<body>
<?
include_once "config.php";
include_once "dbconn.php";

echo '
<div id="Layer1" style="width:580px; height:500px; overflow: scroll;">';

	echo '<table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">';
        $query = <<<'EOD'
                SELECT
                        "urlimg",
                        "titulo",
                        "contenido",
			"fecha"
                FROM
                        "Noticia"
EOD;

        $result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());
        while ($row = pg_fetch_row($result)) {
		echo '<tr><td><img src="' . $row[0] . '"></img><td>';
                echo '<td><h3 >' . $row[1] . '</h3><p>' . $row[2] . '</p>';
		echo '<p><small>' . $row[3] . '</small></p></td></tr>';
        }
                
             
        pg_free_result($result);

	echo '</table></div>';
?>
</body>
</html>
