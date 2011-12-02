<?php
        require_once 'include/dbconn/admin.php';
        require_once 'model/Juego.php';

        if (array_key_exists('juego_insert', $_POST)) {
                $fecha =
                        $_POST['year'  ] . '-' .
                        $_POST['month' ] . '-' .
                        $_POST['day'   ] . ' ' .
                        $_POST['hour'  ] . ':' .
                        $_POST['minute'] . ' ' .
                        $_POST['ampm'  ];

                $juego = new Juego();
                $data = array('inicio' => $fecha);
                foreach (Juego::fields() as $f) {
                        $k = str_replace(' ', '_', $f);
                        if (array_key_exists($k, $_POST)) $data[$f] = $_POST[$k];
                }
                $juego->set_all($data);
                $juego->insert();
        }

        header('Location: calendario');
?>
