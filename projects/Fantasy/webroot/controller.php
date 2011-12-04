<?php
        require_once 'include/dbconn/admin.php';
        require_once 'include/UIFacade.php';

        $actions = array(
                'contenido_insert' => function () {
                        date_default_timezone_set('America/Caracas');
                        UIFacade::insert('Contenido', set_fields('Contenido', array(
                                'fecha' => date('Y-m-d H:i:sP'),
                                'tipo' => 'noticia'
                        )));
                },
                'contenido_remove' => function () { UIFacade::remove('Contenido', set_pk('Contenido')); },
        );

        function set_data($entity_class, &$data = array(), $kind_of_data = 'fields') {
                if (in_array($kind_of_data, array('fields', 'pk'))) {
                        foreach (UIFacade::$kind_of_data($entity_class) as $f) {
                                $k = str_replace(' ', '_', $f);
                                if (array_key_exists($k, $_POST) and !array_key_exists($f, $data)) $data[$f] = $_POST[$k];
                        }
                }
                return $data;
        }
        function set_fields($entity_class, &$data = array()) { return set_data($entity_class, $data, 'fields'); }
        function set_pk    ($entity_class, &$data = array()) { return set_data($entity_class, $data, 'pk'    ); }

        if (array_key_exists('action', $_POST) and array_key_exists($_POST['action'], $actions)) {
                call_user_func($actions[$_POST['action']]);
        }

        if (array_key_exists('goto', $_POST)) {
                header('Location: ' . $_POST['goto']);
        } else {
                header('Location: index');
        }
?>
