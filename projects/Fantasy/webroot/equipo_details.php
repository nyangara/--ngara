<?php
        require 'include/pre.php';

        if (has_auth('admin') && array_key_exists('id', $_GET)) {
                $e = UIFacade::select('Equipo', array('id' => $_GET['id']));
                $img = $e->get('URL del logo');
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img;
?>
<h2>Detalles del equipo</h2>
<div>
  <img src="<?php echo $img; ?>"/>
  <p><strong>Nombre completo:                </strong> <?php echo $e->get('nombre completo' ); ?></p>
  <p><strong>Nombre corto:                   </strong> <?php echo $e->get('nombre corto'    ); ?></p>
  <p><strong>Siglas:                         </strong> <?php echo $e->get('siglas'          ); ?></p>
  <p><strong>Año de fundación:               </strong> <?php echo $e->get('año de fundación'); ?></p>
  <p><strong>Ciudad:                         </strong> <?php echo $e->get('ciudad'          ); ?></p>
  <p><strong>Estado:                         </strong> <?php echo $e->get('estado'          ); ?></p>
  <p><strong>Estadio principal:              </strong> <?php echo UIFacade::select('Estadio', array('id' => $e->get('estadio principal')))->get('nombre'); ?></p>
</div>
<?php
        }

        require 'include/post.html';
?>
