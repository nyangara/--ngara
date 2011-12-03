<?php
/*
<?php
        if(isset($_POST['Aplicar'])){
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d');
                $_POST['fecha']=$fecha;
                $_POST['tipoC']='noticia';

                unset($_POST['Aplicar']);
                UIFacade::insert('Contenido');
                header('Location: noticias');
        }
?>
*/
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<div id="contenido_interno">
        <div id="box_info">
                <form action="controller_noticia_update" method="post" id="Alcance">
                        <table width="550" border="0">
                        <tr>
                                <th style="border: 2px solid #cccccc">
                                        Agregar juego
                                </th>
                        </tr>
                                <tr>
                                        <td>
                                                <table width="400" border="0">
                                                        <tr>
                                                                Título:<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                                                <input type="text" name="título" value="" size="25"/>
                                                        </tr>
                                                        <tr>
                                                                <td>Contenido:</td>
                                                                <td>
                                                                        <textarea name="texto" id="texto" cols="40" rows="4"></textarea>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td>URL de la imagen:</td>
                                                                <td colspan="2">
                                                                        <input type="text" name="URL de la imagen" value="" size="25"/>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td>Tags:</td>
                                                                <td colspan="2">
                                                                        <input type="text" name="tags" value="" size="25"/>
                                                                </td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                        </table>
                        <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>"/>
                        <input type="submit" name="noticia_update" value="Aplicar"/>
                </form>
        </div>
</div>
<?php   require 'include/post.html'; ?>
