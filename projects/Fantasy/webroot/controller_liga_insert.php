<?php
        require_once 'include/dbconn/admin.php';
        require_once 'model/Liga.php';

        if (array_key_exists('insertLiga', $_POST)) {
                $liga = new Liga();
                $data = array();
                foreach (Liga::fields() as $f) {
                        $k = str_replace(' ', '_', $f);
                        if (array_key_exists($k, $_POST)) $data[$f] = $_POST[$k];
                }
                $liga->set_all($data);
                $liga->insert();

                header('Location: ligas');
        }
?>
