<?php
require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

$id = $_POST['id'];
unset($_POST);

$_POST['id']=$id;
$_POST['TIPO']='Estadio';
$Estadio = $instancia->obtener();

include("Static/head.php");
include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_Es.css"  type="text/css" />

<?php if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a class="on" href="gestion_estadios.php">Estadios</a></li>
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
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a class="on" href="gestion_estadios.php">Estadios</a></li>
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
        <div id="contenido_interno_datos">
            <div id="box_info">
                <form id="Alcance">

                    <table width="550" border="0">
                        <tr>
                            <td>
                                <div id="Foto">
                                    <img src="<?php echo $Estadio->foto; ?>" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="500" border="0" align="center">
                                    <tr>
                                        <td colspan="2">Nombre del estadio: </td>
                                        <td colspan="2"><?php echo $Estadio->nombre; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ubicación: </td>
                                        <td colspan="3"><?php echo $Estadio->ubicacion; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Propietario: </td>
                                        <td><?php echo $Estadio->propietario; ?></td>
                                        <td>Fecha de Fundación: </td>
                                        <td><?php echo $Estadio->fecha_fundacion; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Left Field: </td>
                                        <td><?php echo $Estadio->medida_left_field; ?></td>
                                        <td>Center Field: </td>
                                        <td><?php echo $Estadio->medida_center_field; ?></td>
                                    </tr>
                                        <tr>
                                        <td>Right Field: </td>
                                        <td><?php echo $Estadio->medida_right_field; ?></td>
                                        <td>Tipo de Terreno: </td>
                                        <td><?php echo $Estadio->tipo_terreno; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Capacidad: </td>
                                        <td><?php echo $Estadio->capacidad; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Descripcion: </td>
                        </tr>
                        <tr>
                            <td><?php echo $Estadio->descripcion; ?></td>
                        </tr>
                    </table>

                </form>	
            </div>    

            <div id="env" >

                <form action="gestion_estadios.php" method="post">
                    <input type="submit" value="Regresar"/>
                </form>

                <form action="Listar_D_Es.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $Estadio->id; ?>" />
                    <input type="submit" name="Detalles" value="Ver Detalles"  />        
                </form>

                <form action="Modificar_Es.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $Estadio->id; ?>" />
                    <input type="submit" name="Modificar" value="Modificar"  />      
                </form>			

                <form action="Modificar_Es.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $Estadio->id; ?>" />
                    <input type="submit" name="Eliminar" value="Eliminar"  />      
                </form>			

            </div>
        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	

?>
