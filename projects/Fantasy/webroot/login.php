<?php
        if (
                array_key_exists('action'  , $_POST) and
                array_key_exists('username', $_POST) and
                array_key_exists('password', $_POST) and
                $_POST['action'] == 'login'
        ) {
                require 'include/config.php';
                require 'include/dbconn/auth.php';
                require 'include/UIFacade.php';

                session_start();

                $u = UIFacade::auth($_POST['username'], $_POST['password']);
                if ($u) {
                        $_SESSION['user'] = $u->get('id');
                        $_SESSION['user_class'] = ($u->get('es administrador') == 't') ? 'admin' : 'user';
                } else {
                        session_destroy();
                }
        }
        header('Location: index');
?>
