<?php

require_once("Clases/Estadio.php");
require_once("Clases/EstadioFachada.php");

$FachadaE = new EstadioFachada();

// En caso de que se valla a agregar
if(isset($_POST['Aplicar'])){
	
	$fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
	$Estadio = new Estadio($_POST['nombre'],$_POST['ubicacion'],$_POST['propietario'],$_POST['mlf'],$_POST['mcf'],$_POST['mrf'],$_POST['tt'],$fecha);
	
	$FachadaE->addEstadio($Estadio);
	
	header('Location: gestion_estadio.php'); 
}


?>

<?php

include("static/head.php");
include("static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Agregar_Es.css"  type="text/css" />';

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
		<div id="contenido_interno">';

		
echo'

		<div id="box_info">
		
		
            <form id="Alcance" action="Agregar_Es.php" method="post">
                <div id="Foto">
                	<img src="assets/images/Fotos_Estadios/generico.jpg" />
                </div>
                
                <div id="InfBas">
                    <div>
                        <label for="nombre">Nombre del Estadio: </label>
                        <input size="10" type="text" name="nombre" id="nombre" value="" />
                        <label for="propietario">Propietario: </label>
                        <input size="10" type="text" name="propietario" id="propietario" value="" /> 						
                    </div>
                    
                    <div>                    
                        <label for="ubicacion">Ubicacion: </label>
                        <input size="50" type="text" name="ubicacion" id="ubicacion" value="" />
                    </div>
                    
                    <div>
                        <label >Fecha de Fundacion: </label>
                   
						<label for="dia">D&iacutea: </label>
							<select name="dia">';
								for ($i = 1 ; $i<=31 ; $i++)
									echo "<option value=".$i.">".$i."</option>";
				
									echo '
							</select>
			
						<label for="mes">Mes: </label>
							<select name="mes">';
		
								$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");
					
								for ($i = 0 ; $i < 12 ; $i++)
									echo "<option value=".$i.">".$mes[$i]."</option>";
			
									echo '
							</select>
		
						<label for="anio">A&ntildeo: </label>
		
							<select name="anio">';
			           
								for ($i = 1960 ; $i<=date('Y') ; $i++)
									echo "<option value=".$i.">".$i."</option>";
				
				
									echo '
							</select>                  
                    
                    </div>                                         
                </div>
                <div id="InfExt">
                
                    <div>
                        <label for="mlf">Medida del Left Field: </label>
                        <input size="10" type="text" name="mlf" id="mlf" value="" />   
					</div>
					
					<div>
                        <label for="mcf">Medida del Center Field: </label>
                        <input size="10" type="text" name="mcf" id="mcf" value="" />                 
                    </div>
                    
                    <div>
                        <label for="mrf">Medida del Right Field: </label>
                        <input size="10" type="text" name="mrf" id="mrf" value="" />                 
                        <label for="tt">Tipo de Terreno: </label>
                        <input size="10" type="text" name="tt" id="tt" value="" />                 
                    </div>                                            
                </div>
				
				
				<input type="submit" name="Aplicar" value="Aplicar"  /> 
            </form>	
		</div>            
		

	';

echo '</div>';
include("static/sideBar.php");
include("static/footer.php");	

?>
