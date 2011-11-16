<?php
echo '<body>


<div id="wrapper">

    <div id="header">

        <div id="logo">
            <div id="logo_header">
                <div id="logo_carrera">
              <img src="assets/images/LogoGrande.png" alt="logo" width="48" height="48"> <p id="nombresistema">10th Inning Fantasy</p> </div>
          </div>
        </div>

	  <div id="login">         
        <form action="#">
                <p>
                <input title="username" name="username" class="username" value="Username" onclick="if ( value == \'Username\' ) { value = \'\'; }"/>
                <input name="password" type="password" class="password" title="password" value="Password" onclick="if ( value == \'Password\' ) { value = \'\'; }"/>
                <input type="submit" name="Login" class="submit" value="login" tabindex="3" />
               </p>
         </form>
        <span class="Boton"> <a href="../registro.php">Reg&iacutestate</a></span></div>

<div id="updates">
            <span>Novedades:</span>
        </div>

';
?>