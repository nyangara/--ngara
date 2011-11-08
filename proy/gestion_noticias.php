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
          <li class="on"><a href="gestion_noticias.php">Gesti&oacute;n Noticias</a></li>
          <li><a href="#">Jugadores</a></li>
          <li><a href="#">Equipos</a></li>
          <li><a href="#">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Gesti&oacute;n Reglas</a></li>
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
	echo date("Y-m-d: H:i:s").'<br>';
	echo '
	<table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">
		<form action="gestion_noticias" method="POST" id="insertar_noticia">
		        <input type="hidden" name="insert" value="1"/>

		        <table border="0" style="text-align:left;" cellpadding="5px;" >
		                <tr>
		                        <td>Titulo:</td>
		                        <td><input type="text" size="40" name="titulo" id="titulo"></td>
		                </tr>
		                <tr>
		                        <td>Contenido:</td>
		                        <td><textarea cols="40" rows="5" name="contenidoN" id="contenidoN"></textarea></td>
		                </tr>
		                <tr>
		                        <td>Url im&aacute;gen:</td>
		                        <td><input type="text" size="30" name="url" id="url"></td>
		                </tr>
		                <tr>
		                        <td colspan="2" style="text-align:center;">
		                                <input type="submit" value="Agregar" style="font-weight:bold; width:100px; height:30px; color:white; background-color:#708403;">
		                        </td>
		                </tr>
		        </table>
		</form>
	</table>
	</div>';

if (array_key_exists('insert',$_POST) && $_POST['insert']) {
        $query = <<<'EOD'
		INSERT INTO 
			"Noticia" ("urlimg", "titulo", "contenido","fecha")
		VALUES
        		($1, $2, $3, $4)
EOD;

        $result = pg_prepare($dbconn, "inoticia", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "inoticia", array($_POST['url'],$_POST['titulo'],$_POST['contenidoN'],date('Y-m-d')) ) or die('pg_execute: ' . pg_last_error());
        pg_free_result($result);
}
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

