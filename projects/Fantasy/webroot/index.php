<?php
        require 'include/pre.php';

        $q = array_key_exists('q', $_GET) ? $_GET['q'] : null;
?>
<script type="text/javascript" src="static/js/jquery.js"        />
<script type="text/javascript" src="static/js/s3SliderPacked.js"/>
<script type="text/javascript" src="static/js/s3Slider.js"      />
<script type="text/javascript">
//<![CDATA[
        $(document).ready(function() {
                $('#slider').s3Slider({
                        timeOut: 4000
                });
        });
//]]>
</script>

<div id="slider">
  <ul id="sliderContent">
    <li class="sliderImage">
      <img src="static/images/slider/01.jpg" alt="Jugador de béisbol" width="600" height="300"/>
      <span class="left">
        <strong>Vive...</strong>
        <br/>
        La emoción del béisbol...
      </span>
    </li>
    <li class="sliderImage">
      <img src="static/images/slider/02.jpg" alt="Jugador de béisbol" width="600" height="300"/>
      <span class="right">
        <strong>Diseña...</strong>
        <br/>
        El equipo de tus sueños...
      </span>
    </li>
    <li class="sliderImage">
      <img src="static/images/slider/03.jpg" alt="Jugador de béisbol" width="600" height="300"/>
      <span class="right">
        <strong>Juega...</strong>
        <br/>
        El Fantasy de la LPBV
      </span>
    </li>
    <li><div class="clear sliderImage"></div></li>
  </ul>
</div>

<h2>Noticias</h2>
<?php   if (has_auth('admin')) { ?>
<form method="get" action="contenido_insert">
  <p><button type="submit">Agregar contenido</button></p>
</form>
<?php   } ?>
<div id="search">
  <form method="get" action="index">
    <p>
      <input type="text" name="q" value="<?php echo $q; ?>"/>
      <button type="submit">Buscar</button>
    </p>
  </form>
</div>
<div id="else">
<?php
        foreach (UIFacade::contenidos('noticia', $q) as $c) {
                $id   = $c->get('id'           );
                $tags = $c->get('tags'         );
                $img  = $c->get('URL de imagen');
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/contenido/' . $img;
?>
  <div>

<?php           if (has_auth('admin')) { ?>
    <div class="admin-options">
      <form action="controller" method="post">
        <p><input type="hidden" name="id" value="<?php echo $id; ?>"/></p>
        <p><button type="submit" name="action" value="contenido_remove" style="width: 5em">Eliminar</button></p>
      </form>
      <form action="contenido_update" method="get">
        <p><input type="hidden" name="id" value="<?php echo $id; ?>"/></p>
        <p><button type="submit" method="get">Modificar</button></p>
      </form>
    </div>
<?php           } ?>

    <h3><?php echo $c->get('título'); ?></h3>
    <h4><?php echo $c->get('fecha'); ?></h4>
    <br/>

<?php           if ($img) { ?>
    <img src="<?php echo $img; ?>" alt="Imagen"/>
<?php           } ?>

    <?php echo $c->get('texto'); ?>

<?php           if ($tags) { ?>
    <p><strong>Etiquetas:</strong> <?php echo $tags; ?></p>
<?php           } ?>

  </div>
<?php   } ?>
</div>
<?php   require 'include/post.html'; ?>
