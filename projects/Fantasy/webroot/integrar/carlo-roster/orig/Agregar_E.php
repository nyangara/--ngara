<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();
$id = $_POST['id'];

// En caso de que se valla a agregar
if(isset($_POST['Aplicar'])){

        $fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
        $_POST['fecha']=$fecha;
        unset($_POST['anio']);
        unset($_POST['mes']);
        unset($_POST['dia']);
        unset($_POST['Aplicar']);
        
        $_POST['TIPO']='Jugador';
        $Jugador = $instancia->obtener();
        unset($_POST['TIPO']);
        unset($_POST['id']);
        
        $instancia->G_Estadistica($Jugador);
        
	header('Location: gestion_jugadores.php'); 
}


unset($_POST);

//Jugador al Que se le insertara la estadistica
$_POST['TIPO']='Jugador';
$_POST['id']=$id;
$Jugador = $instancia->obtener();

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
<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />
	
<?php

if(isset($_SESSION['Manager'])){?>
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


	   
	<div id="content">

        <div id="contenido_interno">
            <div id="box_info">
                <form id="Alcance" action="Agregar_E.php" method="post">

                        <table width="248" border="1">
                                <tr>
                                        <td colspan="6" align="center">Fecha:</td>
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
                    
                    <?php 
                    if($Jugador->posicion == 'P')
                    echo '
                        <table width="248" border="0">
                                <tr>
                                        <td>Entradas Lanzadas:</td>
                                        <td><input size="10" name="el" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Carreras Limpias:</td>
                                        <td><input size="10" name="cl" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Imparables:</td>
                                        <td><input size="10" name="i" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Base por Bola:</td>
                                        <td><input size="10" name="bb" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Ponches:</td>
                                        <td><input size="10" name="k" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Juegos Ganados:</td>
                                        <td><input size="10" name="jg" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Errores:</td>
                                        <td><input size="10" name="errores" type="text" value="" /></td>
                                </tr>                                
                        </table>';
                    else    
                    echo '
                        <table width="248" border="0">
                                <tr>
                                        <td>Carreras Anotadas:</td>
                                        <td><input size="10" name="ca" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Veces al Bate:</td>
                                        <td><input size="10" name="vb" type="text" value="" /></td>
                                </tr>                                
                                <tr>
                                        <td>Total de Bases:</td>
                                        <td><input size="10" name="tb" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Carreras impulsadas:</td>
                                        <td><input size="10" name="ci" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Base por Bola:</td>
                                        <td><input size="10" name="bb" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Bases Robadas:</td>
                                        <td><input size="10" name="br" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Ponches:</td>
                                        <td><input size="10" name="k" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Hits:</td>
                                        <td><input size="10" name="h" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Dobles:</td>
                                        <td><input size="10" name="h2" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Triples:</td>
                                        <td><input size="10" name="h3" type="text" value="" /></td>
                                </tr>
                                <tr>
                                        <td>Home Runs:</td>
                                        <td><input size="10" name="hr" type="text" value="" /></td>
                                </tr>                                
                        </table>';
                    
                    ?>
                    
                    <input type="hidden" name="id" value="<?php echo $Jugador->id; ?>" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>            
            

<?php

include("Static/sideBar.php");
include("Static/footer.php");

?>
