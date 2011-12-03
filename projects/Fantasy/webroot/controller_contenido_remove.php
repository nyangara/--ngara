<?php
        require_once 'include/dbconn/admin.php';
        require_once 'model/Contenido.php';

        if (array_key_exists('contenido_remove', $_POST)) {
                $c = new Contenido();
                $data = array();
                foreach (Contenido::pk() as $f) {
                        $k = str_replace(' ', '_', $f);
                        if (array_key_exists($k, $_POST)) $data[$f] = $_POST[$k];
                }
                $c->set_all($data);
                $c->remove();

                header('Location: ' . $_POST['goto']);
        }
?>
