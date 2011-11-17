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
          <li><a href="reglas.php">Reglas</a></li>
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
	#content					 ----  height
	#content #contenido_interno  ----  height
	-->
	   
	<div id="content">
		<div id="contenido_interno">';
		
include_once "config.php";
include_once "dbconn.php";

echo '
<div id="Layer1" style="width:580px; height:500px; overflow: scroll;">';
	if (array_key_exists('consult',$_POST) && $_POST['consult']) {
	echo date("Y-m-d: H:i:s").'<br>';
	echo '
		<form action="index.php" method="POST" id="insertar_noticia">
		<input type="hidden" name="consult" value="1"/>
			<select name="filtro">
				<option value="1">Noticias por Jugador.
				<option value="2">Noticias por Equipo.
				<option value="3">Noticias por Equipo.
		        </select>
		</form>		
	';

	echo '<table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">';

        $query = <<<'EOD'
                SELECT
                        "urlimg",
                        "titulo",
                        "contenido",
			"fecha"
                FROM
                        "Noticia","Jugador"
		WHERE
			"Noticia"."titulo" = "Jugador"."articulo"
		ORDER BY
			"fecha" DESC
EOD;

        $result = pg_prepare($dbconn, "noticia", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "noticia") or die('pg_execute: ' . pg_last_error());
        while ($row = pg_fetch_row($result)) {
		echo '<tr><td><img src="' . $row[0] . '"></img><td>';
                echo '<td width="50px"><h3 >' . $row[1] . '</h3><p>' . $row[2] . '</p>';
		echo '<p><small>' . $row[3] . '</small></p></td></tr>';
        }
                
             
        pg_free_result($result);

}else{
	echo date("Y-m-d: H:i:s").'<br>';
	echo '
		<form action="index.php" method="POST" id="insertar_noticia">
		<input type="hidden" name="consult" value="1"/>
			<select name="filtro">
				<option value="1">Noticias por Jugador.
				<option value="2">Noticias por Equipo.
				<option value="3">Noticias por Equipo.
		        </select>
		</form>		
	';

	echo '<table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">';

        $query = <<<'EOD'
                SELECT
                        "urlimg",
                        "titulo",
                        "contenido",
			"fecha"
                FROM
                        "Noticia"
		WHERE
			"fecha" <= $1
		AND
			"fecha" >= $2
		ORDER BY
			"fecha" DESC
EOD;

        $result = pg_prepare($dbconn, "noticia", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "noticia", array(date('Y-m-d'),date('Y-m-d', strtotime("-3 days")) )) or die('pg_execute: ' . pg_last_error());
        while ($row = pg_fetch_row($result)) {
		echo '<tr><td><img src="' . $row[0] . '"></img><td>';
                echo '<td width="50px"><h3 >' . $row[1] . '</h3><p>' . $row[2] . '</p>';
		echo '<p><small>' . $row[3] . '</small></p></td></tr>';
        }
                
             
        pg_free_result($result);
}
	echo '</table></div>';


		
		
		
		
		
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

