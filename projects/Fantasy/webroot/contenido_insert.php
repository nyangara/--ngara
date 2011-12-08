<?php   require 'include/pre.php'; ?>
<h2>Agregar contenido</h2>
<div>
        <form action="controller" enctype="multipart/form-data" method="post" id="Alcance">
                <input type="hidden" name="goto" value="index"/>
                        <table width="400" border="0">
                                <tr>
                                        <td>Título:</td>
                                        <td>
                                                <input type="text" name="título" value="" size="25"/>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Contenido:</td>
                                        <td>
                                                <textarea name="texto" id="texto" cols="40" rows="4"></textarea>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Imagen:</td>
                                        <td>
                                                <input type="file" name="imagen" size="25"/>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Tipo:</td>
                                        <td>
                                                <select name="tipo">
<?php   foreach (UIFacade::enum_values('tipo de contenido') as $v) { ?>
                                                        <option value="<?php echo $v; ?>"><?php echo mb_ucfirst($v, 'utf-8'); ?></option>
<?php   } ?>
                                                </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Tags:</td>
                                        <td>
                                                <input type="text" name="tags" value="" size="25"/>
                                        </td>
                                </tr>
                        </table>
                        <button type="submit" name="action" value="contenido_insert">Aplicar</button>
                </form>
        </div>
</div>
<?php   require 'include/post.html'; ?>
