<?php
        require 'include/config.php';
        require 'include/UIFacade.php';

        session_start();

        global $user_class; function userclass() { global $user_class; return $user_class; }
        global $user_data ; function userdata () { global $user_data ; return $user_data ; }

        $user_class = array_key_exists('user_class', $_SESSION) ? $_SESSION['user_class'] : 'guest'; // FIXME: esto es super inseguro
        if (!in_array(userclass(), array('user', 'admin', 'guest'))) {
                die('Invalid session.');
        }

        require 'include/dbconn/' . userclass() . '.php';

        $user_data = null;
        if (userclass() != 'guest') {
                $user_data = UIFacade::select('Usuario', array('id' => $_SESSION['user'])); // FIXME: esto es super inseguro
        }
?>
