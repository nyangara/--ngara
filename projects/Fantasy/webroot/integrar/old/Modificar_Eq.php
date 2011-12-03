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

    $instancia->actualizar();

    header('Location: gestion_equipos.php'); 
	
}

//En caso de que se elimine
if(isset($_POST['Eliminar'])){
    $_POST['TIPO']='Equipo';
    unset($_POST['Eliminar']);
    $instancia->eliminar();
    header('Location: gestion_equipos.php'); 
}

$id = $_POST['id'];
unset($_POST);

$_POST['TIPO']='Estadio';
$Estadios = $instancia->obtenerTodos();
    
unset($_POST);

$_POST['TIPO']='Equipo';
$_POST['id']=$id;
$Equipo = $instancia->obtener();
?>

<?php

//Esta Area es para Calcular todas las Selecciones del Formulario
date_default_timezone_set('America/Caracas');


$Es = '<select name="home">';
foreach($Estadios as $Estadio)
    $Es .= "<option value=".$Estadio->id.">".$Estadio->nombre."</option>";
$Es .= '</select>';




$fecha = $Equipo->fecha_fundacion;
$Aux = explode("-", $fecha); //Separa la fecha en A?o, Mes  y dia
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

<link rel="stylesheet" href="assets/styles/style_Modificar_Eq.css"  type="text/css" />


	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li class="on"><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
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
		
        <div id="contenido_interno">
            <div id="box_info">
                <form id="Alcance" action="Modificar_Eq.php" method="post">

<table width="550" border="0">
                        <tr>
                            <td>
                                <div id="Foto"><?php echo "<img src=\"".$Equipo->logo;echo " \"/>";?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="500" border="0" align="center">
                                <tr>
                                    <td >Nombre del Equipo:</td>
                                    <td colspan="1">
                                        <input size="10" name="nombre" type="text" id="nombre" value="<?php echo $Equipo->nombre; ?>" />
                                    </td>
                                    <td>Siglas:</td>
                                    <td colspan="2">
                                        <input size="10" name="siglas" type="text" id="siglas" value="<?php echo $Equipo->siglas; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="center">Fecha de fundaci&oacute;n:</td>
                                </tr>
                                <tr>
                                    <td align="right">D&iacute;a:</td>
                                    <td ><?php echo $d; ?></td>
                                    <td>Mes:</td>
                                    <td><?php echo $m; ?></td>
                                    <td>A&ntilde;o:</td>
                                    <td><?php echo $a; ?></td>
                                </tr>
                                <tr>
                                    <td>Casa:</td>
                                    <td colspan="1" align="left"><?php echo $Es; ?></td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                    </table>
                    
                    <input type="hidden" name="id" value="<?php echo $Equipo->id; ?>" />
                    <input type="hidden" name="TIPO" value="Equipo" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	
?>