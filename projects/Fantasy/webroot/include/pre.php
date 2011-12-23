<?php
        require 'include/session.php';

        $xhtml = true;
        require_once 'include/conneg.phi';
        $conneg = new contentNegotiation();
        $uastring = $_SERVER['HTTP_USER_AGENT'];
        header('Vary: Accept, User-Agent');
        if (
                $conneg->compareQ('application/xhtml+xml,text/html') == 'application/xhtml+xml' &&
                !strpos($uastring,'MSIE')
        ) {
                header('Content-Type:application/xhtml+xml');
        } else {
                header('Content-Type:text/html;charset=utf-8');
                $xhtml = false;
        }

        if ($xhtml) {
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<?php   } else { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
<?php   } ?>
  <head>
    <title>Liga de Fantasía</title>
    <meta http-equiv="Content-Type" content="<?php echo $xhtml ? 'application/xhtml+xml' : 'text/html'; ?>; charset=utf-8"/>
    <meta name="keywords"    content="fantasy, beisbol venezolano, liga venezolana de beisbol profesional, lvbp"/>
    <meta name="description" content="Fantasy de la liga venezolana de beisbol profesional."/>
    <link rel="stylesheet" href="static/styles/main_style.css" type="text/css"/>
    <link rel="Shortcut Icon" href="static/images/favicon.ico"/>
  </head>
  <body id="<?php echo basename($_SERVER['SCRIPT_NAME'], '.php') ?>">
    <div id="wrapper">
      <div id="header">
        <div id="logo">
          <img src="static/images/LogoGrande.png" alt="logo" width="48" height="48"/>
          <h1><a href="index.php">Liga de Fantasía</a></h1>
        </div>
        <div id="login">
<?php   if (userdata()) { ?>
          <form action="logout" method="post" id="loginform">
            <p>
              <strong><?php echo userdata()->get('username'); ?></strong>
              <?php if (userdata()->get('es administrador') == 't') echo ' (administrador)'; ?>
              <button type="submit" name="action" class="submit" value="logout">Logout</button>
            </p>
          </form>
<?php   } else { ?>
          <form action="login" method="post" id="loginform">
            <p>
              <input  type="text"     name="username" class="username" value="Username" onclick="if (value == 'Username') { value = ''; }"/>
              <input  type="password" name="password" class="password" value="Password" onclick="if (value == 'Password') { value = ''; }"/>
              <button type="submit"   name="action"   class="login"    value="login">Login</button>
            </p>
          </form>
          <span class="Boton">
            <a href="registro">Regístrate</a>
          </span>
<?php   } ?>
        </div>
        <div id="navigation">
          <ul>
<?php
        $vs = array(
                'Noticias'   => array('authorization' => 'guest', 'views' => array('index'     )),
                'Jugadores'  => array('authorization' => 'guest', 'views' => array('jugadores' )),
                'Equipos'    => array('authorization' => 'guest', 'views' => array('equipos'   )),
                'Estadios'   => array('authorization' => 'guest', 'views' => array('estadios'  )),
                'Calendario' => array('authorization' => 'guest', 'views' => array('calendario')),
                'Resultados' => array('authorization' => 'guest', 'views' => array('resultados')),
                'Roster'     => array('authorization' => 'user' , 'views' => array('roster'    )),
                'Ligas'      => array('authorization' => 'user' , 'views' => array('ligas'     , 'ligas_privadas', 'ligas_publicas')),
                'Usuarios'   => array('authorization' => 'user' , 'views' => array('usuarios'  ))
        );

        foreach ($vs as $v => $f) if (has_auth($f['authorization'])) {
?>
            <li<?php echo in_array(basename($_SERVER['SCRIPT_NAME'], '.php'), $f['views']) ? ' class="on"' : ''; ?>>
              <a href="<?php echo $f['views'][0] . '.php'; ?>"><?php echo $v; ?></a>
            </li>
<?php   } ?>
          </ul>
        </div>
      </div>
      <div id="content">
        <div id="main">
