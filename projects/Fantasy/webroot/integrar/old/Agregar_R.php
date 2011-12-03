<?php

$id_Manager=0;
$_POST['manager']=$id_Manager;

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['Aplicar'])){
    date_default_timezone_set('America/Caracas');
    
    $_POST['fecha_creacion'] = date("d/m/Y H:i:s");
    unset($_POST['Aplicar']);

    $instancia->insertar();

    //header('Location: gestion_rosters.php'); 
	
}
unset($_POST);

include("Static/head.php");
include("Static/header.php");
?>

<link rel="stylesheet" href="assets/styles/style_Modificar_J.css"  type="text/css" />


	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a class="on" href="gestion_rosters.php">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>

    <div id="content">
		
        <div id="contenido_interno">
            <div id="box_info">
                <form id="Alcance" action="Agregar_R.php" method="post">
                    
                    <label for="nombre"> Nombre del Roster:  </label>
                    <input name="nombre" id="nombre" type="text" value="" />
                    
                    <input type="hidden" name="TIPO" value="Roster" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	
?>