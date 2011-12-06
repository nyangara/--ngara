<?php
        require_once 'include/Entity.php';

        class Usuario extends Entity {
                protected static $table = 'Usuario';
                protected static $fields = array(
                        'id',
                        'username',
                        'nombre completo',
                        'género',
                        'fecha de nacimiento',
                        'es administrador',
                        'dirección de e-mail',
                        'URL del avatar'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;

                public static function auth($username, $password) {
                        $id = DataFacade::auth($username, $password);
                        if ($id) {
                                $u = new self();
                                return $u->set('id', $id)->select();
                        }
                        return null;
                }

                public static function register($username, $name, $email, $admin, $password) {
                        $id = DataFacade::register($username, $name, $email, $admin, $password);
                        if ($id) {
                                $u = new self();
                                return $u->set('id', $id)->select();
                        }
                        return null;
                }
        }
?>
