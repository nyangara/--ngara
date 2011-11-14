<?php

////////////////////////////////////////////////////////////////////////////////

if ($_POST['submit']) {

include_once "include/config.php";
include_once "include/dbconn.php";

// execute query
$query = <<<'EOD'
INSERT INTO 
  "Fantasy"."Juego" ("inicio", "equipo local", "equipo visitante", "estadio")
SELECT 
  to_timestamp(Data."inicio", 'YYYY/MM/DD HH12:MI AM'),
  Equipo_local.id,
  Equipo_visitante.id,
  Estadio.id
FROM
  "Fantasy"."Equipo" AS Equipo_local,
  "Fantasy"."Equipo" AS Equipo_visitante,
  "Fantasy"."Estadio" AS Estadio,
  (VALUES ($1, $2, $3, $4)) AS Data ("inicio", "equipo_local", "equipo_visitante", "estadio")
WHERE
   Data.equipo_local = Equipo_local."nombre corto" AND
   Data.equipo_visitante = Equipo_visitante."nombre corto" AND
   Data.estadio = Estadio.nombre;
EOD;

$result = pg_prepare($dbconn, "juego", $query) or die('pg_prepare: ' . pg_last_error());

$date_time = pg_escape_string($_POST["year"]) . '-' . pg_escape_string($_POST["month"]) . '-' . pg_escape_string($_POST["day"]) . ' ' . pg_escape_string($_POST["hour"]) . ':' . pg_escape_string($_POST["minute"]) . ' ' . pg_escape_string($_POST["am_pm"]);

$result = pg_execute($dbconn, "juego", array($date_time, pg_escape_string($_POST["equipo_local"]), pg_escape_string($_POST["equipo_visitante"]), pg_escape_string($_POST["estadio"]))) or die('pg_execute: ' . pg_last_error());

if (!$result) {
  die("Error in SQL query: " . pg_last_error());
}

else {
  echo "Data successfully inserted!";
  header('Location: calendario.php');
}

// free memory
pg_free_result($result);

// close connection
pg_close($dbh);

}

////////////////////////////////////////////////////////////////////////////////

include("Static/head.php");
include("Static/header.php");
echo '
<!--Menu de Navegación-->

    <!-- COMO USAR MENU DE NAVEGACION 
    Se debe cambiar el codigo que dice class="on", dependiendo
    de la pestania que se quiere seleccionar. Ejemplo:
    
    Trabajo en Estadios, entonces mi codigo se vera asi:
    <li class="on"><a href="_________">Estadios</a></li>
    y debemos quitar la class="on" de donde la teniamos
    (en este ejemplo esta en Inicio).-->
  
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="#">Jugadores</a></li>
          <li><a href="#">Equipos</a></li>
          <li><a href="#">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li class="on"><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>
  <!--Final del header-->

  
  <!-- Area de trabajo:
  Despues de el Div content, hay un div id="contenido_interno",
  dentro de este ira el codigo php con los formularios o
  lo que se necesite para que se cumpla la funcion determinada.
  
  En caso de que el tamanio no sea suficiente, en style.css
  modificar: 
  #content           ----  height
  #content #contenido_interno  ----  height
  -->
     
  <div id="content">
    <div id="contenido_interno" style="height: auto">';

// CODIGO PHP //////////////////////////////////////////////////////////////////

include_once "include/config.php";
include_once "include/dbconn.php";

echo '<div style="height:500px; overflow-y: scroll;">';

echo '<table width="100%" border="0" cellspacing="5" cellpadding="5" align="left" style="color: #cccccc">';
echo '<tr><th style="border: 2px solid #cccccc">Agregar juego</th></tr>';

echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';

echo '<tr><td style="border: 1px solid #cccccc">Introduzca la fecha: ';
echo '<select name="day">';

$now = date('d');
$i = 1;

while ($i <= 31) {
  echo '<option value="' . $i . '"';
  
  if ($i == $now) {
    echo 'selected="selected"';
  }
  
  echo '>';
  
  if ($i >= 0 & $i < 10) {
    echo '0';
  }
  
  echo $i . '</option>';
  $i++;
}

echo '</select> / <select name="month">';

$now = date('n');
$i = 1;

while ($i <= 12) {
  echo '<option value="' . $i . '"';
  
  if ($i == $now) {
    echo 'selected="selected"';
  }
  
  echo '>';
  
  if ($i >= 0 & $i < 10) {
    echo '0';
  }
  
  echo $i . '</option>';
  $i++;
}

echo '</select> / <select name="year">';

$i = 1;
$y = date('Y');

while ($i <= 3) {
  echo '<option value="' . $y . '">' . $y . '</option>';
  $i++;
  $y++;
}

echo '</select>';
echo '</td></tr>';

echo '<tr><td style="border: 1px solid #cccccc">Introduzca la hora: ';
echo '<select name="hour">';

$now = date('h');
$i = 1;

while ($i <= 12) {
  echo '<option value="' . $i . '"';
  
  if ($i == $now) {
    echo 'selected="selected"';
  }
  
  echo '>';
  
  if ($i >= 0 & $i < 10) {
    echo '0';
  }
  
  echo $i . '</option>';
  $i++;
}

echo '</select>:<select name="minute">';

$now = date('i');
$i = 0;

while ($i <= 60) {
  echo '<option value="' . $i . '"';
  
  if ($i == $now) {
    echo 'selected="selected"';
  }
  
  echo '>';
  
  if ($i >= 0 & $i < 10) {
    echo '0';
  }
  
  echo $i . '</option>';
  $i++;
}

echo '</select> <select name="am_pm">';

$now = date('A');

echo '<option value="AM"'; 
if ($now == "AM") {
  echo 'selected="selected"';
}
echo '>AM</option>';

echo '<option value="PM"'; 
if ($now == "PM") {
  echo 'selected="selected"';
}
echo '>PM</option>';

echo '</select>';

echo '</td></tr>';

$query = <<<'EOD'
SELECT "nombre corto"
FROM "Fantasy"."Equipo"
EOD;

$result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el equipo local: ';
echo '<select name="equipo_local">';

$i = 0;

while ($row = pg_fetch_row($result)) {
  echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
  $i++;
}

echo '</select></td></tr>';

pg_free_result($result);

$result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el equipo visitante: ';
echo '<select name="equipo_visitante">';

$i = 0;

while ($row = pg_fetch_row($result)) {
  echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
  $i++;
}

echo '</select></td></tr>';

pg_free_result($result);

$query = <<<'EOD'
SELECT "nombre"
FROM "Fantasy"."Estadio"
EOD;

$result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el estadio: ';
echo '<select name="estadio">';

$i = 0;

while ($row = pg_fetch_row($result)) {
  echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
  $i++;
}

echo '</select></td></tr>';

pg_free_result($result);

echo '<tr><td style="border: 1px solid #cccccc"><input name="submit" type="submit" /></td></tr>';

echo '</form>';

echo '</table>';
echo '</div>';

////////////////////////////////////////////////////////////////////////////////

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

