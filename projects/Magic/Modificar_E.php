<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

$_POST['TIPO']='Jugador';
$_POST['id']=$_POST['id_J'];
$Jugador = $instancia->obtener();

unset($_POST['id_J']);
unset($_POST['TIPO']);
$_POST['id']=$_POST['id_E'];
unset($_POST['id_E']);

// En caso de que se vaya a agregar
if(isset($_POST['Aplicar']) || isset($_POST['Eliminar'])){

        unset($_POST['Aplicar']);
        unset($_POST['Eliminar']);
        $instancia->G_Estadistica($Jugador);
        
	header('Location: gestion_jugadores.php'); 
}

$Estadistica = $instancia->obtenerEstadistica($Jugador);


include("Static/head.php");
include("Static/header.php");

?>


<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />
	
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
                <form id="Alcance" action="Modificar_E.php" method="post">
                    
                    <?php 
                    if($Jugador->posicion == 'P')
                    echo '
                        <table width="248" border="0">
                                <tr>
                                        <td>Entradas Lanzadas:</td>
                                        <td><input size="10" name="el" type="text" value="'. $Estadistica->el .'" /></td>
                                </tr>
                                <tr>
                                        <td>Carreras Limpias:</td>
                                        <td><input size="10" name="cl" type="text" value="'. $Estadistica->cl .'" /></td>
                                </tr>
                                <tr>
                                        <td>Imparables:</td>
                                        <td><input size="10" name="i" type="text" value="'. $Estadistica->i .'" /></td>
                                </tr>
                                <tr>
                                        <td>Base por Bola:</td>
                                        <td><input size="10" name="bb" type="text" value="'. $Estadistica->bb .'" /></td>
                                </tr>
                                <tr>
                                        <td>Ponches:</td>
                                        <td><input size="10" name="k" type="text" value="'. $Estadistica->k .'" /></td>
                                </tr>
                                <tr>
                                        <td>Juegos Ganados:</td>
                                        <td><input size="10" name="jg" type="text" value="'. $Estadistica->jg .'" /></td>
                                </tr>
                        </table>';
                    else    
                    echo '
                        <table width="248" border="0">
                                <tr>
                                        <td>Carreras Anotadas:</td>
                                        <td><input size="10" name="ca" type="text" value="'. $Estadistica->ca .'" /></td>
                                </tr>
                                <tr>
                                        <td>Total de Bases:</td>
                                        <td><input size="10" name="tb" type="text" value="'. $Estadistica->tb .'" /></td>
                                </tr>
                                <tr>
                                        <td>Carreras impulsadas:</td>
                                        <td><input size="10" name="ci" type="text" value="'. $Estadistica->ci .'" /></td>
                                </tr>
                                <tr>
                                        <td>Base por Bola:</td>
                                        <td><input size="10" name="bb" type="text" value="'. $Estadistica->bb .'" /></td>
                                </tr>
                                <tr>
                                        <td>Bases Robadas:</td>
                                        <td><input size="10" name="br" type="text" value="'. $Estadistica->br .'" /></td>
                                </tr>
                                <tr>
                                        <td>Ponches:</td>
                                        <td><input size="10" name="k" type="text" value="'. $Estadistica->k .'" /></td>
                                </tr>
                                <tr>
                                        <td>Hits:</td>
                                        <td><input size="10" name="h" type="text" value="'. $Estadistica->h .'" /></td>
                                </tr>
                        </table>';
                    
                    ?>
                    
                    <input type="hidden" name="id_E" value="<?php echo $Estadistica->id; ?>" />
                    <input type="hidden" name="id_J" value="<?php echo $Jugador->id; ?>" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>            
            

<?php

include("Static/sideBar.php");
include("Static/footer.php");

?>