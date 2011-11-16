<?php
require_once("Clases/Estadio.php");
require_once("Clases/EstadioFachada.php");

$ID_Estadio = isset($_POST['idestadio'])?$_POST['idestadio']:-1;
$FachadaE = new EstadioFachada();
$Estadio = $FachadaE->getEstadio($ID_Estadio);

include("Static/head.php");
include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_Es.css"  type="text/css" />

<?php

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li class="on"><a href="gestion_estadios.php">Estadios</a></li>
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
                	<img src="assets/images/Fotos_Estadios/generico.jpg" />
                </div>
                
                <div id="InfBas">
                    <div>
                        <label for="nombre">Nombre del Estadio: </label>
                        <input size="10" type="text" name="nombre" id="nombre" value="'.$Estadio->getnombre().'"  readonly/>
                    </div>
                    
                    <div>                    
                        <label for="ubicacion">Ubicacion: </label>
                        <input size="50" type="text" name="ubicacion" id="ubicacion" value="'.$Estadio->getubicacion().'"  readonly/>
                    </div>
                    
                    <div>
                        <label for="propietario">Propietario: </label>
                        <input size="10" type="text" name="propietario" id="propietario" value="'.$Estadio->getpropietario().'"  readonly/> 
                        <label for="fecha_fundacion">Fecha de Fndacion: </label>
                        <input size="10" type="text" name="fecha_fundacion" id="fecha_fundacion" value="'.$Estadio->getfecha_fundacion().'"  readonly/>                    
                    
                    </div>                                         
                </div>
                <div id="InfExt">
                
                    <div>
                        <label for="mlf">Medida del Left Field: </label>
                        <input size="10" type="text" name="mlf" id="mlf" value="'.$Estadio->getmedida_left_field().'"  readonly/>   
					</div>
					
					<div>
                        <label for="mcf">Medida del Center Field: </label>
                        <input size="10" type="text" name="mcf" id="mcf" value="'.$Estadio->getmedida_center_field().'"  readonly/>                 
                    </div>
                    
                    <div>
                        <label for="mrf">Medida del Right Field: </label>
                        <input size="10" type="text" name="mrf" id="mrf" value="'.$Estadio->getmedida_right_field().'"  readonly/>                 
                        <label for="tt">Tipo de Terreno: </label>
                        <input size="10" type="text" name="tt" id="tt" value="'.$Estadio->gettipo_terreno().'"  readonly/>                 
                    </div>                                            
                </div>
            </form>	
		</div>            
		<div id="env" >
		
			<form action="gestion_estadio.php" method="post">
				<input type="submit" value="Regresar"/>
			</form>
		
			<form action="Listar_D_Es.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Estadio->getId().'" />
				<input type="submit" name="Detalles" value="Ver Detalles"  />        
			</form>
		
			<form action="Modificar_Es.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Estadio->getId().'" />
				<input type="submit" name="Modificar" value="Modificar"  />      
			</form>			
		
			<form action="Modificar_Es.php" method="post">
				<input type="hidden" name="idjugador" id="idjugador" value="'.$Estadio->getId().'" />
				<input type="submit" name="Eliminar" value="Eliminar"  />      
			</form>			
		
		</div>
		      


	';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");	

?>
