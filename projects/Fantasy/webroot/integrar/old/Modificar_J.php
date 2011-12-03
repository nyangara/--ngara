<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['Aplicar'])){
	
    $fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
    $_POST['fecha_nacimiento']=$fecha;
    unset($_POST['anio']);
    unset($_POST['mes']);
    unset($_POST['dia']);
    unset($_POST['Aplicar']);

    $instancia->actualizar();

    header('Location: gestion_jugadores.php'); 
	
}

//En caso de que se elimine
if(isset($_POST['Eliminar'])){
    $_POST['TIPO']='Jugador';
    unset($_POST['Eliminar']);
    $instancia->eliminar();
    header('Location: gestion_jugadores.php'); 
}

$id = $_POST['id'];
unset($_POST);

$_POST['TIPO']='Equipo';
$Equipos = $instancia->obtenerTodos();
    
unset($_POST);
$_POST['TIPO']='Jugador';
$_POST['id']=$id;
$Jugador = $instancia->obtener();

?>

<?php

//Esta Area es para Calcular todas las Selecciones del Formulario
date_default_timezone_set('America/Caracas');
$Eq = '<select name="equipo">';
foreach($Equipos as $Equipo)
    if( $Jugador->equipo == $Equipo->id)
            $Eq .= "<option value=".$Equipo->id." selected>".$Equipo->nombre."</option>";
    else
            $Eq .= "<option value=".$Equipo->id.">".$Equipo->nombre."</option>";
$Eq .= '</select>';
    
$fecha = $Jugador->fecha_nacimiento;
$Aux = explode("-", $fecha); //Separa la fecha en A�o, Mes  y dia
$d = '<select name="dia">';
for ($i = 1 ; $i<=31 ; $i++)
    if($Aux[2]==$i)
        $d .= "<option value=".$i." selected>".$i."</option>";
    else
        $d .= "<option value=".$i.">".$i."</option>";
$d .= '</select>';

$mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");
$m = '<select name="mes">';
for ($i = 0 ; $i < 12 ; $i++)
    if($Aux[1]==$i)
        $m .= "<option value=".$i." selected>".$mes[$i]."</option>";
    else
        $m .= "<option value=".$i.">".$mes[$i]."</option>";
$m .= '</select>';
			
$a = '<select name="anio">';
for ($i = 1960 ; $i<= date('Y') ; $i++)
    if($Aux[0]==$i)
        $a .= "<option value=".$i." selected>".$i."</option>";
    else
        $a .= "<option value=".$i.">".$i."</option>";
$a .= '</select>';    


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
          <li><a href="#">Roster</a></li>
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
                <form id="Alcance" action="Modificar_J.php" method="post">

                    <table width="550" border="0">
                        <tr>
                            <td>
                                <table width="400" border="0">
                                    <tr>
                                        <td colspan="3">Nombre del Equipo:</td>
                                        <td colspan="3"><?php echo $Eq; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td colspan="2">
                                            <input size="10" name="nombres" type="text" value="<?php echo $Jugador->nombres; ?>" />
                                        </td>
                                        <td>Apellido:</td>
                                        <td colspan="2">
                                            <input size="10" name="apellidos" type="text" value="<?php echo $Jugador->apellidos; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Número:</td>
                                        <td colspan="2">
                                            <input size="10" name="numero" type="text" value="<?php echo $Jugador->numero; ?>" />
                                        </td>
                                        <td>Posición:</td>
                                        <td colspan="2">
                                            <input size="10" name="posicion" type="text" value="<?php echo $Jugador->posicion; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="center">Fecha de Nacimiento:</td>
                                    </tr>
                                    <tr>
                                        <td>Día:</td>
                                        <td><?php echo $d; ?></td>
                                        <td>Mes:</td>
                                        <td><?php echo $m; ?></td>
                                        <td>Año:</td>
                                        <td><?php echo $a; ?></td>
                                    </tr>
                                </table>
                            <td>
                                <img src="<?php echo $Jugador->foto; ?>" width="132" height="180"  />
                            </td>
                        </tr>
                    </table>
                    
                    <input type="hidden" name="id" value="<?php echo $Jugador->id; ?>" />
                    <input type="hidden" name="TIPO" value="Jugador" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	
?>