<?php 
require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['eliminar'])){
	$idu = $_POST['idusr'];
	$idp = $_POST['idpusr'];
	$idm = $_POST['idman'];
	unset($_POST);
	$_POST['id']=$idp;
	$_POST['TIPO']='Perfil_Usuario';
	$instancia->eliminar();
	$_POST['id']=$idm;
	$_POST['TIPO']='Manager';
	$instancia->eliminar();
	$_POST['id']=$idu;
	$_POST['TIPO']='Usuario';
	$instancia->eliminar();
	unset($_POST);
	header('Location: gestion_usuarios.php');
}

if(isset($_POST['aplicar'])){
	$idu = $_POST['idusr'];
	$idp = $_POST['idpusr'];
	$idm = $_POST['idman'];
	$_POST['id']=$idp;
	$_POST['TIPO']='Perfil_Usuario';	
	$instancia->actualizar();
	$_POST['id']=$idm;
	$_POST['TIPO']='Manager';
	$instancia->actualizar();
	$_POST['id']=$idu;
	$_POST['TIPO']='Usuario';
	$instancia->actualizar();
	unset($_POST);
	$_POST['idusuario']=$idu;
	header('Location: gestion_usuarios.php');
}

$id = $_POST['id'];
unset($_POST);

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
include("Static/head.php");
include("Static/header.php");

?>
<link rel="stylesheet" href="assets/styles/style_Modificar_Usr.css"  type="text/css" />
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
        <li><a class="on" href="gestion_estadios.php">Estadios</a></li>
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
		
        <div id="contenido_interno">
            <div id="box_info">
                <form id="Alcance" action="Modificar_Usr.php" method="post">
					<h3><?php echo $Usuario->username;?></h3>
					Password: <input type="password" name="password" value="<?php echo $Usuario->password;?>"/>
					Nombres: <input type="text" name="nombres" value="<?php echo $P_Usuario->nombres;?>"/>
					Apellidos: <input type="text" name="apellidos" value="<?php echo $P_Usuario->apellidos;?>"/>
					Email: <input type="text" name="email" value="<?php echo $P_Usuario->email;?>"/>
					</br>
					Puntaje: <input type="text" name="puntaje" value="<?php echo $UManager->puntaje;?>"/>
					Creditos: <input type="text" name="creditos" value="<?php echo $UManager->creditos;?>"/>
					</br>
					Avatar: <input type="text" name="avatar" value="<?php echo $P_Usuario->avatar;?>"/>
					<input type="hidden" name="idusr" value="<?php echo $Usuario->id;?>"/>
					<input type="hidden" name="username" value="<?php echo $Usuario->username;?>"/>
					<input type="hidden" name="idpusr" value="<?php echo $P_Usuario->id;?>"/>
					<input type="hidden" name="pusuario" value="<?php echo $P_Usuario->usuario;?>"/>
					<input type="hidden" name="idman" value="<?php echo $UManager->id;?>"/>
					<input type="hidden" name="musuario" value="<?php echo $UManager->usuario;?>"/>
					<input type="hidden" name="aplicar" value="o"/>
					</br>
					<h3>Avatares disponibles:</h3>
					</br>
					<div class="ava">avatar-1
					</br>
					<img src="assets/images/Avatares/avatar-1.jpg"/>
					</div>
					
					<div class="ava">avatar-2
					</br>
					<img src="assets/images/Avatares/avatar-2.jpg"/>
					</div>
					
					<div class="ava">avatar-3
					</br>
					<img src="assets/images/Avatares/avatar-3.jpg"/>
					</div>
					
					<div class="ava">avatar-4
					</br>
					<img src="assets/images/Avatares/avatar-4.jpg"/>
					</div>
					<a href="gestion_usuarios.php"><button type="button">Regresar</button></a>
					<input type="submit" value="Aplicar"/>
				</form>
			</div>
		</div>
	
<?php
include("Static/sideBar.php");
include("Static/footer.php");	
?>
