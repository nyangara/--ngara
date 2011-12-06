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

                public static function enum_values($type_name) {
                        return Entity::enum_values($type_name);
                }

                public static function auth($username, $password) {
                        return Usuario::auth($username, $password);
                }

                public static function register($username, $name, $email, $admin, $password) {
                        return Usuario::register($username, $name, $email, $admin, $password);
                }

                protected static function run($action, $entity_class, $data) {
                        $o = new $entity_class();
                        $o->set_all($data);
                        return call_user_func(array($o, $action));
                }

                public static function liga_detail($id) {
                        $ps = array();
                        foreach (self::retrieveAll('Participa') as $p) if ($p->get('liga') == $id) {
                                $ps[] = self::select('Usuario', array('id' => $p->get('usuario')));
                        }

                        $l = self::select('Liga'   , array('id' => $id          ));
                        $u = self::select('Usuario', array('id' => $l->get('id')));

                        return array(
                                'liga'          => $l,
                                'creador'       => $u,
                                'participantes' => $ps
                        );
                }

                public static function ligas() {
                        $ps = array();
                        $uids = array();
                        foreach (self::retrieveAll('Participa') as $p) {
                                $ps[$p->get('liga')][] = $p->get('usuario');
                                $uids[] = $p->get('usuario');
                        }

                        $us = array();
                        foreach ($uids as $uid) {
                                $us[$uid] = self::select('Usuario', array('id' => $uid));
                        }

                        return array_map(
                                function ($l) use ($ps, $us) {
                                        $u = new Usuario(); $u->set('id', $l->get('creador')); $u = $u->select();
                                        $lid = $l->get('id');
                                        return array(
                                                'liga'          => $l,
                                                'creador'       => $u,
                                                'participantes' => array_map(
                                                        function ($uid) use ($us) { return $us[$uid]; },
                                                        array_key_exists($lid, $ps) ? $ps[$lid] : array()
                                                )
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
