<?php
        require_once 'DataFacade.php';
        require_once 'Entity.php';
        foreach (glob('model/*.php') as $f) require_once $f;

        class UIFacade {
                public static function insert($entity_class, $data) { return self::run('insert', $entity_class, $data); }
                public static function select($entity_class, $data) { return self::run('select', $entity_class, $data); }
                public static function update($entity_class, $data) { return self::run('update', $entity_class, $data); }
                public static function remove($entity_class, $data) { return self::run('remove', $entity_class, $data); }

                public static function fields     ($entity_class) { return $entity_class::fields     (); }
                public static function pk         ($entity_class) { return $entity_class::pk         (); }
                public static function retrieveAll($entity_class) { return $entity_class::retrieveAll(); }
                public static function removeAll  ($entity_class) { return $entity_class::removeAll  (); }

                public static function enum_values($type_name          ) { return Entity ::enum_values($type_name          ); }
                public static function auth       ($username, $password) { return Usuario::auth       ($username, $password); }

                protected static function run($action, $entity_class, $data) {
                        $o = new $entity_class();
                        $o->set_all($data);
                        return call_user_func(array($o, $action));
                }

                public static function ligas() {
                        return array_map(
                                function ($l) {
                                        $u = new Usuario(); $u->set('id', $l->get('creador')); $u = $u->select();
                                        return array(
                                                'liga'    => $l,
                                                'usuario' => $u
                                        );
                                },
                                self::retrieveAll('Liga')
                        );
                }

                public static function jugadores() {
                        return array_map(
                                function ($j) {
                                        $e = new Equipo(); $e->set('id', $j->get('equipo')); $e = $e->select();
                                        return array(
                                                'jugador' => $j,
                                                'equipo'  => $e
                                        );
                                },
                                self::retrieveAll('Jugador')
                        );
                }

                public static function calendario() {
                        return array_map(
                                function ($j) {
                                        $l = new Equipo (); $l->set('id', $j->get('equipo local'    )); $l = $l->select();
                                        $v = new Equipo (); $v->set('id', $j->get('equipo visitante')); $v = $v->select();
                                        $s = new Estadio(); $s->set('id', $j->get('estadio'         )); $s = $s->select();
                                        return array(
                                                'juego'            => $j,
                                                'equipo local'     => $l,
                                                'equipo visitante' => $v,
                                                'estadio'          => $s
                                        );
                                },
                                self::retrieveAll('Juego')
                        );
                }
        }
?>
