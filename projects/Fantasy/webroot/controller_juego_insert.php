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
                $juego->set_all(array_reduce(
                        Juego::fields(),
                        function ($acc, $f) {
                                $k = str_replace(' ', '_', $f);
                                if (array_key_exists($k, $_POST)) $acc[$f] = $_POST[$k];
                                return $acc;
                        },
                        array('inicio' => $fecha)
                ));
                $juego->insert();
        }

        header('Location: calendario');
?>
