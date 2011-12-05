<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

$id = $_POST['id'];
unset($_POST);

$_POST['id']=$id;
$_POST['TIPO']='Jugador';
$Jugador = $instancia->obtener();
$Estadisticas = $instancia->consultarEstadisticasDetalladas($Jugador);


include("Static/head.php");
include("Static/header.php");
    
    if($Jugador->posicion=='P')
        $Encabezado = "
            <table border=0 cellpadding=0 cellspacing=0 width=241 style='border-collapse:collapse;table-layout:fixed;width:410pt'>
             <tr height=21 style='height:15.75pt'>
              <td height=21 class=xl6326170 width=73 style='height:15.75pt;width:60pt'>Fecha</td>
              <td class=xl6326170 width=30 style='border-left:none;width:25pt'>EL</td>
              <td class=xl6326170 width=22 style='border-left:none;width:25pt'>CL</td>
              <td class=xl6326170 width=19 style='border-left:none;width:25pt'>I</td>
              <td class=xl6326170 width=23 style='border-left:none;width:25pt'>BB</td>
              <td class=xl6326170 width=23 style='border-left:none;width:25pt'>P</td>
              <td class=xl6326170 width=15 style='border-left:none;width:25pt'>JG</td>
              <td class=xl6326170 width=15 style='border-left:none;width:25pt'>Errores</td>
              <td class=xl1526170 width=50 style='width:40pt'></td>
              <td class=xl1526170 width=50 style='width:40pt'></td>
             </tr>";            
    else
        $Encabezado = "
            <table border=0 cellpadding=0 cellspacing=0 width=241 style='border-collapse:collapse;table-layout:fixed;width:410pt'>
             <tr height=21 style='height:15.75pt'>
              <td height=21 class=xl6326170 width=73 style='height:15.75pt;width:65pt'>Fecha</td>
              <td class=xl6326170 width=24 style='border-left:none;width:24pt'>CA</td>
              <td class=xl6326170 width=24 style='border-left:none;width:24pt'>VB</td>
              <td class=xl6326170 width=22 style='border-left:none;width:24pt'>TB</td>
              <td class=xl6326170 width=19 style='border-left:none;width:24pt'>CI</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>BB</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>BR</td>
              <td class=xl6326170 width=15 style='border-left:none;width:24pt'>P</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>H</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>H2</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>H3</td>
              <td class=xl6326170 width=23 style='border-left:none;width:24pt'>HR</td>
              <td class=xl1526170 width=60 style='width:40pt'></td>
              <td class=xl1526170 width=60 style='width:40pt'></td>
             </tr>";

    $Cuerpo = "";
    $contador = 0;
foreach($Estadisticas as $Estadistica)
    if($Jugador->posicion=='P'){
        if ($contador == 0){
            $Cuerpo .="<tr height=20 style='height:15.0pt' class='linea'>";
            $contador = 1;
        }else{
            $Cuerpo .="<tr height=20 style='height:15.0pt'>";
            $contador = 0;
        }
       $Cuerpo .="
              <td height=20 class=xl6426170 style='height:15.0pt'>$Estadistica->fecha</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->el</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->cl</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->i</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->bb</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->k</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->jg</td>
              <td class=xl6426170 style='border-left:none'>$Estadistica->errores</td>
              <td class=xl6426170 style='border-left:none'><form action=\"Modificar_E.php\" method=\"post\"><input type=\"hidden\" name=\"id_J\" value=\"".$Jugador->id."\"/><input type=\"hidden\" name=\"id_E\" value=\"".$Estadistica->id."\"/><input type=\"submit\" name=\"Modificar\" value=\"Modificar\" /></form></td>
              <td class=xl6426170 style='border-left:none'><form action=\"Modificar_E.php\" method=\"post\"><input type=\"hidden\" name=\"id_J\" value=\"".$Jugador->id."\"/><input type=\"hidden\" name=\"id_E\" value=\"".$Estadistica->id."\"/><input type=\"submit\" name=\"Eliminar\" value=\"Eliminar\" /></form></td>
             </tr>";
    }else{
       if ($contador == 0){
            $Cuerpo .="<tr height=20 style='height:15.0pt' class='linea'>";
            $contador = 1;
        }else{
            $Cuerpo .="<tr height=20 style='height:15.0pt'>";
            $contador = 0;
        }
       $Cuerpo .="
              <td height=20 class=xl6426170 style='height:15.0pt'>".$Estadistica->fecha."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->ca."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->vb."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->tb."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->ci."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->bb."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->br."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->k."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->h."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->h2."</td>
              <td class=xl6426170 style='border-left:none'>".$Estadistica->h3."</td>    
              <td class=xl6426170 style='border-left:none'>".$Estadistica->hr."</td>
              <td class=xl6426170 style='border-left:none'><form action=\"Modificar_E.php\" method=\"post\"><input type=\"hidden\" name=\"id_J\" value=\"".$Jugador->id."\"/><input type=\"hidden\" name=\"id_E\" value=\"".$Estadistica->id."\"/><input type=\"submit\" name=\"Modificar\" value=\"Modificar\" /></form></td>
              <td class=xl6426170 style='border-left:none'><form action=\"Modificar_E.php\" method=\"post\"><input type=\"hidden\" name=\"id_J\" value=\"".$Jugador->id."\"/><input type=\"hidden\" name=\"id_E\" value=\"".$Estadistica->id."\"/><input type=\"submit\" name=\"Eliminar\" value=\"Eliminar\" /></form></td>
             </tr>";
    }
    $tabla = $Encabezado . $Cuerpo . "</table>";

echo '<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />'; 
?>

<?php if(isset($_SESSION['Manager'])){?>
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
<?php }else { 
		echo '<ul id="navigation">
		<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        </ul>';
	}
echo '</div>

	   
	<div id="content">
		<div id="contenido_interno_esta">';
		
		echo '<form id="form" action="Agregar_E.php" method="post">
				<input type="hidden" name="id" value="'.$Jugador->id.'"/>
		        <input type="submit" value="Agregar Estadistica" />
		      </form>';
		
		echo '<h2>Estadisticas</h2>';
                  
                echo '<div id="box_info">';
                    echo $tabla;
                echo '</div>';
		
		
echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>
