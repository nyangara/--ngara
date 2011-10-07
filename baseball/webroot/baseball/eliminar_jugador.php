<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Triple Play</title>
                <link href="style.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
                <?
                include 'config.php';
                ?>
                <div id="delete">
                        <div id="logo">
                                <h1><a href="inicio.html"><span class="hidden">Triple Play</span></a></h1>
                        </div>
                        <div id="container">
                                <div id="header"></div>
                                <div id="navigation">
                                        <h2 class="hidden">Navigation</h2>
                                        <ul>
                                                <li><a href="consultar.html"  class="consult"><span class="hidden">Consultar </span></a></li>
                                                <li><a href="insertar.html"   class="insert" ><span class="hidden">Insertar  </span></a></li>
                                                <li><a href="eliminar.html"   class="delete" ><span class="hidden">Eliminar  </span></a></li>
                                                <li><a href="actualizar.html" class="update" ><span class="hidden">Actualizar</span></a></li>
                                        </ul>
                                </div>
                                <div id="content">
                                        <div id="content-left">
                                                <div id="title">
                                                        <h2 class="hidden">Indice</h2>
                                                </div>
                                                <div id="description">
                                                        <center>
                                                                <div class="menu_elem">
                                                                        <a href="eliminar_jugador.php" class="link_hide">Eliminar Jugador</a>
                                                                </div>

                                                                <div class="menu_elem">
                                                                        <a href="eliminar_estadio.php" class="link_hide">Eliminar Estadio</a>
                                                                </div>

                                                                <div class="menu_elem">
                                                                        <a href="eliminar_equipo.php" class="link_hide">Eliminar Equipo</a>
                                                                </div>

                                                                <div class="menu_elem">
                                                                        <a href="eliminar_juego.php" class="link_hide">Eliminar Juego</a>
                                                                </div>
                                                        </center>
                                                </div>
                                        </div>
                                        <div id="content-right">
                                                <div id="main">
                                                        <center>
                                                                <h3 style="color:#885411;">Eliminar Jugador</h3><br>
                                                                <table style="width:80%; margin:0px;text-align:left;"; cellpadding="2px;">
                                                                        <tr style="color:black;"><td>Nombre</td><td>Apellido</td><td>Número</td><td>Posición</td><td>Equipo</td></tr>

                                                                        <?
                                                                        $consulta=$baseball->prepare("SELECT * FROM jugador ");
                                                                        $consulta->execute();
                                                                        $jugador = $consulta->fetchAll();

                                                                        foreach ($jugador as $jug)
                                                                        {
                                                                        echo '<tr><td>'.$jug['Nombre'].'</td><td>'.$jug['Apellido'].'</td><td>'.$jug['Nro_uniforme'].'</td><td>'.$jug['Posicion'].'</td><td>'.$jug['nombre_equipo'].'</td><td><a href="eliminarjugador.php?id='.$jug['id'].'">Eliminar</a></td></tr>';
                                                                        }
                                                                        ?>

                                                                </table>
                                                        </center>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div id="footer">
                                <p>Un producto de Ñángara, Inc. <img src="images/vendor.png" alt="Una pieza del teclado de un computador, con el simbolo de ñangara." /></p>
                        </div>
                </div>
        </body>
</html>











