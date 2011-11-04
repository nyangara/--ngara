<?php
include_once "functional.php";
include_once "config.php";

$as = array(
        'home' => array(
                'title'       => 'Inicio',
                'main_div_id' => 'home',
                'vs'          => array()
        ),
        'consultar' => array(
                'title'       => 'Consulta',
                'main_div_id' => 'consult',
                'vs'          => array(
                        'estadio' => array('name' => 'Estadios' , 'title' => 'Estadios' ),
                        'equipo'  => array('name' => 'Equipos'  , 'title' => 'Equipos'  ),
                        'juego'   => array('name' => 'Juegos'   , 'title' => 'Juegos'   ),
                        'jugador' => array('name' => 'Jugadores', 'title' => 'Jugadores')
                )
        ),
        'insertar' => array(
                'title'       => 'Inserción',
                'main_div_id' => 'insert',
                'vs'          => array(
                        'juego'   => array('name' => 'Juego'    , 'title' => 'Juego'    ),
                        'jugador' => array('name' => 'Jugador'  , 'title' => 'Jugador'  )
                )
        ),
        'actualizar' => array(
                'title'       => 'Actualización',
                'main_div_id' => 'update',
                'vs'          => array(
                        'juego'   => array('name' => 'Juegos'   , 'title' => 'Juegos'   ),
                        'jugador' => array('name' => 'Jugadores', 'title' => 'Jugadores')
                )
        )
);

if (array_key_exists('a', $_GET)) {
        if (!array_key_exists($_GET['a'], $as)) {
                die ("Bad action: " . $_GET['a']);
        }
} else {
        $_GET['a'] = 'home';
}
$a = $as[$_GET['a']];

if (array_key_exists('v', $_GET)) {
        if (!array_key_exists($_GET['v'], $a['vs'])) {
                die ("Bad view: " . $_GET['v']);
        }
        $v = $a['vs'][$_GET['v']];
} else {
        $v = null;
}

function print_contents($a, $v) {
        if ($a && $v) {
                try {
                        include $_GET['a'] . '_' . $_GET['v'] . ".php";
                } catch (Exception $e) {
                        echo '<!-- include failed: $e->getMessage(); -->';
                }
        }
}

function print_views($a) {
        foreach ($a['vs'] as $v => $ps) {
                echo '<a href="tripleplay.php?a=' . $_GET['a'] . "&v=" . $v . '" class="link_hide"><div class="menu_elem">' . $ps['name'] . '</div></a>';
        }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Triple Play - <?php echo $a['title']; ?></title>
                <link href="style.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
                <div id="<?php echo $a['main_div_id']; ?>">
                        <div id="logo">
                                <h1><a href="inicio.html"><span class="hidden">Triple Play</span></a></h1>
                        </div>
                        <div id="container">
                                <div id="header"></div>
                                <div id="navigation">
                                        <h2 class="hidden">Navigation</h2>
                                        <ul>
                                                <li><a href="tripleplay.php?a=consultar"  class="consult"><span class="hidden">Consultar </span></a></li>
                                                <li><a href="tripleplay.php?a=insertar"   class="insert" ><span class="hidden">Insertar  </span></a></li>
                                                <li><a href="tripleplay.php?a=actualizar" class="update" ><span class="hidden">Actualizar</span></a></li>
                                        </ul>
                                </div>
                                <div id="content">
                                        <div id="content-left">
                                                <div id="title">
                                                        <h2 class="hidden">Indice</h2>
                                                </div>
                                                <div id="description">
                                                        <center><?php print_views($a); ?></center>
                                                </div>
                                        </div>
                                        <div id="content-right">
                                                <div id="main">
                                                        <?php print_contents($a, $v); ?>
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
