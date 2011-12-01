<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['Aplicar'])){
	
    $fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
    $_POST['fecha_fundacion']=$fecha;
    unset($_POST['anio']);
    unset($_POST['mes']);
    unset($_POST['dia']);
    unset($_POST['Aplicar']);

    $instancia->insertar();

    header('Location: gestion_estadios.php'); 
	
}
unset($_POST); 
?>

<?php

//Esta Area es para Calcular todas las Selecciones del Formulario
date_default_timezone_set('America/Caracas');
    
$d = '<select name="dia">';
for ($i = 1 ; $i<=31 ; $i++)
    $d .= "<option value=".$i.">".$i."</option>";
$d .= '</select>';

$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");
$m = '<select name="mes">';
for ($i = 0 ; $i < 12 ; $i++)
    $m .= "<option value=".$i.">".$mes[$i]."</option>";
$m .= '</select>';
			
$a = '<select name="anio">';
for ($i = 1960 ; $i<= date('Y') ; $i++)
    $a .= "<option value=".$i.">".$i."</option>";
$a .= '</select>'; 

include("Static/head.php");
include("Static/header.php");
?>

<link rel="stylesheet" href="assets/styles/style_Modificar_Es.css"  type="text/css" />

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li class="on"><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
		  <li><a href="gestion_usuarios.php">Usuarios</a></li>
        </ul>
  </div>

	   
    <div id="content">
        <div id="contenido_interno_datos">
            <div id="box_info">
                <form id="Alcance" action="Agregar_Es.php" method="post">
                    
                    <table width="550" border="0">
                        <tr>
                            <td>
                                <img src="assets/images/Fotos_Estadios/generico.jpg"  />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="540" border="0" align="center">
                                    <tr>
                                        <td colspan="2">Nombre del estadio:</td>
                                        <td colspan="2">
                                            <input size="10" name="nombre" type="text" id="nombre" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ubicación:</td>
                                        <td colspan="1">
                                            <input size="10" name="ubicacion" type="text" id="ubicacion" value="" />
                                        </td>
                                        <td>Propietario:</td>
                                        <td>
                                            <input size="10" name="propietario" type="text" id="propietario" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="center">Fecha de Fundación:</td>
                                    </tr>
                                    <tr>
                                        <td>Día:</td>
                                        <td><?php echo $d; ?></td>
                                        <td>Mes:</td>
                                        <td><?php echo $m; ?></td>
                                        <td>Año:</td>
                                        <td><?php echo $a; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Left Field:</td>
                                        <td>
                                            <input size="10" name="medida_left_field" type="text" value="" />
                                        </td>
                                        <td>Center Field:</td>
                                        <td>
                                            <input size="10" name="medida_center_field" type="text" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Right Field:</td>
                                        <td>
                                            <input size="10" name="medida_right_field" type="text" value="" />
                                        </td>
                                        <td>Tipo de Terreno:</td>
                                        <td>
                                            <input size="10" name="tipo_terreno" type="text" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Capacidad: </td>
                                        <td>
                                            <input size="10" name="capacidad" type="text" value="" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>                   

                    <input type="hidden" name="TIPO" value="Estadio" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>	
            </div>    
        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	

?>
