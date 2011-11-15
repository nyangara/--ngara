<?php

require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachade.php");
require_once("Clases/EstadioFachade.php");

$ID_Equipo = isset($_POST['idequipo'])?$_POST['idequipo']:-1;

$FachadaE = new EquipoFachade();
$FachadaEstadio = new EstadioFachade();

$Equipo = $FachadaE->getEquipo($ID_Equipo);

include("Static/head.php");
include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_Es.css"  type="text/css" />

<?php

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li class="on"><a href="gestion_equipos.php">Equipos</a></li>
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
		<div id="contenido_interno_datos">';

echo'
		<div id="box_info">

		
            <form id="Alcance">
                <div id="Foto">
                	<img src="assets/images/Fotos_Equipos/generico.jpg" />
                </div>
                
                <div id="InfBas">
                	
                    <div>
                        <label for="siglas">Siglas: </label>
                        <input size="10" type="text" name="siglas" id="siglas" value="'.$Equipo->getSiglas().'"  readonly/>                    
                    </div>
                
                    <div>
                        <label for="nombre">Nombre del Equipo: </label>
                        <input size="10" type="text" name="nombre" id="nombre" value="'.$Equipo->getnombre().'"  readonly/>
                    </div>
                    

                    
                    <div>
                        <label for="fecha_fundacion">Fecha de Fundacion: </label>
                        <input size="10" type="text" name="fecha_fundacion" id="fecha_fundacion" value="'.$Equipo->getFecha_fundacion().'"  readonly/>                    
                    </div>     
                    
                    <div>
                        <label for="home">Casa: </label>
                        <input size="10" type="text" name="home" id="home" value="'.$FachadaEstadio->getNombre($Equipo->gethome()).'"  readonly/>                    
                    </div>                                                           
                </div>
                <div id="InfExt">
                
                                       
                </div>
            </form>	
      </div>      
		<div id="env" >
		
			<form action="gestion_equipos.php" method="post">
				<input type="submit" value="Regresar"/>
			</form>
		
			<form action="Listar_D_Eq.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Equipo->getId().'" />
				<input type="submit" name="Detalles" value="Ver Detalles"  />        
			</form>
		
			<form action="Modificar_Eq.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Equipo->getId().'" />
				<input type="submit" name="Modificar" value="Modificar"  />      
			</form>			
		
			<form action="Modificar_Eq.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Equipo->getId().'" />
				<input type="submit" name="Eliminar" value="Eliminar"  />      
			</form>			
		
		</div>
		      
	';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");	

?>
