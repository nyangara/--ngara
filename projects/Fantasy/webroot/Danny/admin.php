<?php

include_once "Juego.php";

////////////////////////////////////////////////////////////////////////////////
if ($_POST['submit']) {
$fecha = $_POST["year"] . '-' . $_POST["month"] . '-' . $_POST["day"] . ' ' . $_POST["hour"] . ':' . $_POST["minute"] . ' ' . $_POST["am_pm"];
$juego = new Juego(array($fecha, $_POST["equipo_local"], $_POST["equipo_visitante"], $_POST["estadio"]));
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

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el equipo local: ';
echo '<select name="equipo_local">';

$database = Database::getInstance();

$equipos = $database->select(array('"nombre corto"'), '"Fantasy"."Equipo"', NULL);

$n = count($equipos, 0);
$i = 0;

while ($i < $n) {
  $equipo = $equipos[$i][0];
  echo '<option value="' . $equipo . '">' . $equipo . '</option>';
  $i += 1;
}

echo '</select></td></tr>';

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el equipo visitante: ';
echo '<select name="equipo_visitante">';

$i = 0;

while ($i < $n) {
  $equipo = $equipos[$i][0];
  echo '<option value="' . $equipo . '">' . $equipo . '</option>';
  $i += 1;
}

echo '</select></td></tr>';

echo '<tr><td style="border: 1px solid #cccccc">Seleccione el estadio: ';
echo '<select name="estadio">';

$estadios = $database->select(array('"nombre"'), '"Fantasy"."Estadio"', NULL);

$n = count($estadios, 0);
$i = 0;

while ($i < $n) {
  $estadio = $estadios[$i][0];
  echo '<option value="' . $estadio . '">' . $estadio . '</option>';
  $i += 1;
}

echo '</select></td></tr>';

echo '<tr><td style="border: 1px solid #cccccc"><input name="submit" type="submit" /></td></tr>';

echo '</form>';

echo '</table>';
echo '</div>';

////////////////////////////////////////////////////////////////////////////////

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

