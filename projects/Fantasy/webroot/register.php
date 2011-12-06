<?php
        if (
                array_key_exists('action'             , $_POST) and
                array_key_exists('username'           , $_POST) and
                array_key_exists('password'           , $_POST) and
                array_key_exists('password2'          , $_POST) and
                array_key_exists('nombre_completo'    , $_POST) and
                array_key_exists('dirección_de_e-mail', $_POST) and
                $_POST['action'] == 'register'
        ) {
                require 'include/config.php';
                require 'include/dbconn/auth.php';
                require 'include/UIFacade.php';

                session_start();

                $fecha = null;
                if (
                        array_key_exists('year' , $_POST) and
                        array_key_exists('month', $_POST) and
                        array_key_exists('day'  , $_POST)
                ) {
                        $fecha = sprintf('%s-%s-%s', $_POST['year'], $_POST['month'], $_POST['day']);
                }
                $password = $_POST['password'];
                if ($password != '' and $password == $_POST['password2'] and $_POST['username'] != '') {
                        $u = UIFacade::register(
                                $_POST['username'           ],
                                $_POST['nombre_completo'    ],
                                $_POST['dirección_de_e-mail'],
                                'f',
                                $password
                        );
                        echo '<pre>';
                        if ($u) {
                                $_SESSION['user'] = $u->get('id');
                                $_SESSION['user_class'] = ($u->get('es administrador') == 't') ? 'admin' : 'user';
                                if (array_key_exists('URL_del_avatar', $_POST)) { $u->set('URL del avatar', $_POST['URL_del_avatar']); }
                                if (array_key_exists('género'        , $_POST)) { $u->set('género'        , $_POST['género'        ]); }
                                if ($fecha) { $u->set('fecha de nacimiento', $fecha); }
                                $u->update();
                        } else {
                                session_destroy();
                        }
                        echo '</pre>';
                }
        }
        header('Location: index');
?>
