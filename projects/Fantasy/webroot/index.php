<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<!-- Starting slider... -->
<script type="text/javascript" src="static/js/jquery.js"></script>
<script type="text/javascript" src="static/js/s3SliderPacked.js"></script>
<script type="text/javascript" src="static/js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').s3Slider({
            timeOut: 4000
        });
    });
</script>

<div id="slider">
    <ul id="sliderContent">
        <li class="sliderImage">
            <a href=""><img src="slider_images/imagen1.jpg" alt="1" width="600" height="300" /></a>
            <span class="left"><strong>Vive...</strong><br />La emoción de el béisbol...</span>
        </li>
        <li class="sliderImage">
            <a href=""><img src="slider_images/imagen2.jpg" alt="2" width="600" height="300" /></a>
            <span class="right"><strong>Diseña...</strong><br />El equipo de tus sueños...</span>
        </li>
        <li class="sliderImage">
            <img src="slider_images/imagen3.jpg" alt="3" width="600" height="300" />
            <span class="right"><strong>Juega...</strong><br />El Fantasy de la LPBV</span>
        </li>
        <div class="clear sliderImage"></div>
    </ul>
</div>
<!-- Slider ended. -->

<div id="login">
        <div>
                <form action="#">
                <h2>Acceder</h2>
                        <p>Nombre de usuario: </p>
                        <p><input type="text" name="username" value=""/></p>
                        <p>Contraseña:</p>
                        <p><input type="password" name="password" value=""/></p>
                        <p><input name="Login" type="submit" value="Acceder"/></p>
                </form>
        </div>
        <div>
                <h2>¿Eres nuevo?</h2>
                <form action="registro.php">
                    <input name="Register" type="submit" value="Crear cuenta"/>
                </form>
        </div>
</div>
<?php   require('include/post.html'); ?>
