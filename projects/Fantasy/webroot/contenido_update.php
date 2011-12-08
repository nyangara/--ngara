<?php
        require 'include/pre.php';

        if (has_auth('admin') && array_key_exists('id', $_GET)) {
                $c = UIFacade::select('Contenido', array('id' => $_GET['id']));
?>
<h2>Actualizar contenido</h2>
<div>
  <form action="controller" method="post" id="Alcance">
    <input type="hidden" name="goto" value="index"/>
    <table width="400" border="0">
      <tr>
        <td>Título:</td>
        <td>
          <input type="text" name="título" value="<?php echo $c->get('título'); ?>" size="25"/>
        </td>
      </tr>
      <tr>
        <td>Contenido:</td>
        <td>
          <textarea name="texto" id="texto" cols="40" rows="4"><?php echo $c->get('texto'); ?></textarea>
        </td>
      </tr>
      <tr>
        <td>URL de la imagen:</td>
        <td>
          <input type="text" name="URL de imagen" value="<?php echo $c->get('URL de imagen'); ?>" size="25"/>
        </td>
      </tr>
      <tr>
        <td>Tipo:</td>
        <td>
          <select name="tipo">
<?php           foreach (UIFacade::enum_values('tipo de contenido') as $v) { ?>
            <option value="<?php echo $v; ?>"<?php if ($c->get('tipo') == $v) echo $c->get('tipo'); ?>><?php echo mb_ucfirst($v, 'utf-8'); ?></option>
<?php           } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Tags:</td>
        <td>
          <input type="text" name="tags" value="<?php echo $c->get('tags'); ?>" size="25"/>
        </td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo $c->get('id'); ?>"/>
    <button type="submit" name="action" value="contenido_update">Aplicar</button>
  </form>
</div>
</div>
<?php
        }

        require 'include/post.html';
?>
