<?php
require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

include("Static/head.php");
include("Static/header.php");

$id=$_SESSION['Manager'];
$_POST['id']=$id;


$_POST['TIPO']='Usuario';
$Usuario = $instancia->obtener();

unset($_POST);
$_POST['TIPO']='Perfil_Usuario';
$_POST['usuario']=$id;
$P_Usuario = $instancia->obtener();

unset($_POST);
$_POST['TIPO']='Manager';
$_POST['usuario']=$id;
$UManager = $instancia->obtener();



?>

<link rel="stylesheet" href="assets/styles/style_Datos_Perfil.css"  type="text/css" />

	
<?php

if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a class="on" href="#">Mi Perfil</a></li>
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
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
		<li><a class="on" href="gestion_usuarios.php">Usuarios</a></li>
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
						<div id="Foto"><?php echo "<img src=\"".$P_Usuario->avatar;echo " \"/>";?></div>
                    <table width="550" border="0">
                        <tr>
                            <td>
                                <table width="400" border="0" align="center">
									<tr>
										<td align='center' colspan='3'>
											<h3><?php echo $Usuario->username?></h3>
										</td>								
									</tr>                                    
									<tr>
                                        <td>Nombres </td>
                                        <td colspan="2" align="center"><?php echo $P_Usuario->nombres; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Apellidos </td>
                                        <td colspan="3" align="center"><?php echo $P_Usuario->apellidos; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td colspan="3" align="center"><?php echo $P_Usuario->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Avatar </td>
                                        <td colspan="3" align="center"><?php echo $P_Usuario->avatar; ?></td>
                                    </tr>
									<tr>
                                        <td>Puntaje </td>
                                        <td colspan="3" align="center"><?php echo $UManager->puntaje; ?></td>
                                    </tr>
									<tr>
                                        <td>Creditos </td>
                                        <td colspan="3" align="center"><?php echo $UManager->creditos; ?></td> 										
									</tr>																	
                                </table>
                            </td>
                        </tr>
                    </table>


                </form>	
            </div>    
            <div id="env" >



                <form action="Modificar_Usr.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $Usuario->id ?>" />
                    <input type="submit" name="Modificar" value="Modificar"  />      
                </form>			

		

            </div>

        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	

?>
