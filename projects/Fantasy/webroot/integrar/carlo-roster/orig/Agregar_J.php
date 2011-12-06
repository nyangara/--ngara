<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['Aplicar'])){
    unset($_POST['Aplicar']);
    
    if($_FILES['imagen']['error'] == 0){

        // Ruta donde se guardarán las imágenes
        $directorio = 'assets/images/Fotos_Jugadores/';

        // Recibo los datos de la imagen
        $nombre = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];

        // Muevo la imagen desde su ubicación
        // temporal al directorio definitivo
        chmod($directorio,0777);
        $d = move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre);
        
        unset($_FILES['imagen']);
        $_POST['foto'] = $directorio.$nombre;
    }
    else
        $_POST['foto'] = 'assets/images/Fotos_Jugadores/generico.jpg';    
    
    $instancia->insertar();

    header('Location: gestion_jugadores.php'); 
	
}
unset($_POST);

$_POST['TIPO']='Equipo';
$Equipos = $instancia->obtenerTodos();
    
unset($_POST);

?>

<?php

//Esta Area es para Calcular todas las Selecciones del Formulario
date_default_timezone_set('America/Caracas');
$Eq = '<select name="equipo">';
foreach($Equipos as $Equipo)
    $Eq .= "<option value=".$Equipo->id.">".$Equipo->nombre."</option>";
$Eq .= '</select>';
    
$Posiciones = array('P','B','IF','OF','C','1B','2B','3B','SS','RF','CF','LF');
$Pos = '<select name="posicion">'; 
foreach($Posiciones as $Posicion)
    $Pos .= "<option value=".$Posicion.">".$Posicion."</option>";
$Pos .= '</select>';
    
include("Static/head.php");
include("Static/header.php");
?>

<link rel="stylesheet" href="assets/styles/style_Agregar_J.css"  type="text/css" />

<?php if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="#">Mi Perfil</a></li>
        <li><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
    </ul>
<?php } elseif(isset($_SESSION['Administrador'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
		<li><a href="gestion_usuarios.php">Usuarios</a></li>
	</ul>
<?php } else { 
		echo '<ul id="navigation">
		<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        </ul>';
	}?>
</div>
    <div id="content">
		
        <div id="contenido_interno_a">
            <div id="box_info">
                <form id="Alcance" action="Agregar_J.php" enctype="multipart/form-data" method="post">

                    <table width="550" border="0" align="center">
                        <tr>
                            <td>
                                <table width="400" border="0">
                                    <tr>
                                        <td colspan="3" align="center">Nombre del Equipo:</td>
                                        <td colspan="3"><?php echo $Eq; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td colspan="2">
                                            <input size="10" name="nombres" type="text" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Posicion:</td>
                                        <td colspan="2">
                                            <?php echo $Pos; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Precio:</td>
                                        <td colspan="2">
                                            <input size="10" name="precio" type="text" value="" />
                                        </td>
                                    </tr>                                    
                                </table>
                            </td>
                            <td>
                                <input id="imagen" name="imagen" size="30" type="file" />
                                <div id="Foto">
                                    <img src="assets/images/Fotos_Jugadores/generica.jpg" width="132" height="180"  />
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <input type="hidden" name="TIPO" value="Jugador" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>
 </div>       
<?php

include("Static/footer.php");	
?>
