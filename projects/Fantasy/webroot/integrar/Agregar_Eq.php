<?php

require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/EstadioFachada.php");

$FachadaE = new EquipoFachada();
$FachadaEstadio = new EstadioFachada();

// En caso de que se vaya a agregar
if(isset($_POST['Aplicar'])){

        $fecha = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];

        $Equipo = new Equipo($_POST['nombre'],$_POST['siglas'],$fecha,$FachadaEstadio->getID($_POST['nombrehome']));

        $FachadaE->insertEquipo($Equipo);

        header('Location: gestion_equipos.php');
}


?>

<?php

include("Static/head.php");
include("Static/header.php");

echo '<link rel="stylesheet" href="assets/styles/style_Agregar_Eq.css"  type="text/css" />';

echo '


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
                <div id="contenido_interno_datos">';

echo'
                <div id="box_info">


            <form id="Alcance" action="Agregar_Eq.php" method="post">
                <div id="Foto">
                        <img src="assets/images/Fotos_Equipos/generico.jpg" />
                </div>

                <div id="InfBas">

                    <div>
                        <label for="siglas">Siglas: </label>
                        <input size="10" type="text" name="siglas" id="siglas" value="" />
                    </div>

                    <div>
                        <label for="nombre">Nombre del Equipo: </label>
                        <input size="10" type="text" name="nombre" id="nombre" value=""  />
                    </div>



                    <div>
                        <label >Fecha de Fundacion: </label>
                        <label for="dia">D&iacutea: </label>
                                                        <select name="dia">';
                                                                for ($i = 1 ; $i<=31 ; $i++)
                                                                        echo "<option value=".$i.">".$i."</option>";

                                                                        echo '
                                                        </select>

                                                <label for="mes">Mes: </label>
                                                        <select name="mes">';

                                                                $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Julio", "Junio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre");

                                                                for ($i = 0 ; $i < 12 ; $i++)
                                                                        echo "<option value=".$i.">".$mes[$i]."</option>";

                                                                        echo '
                                                        </select>

                                                <label for="anio">A&ntildeo: </label>

                                                        <select name="anio">';

                                                                for ($i = 1960 ; $i<=date('Y') ; $i++)
                                                                        echo "<option value=".$i.">".$i."</option>";


                                                                        echo '
                                                        </select>
                    </div>

                    <div>
                        <label for="nombrehome">Casa: </label>
                        <select name="nombrehome"> ';
                                                        $NE = $FachadaEstadio->getTagsEstadio(); //Nombres Estadios
                                                        $N = count($NE);
                                                        for ($i = 0 ; $i<$N ; $i++)
                                                                echo "<option value=".$NE[$i].">".$NE[$i]."</option>";
                                                echo'
                                                </select>
                    </div>
                </div>
                <div id="InfExt">

                </div>

                                <input type="submit" name="Aplicar" value="Aplicar"/>
            </form>
      </div>

        ';

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>
