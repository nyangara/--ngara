<?php   require 'include/session.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Liga Fantástica</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
          <h1><a href="index.php">Liga Fantástica</a></h1>
        </div>
        <div id="login">
<?php   if (userdata()) { ?>
          <form action="logout" method="post" id="loginform">
            <p>
              <?php echo userdata()->get('username') . (userdata()->get('es administrador') == 't' ? ' (administrador)' : ''); ?>
              <button type="submit" name="action" class="submit" value="logout">Logout</button>
            </p>
          </form>
<?php   } else { ?>
          <form action="login" method="post" id="loginform">
            <p>
              <input  type="text"     name="username" class="username" value="Username" onclick="if (value == 'Username') { value = ''; }"/>
              <input  type="password" name="password" class="password" value="Password" onclick="if (value == 'Password') { value = ''; }"/>
              <button type="submit"   name="action"   class="submit"   value="login">Login</button>
            </p>
          </form>
          <span class="Boton">
                  <a href="registro">Regístrate</a>
          </span>
<?php   } ?>
        </div>
        <div id="updates">
          <span>
            <strong>Novedades:</strong>
            <marquee behavior="scroll" direction="left" scrollamount="3">Funcional e integrado en un 99.99999999999999999999999999999999999999999999999999999999999%</marquee>
          </span>
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
                'Ligas'      => array('authorization' => 'user' , 'views' => array('ligas'     , 'ligas_privadas', 'ligas_publicas')),
                'Usuarios'   => array('authorization' => 'admin', 'views' => array('usuarios'  ))
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
