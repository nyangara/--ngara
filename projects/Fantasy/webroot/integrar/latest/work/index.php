<?php

require_once("Clases/fachadaInterface.php");

$instancia = fachadaInterface::singleton();
$_POST['TIPO']='Contenidos';
$Contenidos = $instancia->obtenerTodos();
if(isset($_POST['tags'])){
	$_POST['titulo']=$_POST['tags'];
	unset($_POST['tags']);
	$Contenidos2 = $instancia->obtenerTodos();
}

include("Static/head.php");
include("Static/header.php");
?>
<?php

if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a class="on" href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
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
    	<li><a class="on" href="index.php">Inicio</a></li>
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
	}
echo '</div>

	   
	<div id="content">
		<div id="contenido_interno">';
		
		echo '<!-- Slider Pro -->
<style type="text/css" media="screen">
#slider1 {
    width: 600px; /* important to be same as image width */
    height: 190px; /* important to be same as image height */
    position: relative; /* important */
	overflow: hidden; /* important */
            -webkit-border-top-left-radius: 10px;
			-webkit-border-top-right-radius: 10px;
			-moz-border-radius-topleft: 10px;
			-moz-border-radius-topright: 10px;
}

#slider1Content {
    width: 600px; /* important to be same as image width or wider */
    position: absolute;
	top: 0;
	margin-left: 0;
}
.slider1Image {
    float: left;
    position: relative;
	display: none;
}
.slider1Image span {
    position: absolute;
	font: 10px/15px Arial, Helvetica, sans-serif;
    padding: 10px 13px;
    width: 600px;
    background-color: #000;
    filter: alpha(opacity=70);
    -moz-opacity: 0.7;
	-khtml-opacity: 0.7;
    opacity: 0.7;
    color: #fff;
    display: none;
}
.clear {
	clear: both;
}
.slider1Image span strong {
    font-size: 14px;
}
.left {
	top: 0;
    left: 0;
	width: 110px !important;
	height: 190px;
}
.right {
	right: 0px;
	bottom: -20px;
	width: 110px !important;
	height: 190px;
}
ul { list-style-type: none;}
</style>       
<!-- JavaScripts-->        
<script type="text/javascript" src="assets/js/s3SliderPacked.js"></script>
<script type="text/javascript" src="assets/js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(\'#slider1\').s3Slider({
            timeOut: 4000 
        });
    });
</script>


        	<div id="slider1">
            <ul id="slider1Content">
            	<li class="slider1Image">
               	 	<a href=""><img src="slider_images/imagen1.jpg" alt="1" /></a>
                	<span class="left"><strong>Vive...</strong><br />La emoción de el béisbol...</span></li>
            	<li class="slider1Image">
               		 <a href=""><img src="slider_images/imagen2.jpg" alt="2" /></a>
              		 <span class="right"><strong>Diseña...</strong><br />El equipo de tus sueños...</span></li>
       	 		 <li class="slider1Image">
               		 <img src="slider_images/imagen3.jpg" alt="3" />
              		  <span class="right"><strong>Juega...</strong><br />El Fantasy de la LPBV</span></li>

          		  <div class="clear slider1Image"></div>
      		</ul>
			
            </div>
            
            
            
            
<!-- final de slider -->  ';

echo '
<div id="Layer1" style="width:600px; height:310px; overflow: auto;">';		
	echo '
		<form style="width:50%; position:relative; left:140px; margin-bottom:18px; margin-top:18px;" action="index.php" method="POST" id="insertar_noticia">
			<input type="text" name="tags">
		<input type="submit" value="buscar"/>   
		</form>		
	';
	
	echo '<table width="580px" border="0" cellspacing="0" cellpadding="4" align="left">';		
		for($i=0;$i<count($Contenidos);$i++){
			$Tmp = $Contenidos[$i];
		
			echo '<tr><td><img src="' . $Tmp->urlimg . '"></img></td>';
			echo '<td><h3 >' . $Tmp->titulo . '</h3><p>' . $Tmp->contenidoC . '</p>';
			echo '<p><small>' . $Tmp->fecha . '</small></p></td></tr>';
			echo'<td><form style="left:0px; margin-bottom:18px; margin-top:18px;" action="#" method="POST" id="modificar_noticia"><input name="id" type="hidden" value="'.$Tmp->id.'"/>
				<input class="admin" type="submit" value="modificar"/></form>';
			echo'<form style="left:92px; top:-43px; position:relative; margin-bottom:18px; margin-top:18px;" action="#" method="POST" id="eliminar_noticia"><input name="id" type="hidden" value="'.$Tmp->id.'"/>
				<input class="admin" type="submit" value="eliminar"/></form></td>';	
		
		}
		
		if(isset($_POST['titulo'])){
                    for($i=0;$i<count($Contenidos2);$i++){
                            $Tmp = $Contenidos2[$i];
                            echo '<tr><td><img src="' . $Tmp->urlimg . '"></img></td>';
                            echo '<td><h3 >' . $Tmp->titulo . '</h3><p>' . $Tmp->contenidoC . '</p>';
                            echo '<p><small>' . $Tmp->fecha . '</small></p></td></tr>';
                    }
		}
	echo '</table></div>';
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>

