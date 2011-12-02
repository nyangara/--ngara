<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <title>Fantasy</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <meta name="keywords"    content="fantasy, beisbol venezolano, liga venezolana de beisbol profesional, lvbp"/>
                <meta name="description" content="Fantasy de la liga venezolana de beisbol profesional."/>

                <link rel="stylesheet" href="static/styles/style.css" type="text/css"/>
                <link rel="stylesheet" href="static/styles/style_index.css" type="text/css"/>
                <link rel="stylesheet" href="static/styles/style_<?php echo basename($_SERVER['SCRIPT_NAME'], '.php'); ?>.css" type="text/css"/>
                <link rel="Shortcut Icon" href="static/images/favicon.ico">
                <style type="text/css">
                        body {
                                background-image: url(static/images/background1.png);
                        }
                </style>
        </head>
        <body>
                <div id="wrapper">
                        <div id="header">
                                <div id="logo">
                                        <div id="logo_header">
                                                <div id="logo_carrera">
                                                        <img src="static/images/LogoGrande.png" alt="logo" width="48" height="48"/>
                                                        <p id="nombresistema">Fantasy</p>
                                                </div>
                                        </div>
                                </div>
                                <div id="login">
                                        <form action="#">
                                                <p>
                                                        <input                 title="username" name="username" class="username" value="Username" onclick="if ( value == 'Username' ) { value = ''; }"/>
                                                        <input type="password" title="password" name="password" class="password" value="Password" onclick="if ( value == 'Password' ) { value = ''; }"/>
                                                        <input type="submit"                    name="Login"    class="submit"   value="login"    tabindex="3"/>
                                                </p>
                                        </form>
                                        <span class="Boton"><a href="registro.php">Regístrate</a></span>
                                </div>
                                <div id="updates">
                                        <span>Novedades:</span>
                                </div>
                                <ul id="navigation">
<?php
        $vs = array(
                'Inicio'      => 'index',
                'Noticias'    => 'noticias',
                'Estadios'    => 'estadios',
                'Equipos'     => 'equipos',
                'Jugadores'   => 'jugadores',
                'Calendario'  => 'calendario',
                'Resultados'  => 'resultados',
                'Ligas'       => 'ligas',
                'Reglas'      => 'reglas',
                'Información' => 'información'
        );

        foreach ($vs as $v => $f) {
                $on = '';
                if ($f == basename($_SERVER['SCRIPT_NAME'], '.php')) $on = ' class="on"';
?>
                                        <li<?php echo $on; ?>><a href="<?php echo $f; ?>"><?php echo $v; ?></a></li>
<?php   } ?>
                                </ul>
                        </div>
                        <div id="content">
