<?php
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
          <li class="on"><a href="index.php">Inicio</a></li>
          <li><a href="#">Jugadores</a></li>
          <li><a href="#">Equipos</a></li>
          <li><a href="#">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
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
    <div id="contenido_interno">';

// CODIGO PHP //////////////////////////////////////////////////////////////////

include_once "include/config.php";
include_once "include/dbconn.php";

//echo '<div id="Layer1" style="width:580px; height:500px; overflow: scroll;">';
echo '<table width="100%" border="1" cellspacing="10" cellpadding="10" align="left">';

$query = <<<'EOD'
SELECT
  juego.inicio,
  equipo1."nombre corto" AS "equipo local",
  equipo2."nombre corto" AS "equipo visitante",
  estadio."nombre" AS "estadio"
FROM
  "Fantasy"."Juego" AS juego
  JOIN "Fantasy"."Equipo" AS equipo1 ON juego."equipo local" = equipo1.id
  JOIN "Fantasy"."Equipo" AS equipo2 ON juego."equipo visitante" = equipo2.id
  JOIN "Fantasy"."Estadio" AS estadio ON juego."estadio" = estadio.id;
EOD;

$result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

while ($row = pg_fetch_row($result)) {
  echo '<tr>';
  echo '<td>' . $row[0] . '</td>';
  echo '<td>' . $row[1] . '</td>';
  echo '<td>' . $row[2] . '</td>';
  echo '<td>' . $row[3] . '</td>';
  echo '</tr>';
}

pg_free_result($result);

echo '</table>';
//echo '</div>';

////////////////////////////////////////////////////////////////////////////////

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

