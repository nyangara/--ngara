<?php
include("Static/head.php");
include("Static/header.php");

if(isset($_SESSION['Manager'])){
    $_POST['manager']=$_SESSION['Manager'];
}elseif(isset($_SESSION['Administrador'])){
    //No tiene nada que hacer aqui
    header('Location: gestion_rosters.php');
}else{
    //No tiene nada que hacer aqui
    header('Location: index.php');
}

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_POST['Aplicar'])){
    date_default_timezone_set('America/Caracas');
    
    $_POST['fecha_creacion'] = date("d/m/Y H:i:s");
    unset($_POST['Aplicar']);

    $instancia->insertar();

    header('Location: InterfaceRoster.php'); 
	
}
unset($_POST);


?>

<link rel="stylesheet" href="assets/styles/style_Agregar_R.css"  type="text/css" />

<?php if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="#">Mi Perfil</a></li>
        <li><a class="on" href="gestion_rosters.php">Roster</a></li>
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
        <li><a class="on" href="gestion_rosters.php">Roster</a></li>
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
		
        <div id="contenido_interno">
            <div id="box_info">
                <form id="Alcance" action="Agregar_R.php" method="post">
                    
                    <label for="nombre"> Nombre del Roster:  </label>
                    <input name="nombre" id="nombre" type="text" value="" />
                    
                    <input type="hidden" name="TIPO" value="Roster" />
                    <input type="submit" name="Aplicar" value="Aplicar"  />
                </form>

            </div>

        </div>
        
<?php
include("Static/sideBar.php");
include("Static/footer.php");	
?>
