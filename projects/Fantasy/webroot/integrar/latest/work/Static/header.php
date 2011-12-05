<?php
        session_start();
        $u = null;
        if (array_key_exists('user', $_SESSION)) {
                $u = UIFacade::select('Usuario', array('id' => $_SESSION['user'])); // FIXME: esto es super inseguro
        }
?>
<body>
  <div id="wrapper">
    <div id="header">
      <div id="logo">
        <div id="logo_header">
          <div id="logo_carrera">
            <img src="assets/images/LogoGrande.png" alt="logo" width="48" height="48">
            <p id="nombresistema">10th Inning Fantasy</p>
          </div>
        </div>
      </div>
      <div id="login">
<?php   if ($u) { ?>
        <form action="logout" method="post" id="loginform">
          <p>
            <?php echo $u->get('username') . ($u->get('es administrador') ? ' (administrador)' : ''); ?>
            <button type="submit" name="action" class="submit" value="logout">Logout</button>
          </p>
        </form>
<?php   } else { ?>
        <form action="login" method="post" id="loginform">
          <p>
            <input type="text"     title="username" name="username" class="username" value="Username" onclick="if (value == 'Username') { value = ''; }"/>
            <input type="password" title="password" name="password" class="password" value="Password" onclick="if (value == 'Password') { value = ''; }"/>
            <button type="submit" name="action" class="submit" value="logout">Logout</button>
            <input type="submit" name="Login" class="submit" value="login" tabindex="3"/>
          </p>
        </form>
        <span class="Boton">
                <a href="register">Regístate</a>
        </span>
<?php   } ?>
      </div>
      <div id="updates">
        <span>Novedades:
          <marquee behavior="scroll" direction="left" scrollamount="3" style=" float: left; margin-top: -86px; margin-left:70px;">Funcional al 90%</marquee>
        </span>
      </div>
