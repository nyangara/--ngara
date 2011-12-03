<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<style type="text/css" media="screen">
        #slider1 {
                width: 600px; /* important to be same as image width */
                height: 190px; /* important to be same as image height */
                position: relative; /* important */
                overflow: hidden; /* important */
                -webkit-border-top-left-radius: 10px;
                -webkit-border-top-right-radius: 10px;
                -moz-border-radius-topleft: 10px;
                -moz-border-radius-topright: 10px;
        }

        #slider1Content {
                width: 600px; /* important to be same as image width or wider */
                position: absolute;
                top: 0;
                margin-left: 0;
        }
        .slider1Image {
                float: left;
                position: relative;
                display: none;
        }
        .slider1Image span {
                position: absolute;
                font: 10px/15px Arial, Helvetica, sans-serif;
                padding: 10px 13px;
                width: 600px;
                background-color: #000;
                filter: alpha(opacity=70);
                -moz-opacity: 0.7;
                -khtml-opacity: 0.7;
                opacity: 0.7;
                color: #fff;
                display: none;
        }
        .clear {
                clear: both;
        }
        .slider1Image span strong {
                font-size: 14px;
        }
        .left {
                top: 0;
                left: 0;
                width: 110px !important;
                height: 190px;
        }
        .right {
                right: 0px;
                bottom: -20px;
                width: 110px !important;
                height: 190px;
        }
        ul {
                list-style-type: none;
        }
</style>

<script type="text/javascript" src="static/js/jquery.js"></script>
<script type="text/javascript" src="static/js/s3SliderPacked.js"></script>
<script type="text/javascript" src="static/js/s3SliderPacked.js"></script>
<script type="text/javascript" src="static/js/s3Slider.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
                $('#slider1').s3Slider({
                        timeOut: 4000
                });
        });
</script>

<div id="slider1">
        <ul id="slider1Content">
                <li class="slider1Image">
                        <img src="static/images/slider/imagen1.jpg" alt="1"/>
                        <span class="left"><strong>Vive...</strong><br />La emoción de el béisbol...</span>
                </li>
                <li class="slider1Image">
                        <img src="static/images/slider/imagen2.jpg" alt="2"/>
                        <span class="right"><strong>Diseña...</strong><br />El equipo de tus sueños...</span>
                </li>
                <li class="slider1Image">
                        <img src="static/images/slider/imagen3.jpg" alt="3"/>
                        <span class="right"><strong>Juega...</strong><br />El Fantasy de la LPBV</span>
                </li>
                <div class="clear slider1Image"></div>
        </ul>
</div>

<h2>Acceder</h2>
<form action="#"><!-- TODO: login -->
        <p>Nombre de usuario: <input type="text"     name="username" value=""/></p>
        <p>Contraseña:        <input type="password" name="password" value=""/></p>
        <p><input name="Login" type="submit" value="Acceder"/></p>
</form>
<br/>
<h2>¿Eres nuevo? Regístrate</h2>
<form action="#"><!-- TODO: registro -->
        <p>Nombre            <input type="text"     name="username" value=""/></p>
        <p>Apellido          <input type="text"     name="username" value=""/></p>
        <p>E-mail            <input type="text"     name="username" value=""/></p>
        <p>Nombre de usuario <input type="text"     name="username" value=""/></p>
        <p>Contraseña        <input type="password" name="password" value=""/></p>
        <p><input type="submit" name="Register" value="Regístrate"/></p>
</form>

<?php   require 'include/post.html'; ?>
