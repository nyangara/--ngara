<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <title>Liga Fantástica</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="keywords"    content="fantasy, beisbol venezolano, liga venezolana de beisbol profesional, lvbp" />
                <meta name="description" content="Fantasy de la liga venezolana de beisbol profesional." />
                <link rel="stylesheet" href="static/styles/main_style.css" type="text/css" />
                <link rel="Shortcut Icon" href="static/images/favicon.ico" />
        </head>
        <body id="<?php echo basename($_SERVER['SCRIPT_NAME'], '.php') ?>">
                <div id="wrapper">
                        <div id="header">
                                <div id="logo">
                                        <img src="static/images/LogoGrande.png" alt="logo" width="48" height="48"/>
                                        <h1><a href="index.php">Liga Fantástica</a></h1>
                                </div>
                        </div>
                        <div id="navigation">
                                <ul>
<?php
        $vs = array(
                'Noticias'    => 'noticias',
                'Estadios'    => 'estadios',
                'Equipos'     => 'equipos',
                'Jugadores'   => 'jugadores',
                'Calendario'  => 'calendario',
                'Resultados'  => 'resultados',
                'Ligas'       => 'ligas'
        );

        foreach ($vs as $v => $f) {
                $on = '';
                if ($f == basename($_SERVER['SCRIPT_NAME'], '.php')) $on = ' class="on"';
?>
                                <li<?php echo $on; ?>><a href="<?php echo $f . ".php"; ?>"><?php echo $v; ?></a></li>
<?php   } ?>
                                </ul>
                        </div>
                        <div id="content">
                                <div id="main">
