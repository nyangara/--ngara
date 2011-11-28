<?php

    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    $id = $_POST['id'];
    unset($_POST);

    $_POST['id']=$id;
    $_POST['TIPO']='Equipo';
    $Equipo = $instancia->obtener();

    include("Static/head.php");
    include("Static/header.php");

?>

<link rel="stylesheet" href="assets/styles/style_Datos_Es.css"  type="text/css" />
	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li class="on"><a href="gestion_equipos.php">Equipos</a></li>
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
    <div id="contenido_interno_datos">

        <div id="box_info">
            <form id="Alcance">
                <table width="550" border="0">
                    <tr>
                        <td>
                            <img src="<?php echo $Equipo->logo; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="400" border="0" align="center">
                                <tr>
                                    <td>Nombre del Equipo </td>
                                    <td><?php echo $Equipo->nombre; ?></td>
                                    <td>Siglas </td>
                                    <td><?php echo $Equipo->siglas; ?></td>
                                </tr>
                                <tr>
                                    <td>Fecha de fundación </td>
                                    <td><?php echo $Equipo->fecha_fundacion; ?></td>
                                    <td>Casa</td>
                                    <td><?php echo $Equipo->home; ?></td>
                                </tr>
                                <tr>
                                    <td>Precio </td>
                                    <td><?php echo $Equipo->precio; ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div id="env" >
            <form action="gestion_equipos.php" method="post">
                <input type="submit" value="Regresar"/>
            </form>
            <form action="Listar_D_Eq.php" method="post">
                <input type="hidden" name="id" value="<?php echo $Equipo->id; ?>" />
                <input type="submit" name="Detalles" value="Ver Detalles"  />        
            </form>
            <form action="Modificar_Eq.php" method="post">
                <input type="hidden" name="id" value="<?php echo $Equipo->id; ?>" />
                <input type="submit" name="Modificar" value="Modificar"  />      
            </form>			
            <form action="Modificar_Eq.php" method="post">
                <input type="hidden" name="id" value="<?php echo $Equipo->id; ?>" />
                <input type="submit" name="Eliminar" value="Eliminar"  />      
            </form>
        </div>

    </div>
        
<?
    include("Static/sideBar.php");
    include("Static/footer.php");	

?>
