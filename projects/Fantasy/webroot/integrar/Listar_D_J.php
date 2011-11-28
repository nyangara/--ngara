<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

$id = $_POST['id'];
$posicion = $_POST['posicion'];
unset($_POST);

if($posicion=='P')
    $_POST['TIPO']='Estadistica_Pitcheo';
else
    $_POST['TIPO']='Estadistica_Bateo';
$_POST['jugador']=$id;
$Estadisticas = $instancia->obtenerTodos();


include("Static/head.php");
include("Static/header.php");



echo '<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />'; 

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno_esta">';
		
		echo '<form id="form" action="Agregar_E.php" method="post">
				<input type="hidden" name="id" value="'.$id.'"/>
		        <input type="submit" value="Agregar Estadistica" />
		      </form>';
		
		echo '<h2>Estadisticas</h2>';
                  for($i=0;$i<count($Estadisticas);$i++){
                        $Tmp = $Estadisticas[$i];
                                echo'
                                          <div class="Fila">
                                                <div class="datos">';
                                         
                                                       echo '<div> DATOS </div>';
                                                        
                                echo'		</div>

                                                        <form action="Modificar_E.php" method="post">
                                                                <input type="hidden" name="id" value="'.$Tmp->id.'"/>
                                                                <input type="submit" name="Modificar" value="Modificar Estadistica" />										
                                                        </form>

                                                        <form action="Modificar_E.php" method="post">
                                                                <input type="hidden" name="id" value="'.$Tmp->id.'"/>
                                                                <input type="submit" name="Eliminar" value="Eliminar Estadistica" />																				
                                                        </form>


                                          </div>
                                        ';
                  }
				  
		
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>