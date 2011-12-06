<?php
        require 'include/pre.php';

        function select_opts($name, $range, $now, $format) {
                $r = '<select name="' . $name . '">';
                foreach ($range as $i) {
                        $r .= sprintf(
                                '<option value="' . $format . '"%s>' . $format . '</option>',
                                $i,
                                ($i == $now ? ' selected="selected"' : ''),
                                $i
                        );
                }
                return $r . "</select>";
        }
?>
<h2>Nuevo usuario</h2>
<form action="register" method="post">
  <p>Nombre de usuario:  <input type="text"     name="username"           /></p>
  <p>Contraseña:         <input type="password" name="password"           /></p>
  <p>Repetir contraseña: <input type="password" name="password2"          /></p>
  <p>Nombre completo:    <input type="text"     name="nombre completo"    /></p>
  <p>Correo electrónico: <input type="text"     name="dirección de e-mail"/></p>
  <p>URL del avatar:     <input type="text"     name="URL del avatar"     /></p>
  <p>
    Género:
      <select name="género">
<?php   foreach (UIFacade::enum_values('género') as $v) { ?>
        <option value="<?php echo $v; ?>"><?php echo mb_ucfirst($v, 'utf-8'); ?></option>
<?php   } ?>
      </select>
  </p>
  <p>
    <?php echo select_opts('day', range(1, 31), date('d'), '%02d'); ?>
    /
    <?php echo select_opts('month', range(1, 12), date('n'), '%02d'); ?>
    /
    <?php $y = date('Y'); echo select_opts('year' , range($y - 100, $y), $y, '%d'); ?>
  </p>
  <button type="submit" name="action" value="register">Registrar</button>
</form>
<?php   require 'include/post.html'; ?>
