<?php
        require_once 'include/dbconn/admin.php';
        require_once 'model/Contenido.php';

        if (array_key_exists('contenido_insert', $_POST)) {
                date_default_timezone_set('America/Caracas');
                $c = new Contenido();
                $data = array('fecha' => date('Y-m-d H:i:sP'));
                foreach (Contenido::fields() as $f) {
                        $k = str_replace(' ', '_', $f);
                        if (array_key_exists($k, $_POST)) $data[$f] = $_POST[$k];
                }
                $c->set_all($data);
                $c->insert();

                header('Location: ' . $_POST['goto']);
        }
?>
