<?php

session_start();

if(isset ($_SESSION['Administrador'])){//Logiado como Administrador
    $Login = '
        <div id="login">         
             <form action="loginAction.php" method="POST" id="loginform">
                <p>
                    ERES ADMINISTRADOR
                    <input type="submit" name="Logout" class="submit" value="Logout" tabindex="3" />
                </p>
            </form>
        </div>';
}elseif(isset ($_SESSION['Manager'])){//Logueado como Manager
    $Login = '
        <div id="login">         
             <form action="loginAction.php" method="POST" id="loginform">
                <p>
                    ERES MANAGER
                    <input type="submit" name="Logout" class="submit" value="Logout" tabindex="3" />
                </p>
            </form>
        </div>';
}else{//no Logueado
    $Login = '
        <div id="login">         
            <form action="loginAction.php" method="POST" id="loginform">
                <p>
                <input title="username" name="username" class="username" value="Username" onclick="if ( value == \'Username\' ) { value = \'\'; }"/>
                <input name="password" type="password" class="password" title="password" value="Password" onclick="if ( value == \'Password\' ) { value = \'\'; }"/>
                <input type="hidden" name="TIPO" value="Usuario" />
                <input type="submit" name="Login" class="submit" value="login" tabindex="3" />
               </p>
            </form>
            <span class="Boton"> <a href="./Registro_Usr.php">Reg&iacutestate</a></span>
        </div>';
}


echo '<body>


<div id="wrapper">

    <div id="header">

        <div id="logo">
            <div id="logo_header">
                <div id="logo_carrera">
              <img src="assets/images/LogoGrande.png" alt="logo" width="48" height="48"> <p id="nombresistema">10th Inning Fantasy</p> </div>
          </div>
        </div>

            '.$Login.'

        <div id="updates">
            <span>Novedades: 
			<marquee behavior="scroll" direction="left" scrollamount="3" style=" float: left; margin-top: -86px; margin-left:70px;">Funcional al 90%</marquee>
			</span>
        </div>

';
?>