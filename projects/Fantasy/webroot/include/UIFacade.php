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

                public static function usuario_ligas_invitables($id) {
                        $uid = userdata()->get('id');
                        return array_filter(
                                UIFacade::ligas(),
                                function ($l) use ($uid, $id) {
                                        return
                                                (has_auth('admin') || $l['creador'] == $uid) &&
                                                !in_array($id,
                                                        array_map(
                                                                function ($p) { return $p->get('id'); },
                                                                $l['participantes']
                                                        )
                                                );
                                }
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

                public static function contenidos($type, $search_query) {
                        return array_reduce(
                                self::retrieveAll('Contenido'),
                                function ($acc, $c) use ($type, $search_query) {
                                        if ($type != $c->get('tipo')) return $acc;

                                        if (!$search_query) $acc[] = $c;
                                        else foreach (array('título', 'texto', 'tags') as $f) {
                                                if (stristr($c->get($f), $search_query)) {
                                                        $acc[] = $c;
                                                        break;
                                                }
                                        }

                                        return $acc;
                                },
                                array()
                        );
                }

                public static function calendario($search_opt, $search_query) {
                        $search_opts = array(
                                'fecha'     => array(
                                        'juego'            => array('inicio')
                                ),

                                'estadio'   => array(
                                        'estadio'          => array('nombre')
                                ),

                                'equipo'    => array(
                                        'equipo local'     => array('nombre completo', 'siglas', 'ciudad', 'estado'),
                                        'equipo visitante' => array('nombre completo', 'siglas', 'ciudad', 'estado')
                                ),

                                'local'     => array(
                                        'equipo local'     => array('nombre completo', 'siglas', 'ciudad', 'estado')
                                ),

                                'visitante' => array(
                                        'equipo visitante' => array('nombre completo', 'siglas', 'ciudad', 'estado')
                                ),

                                'todos'     => array(
                                        'juego'            => array('inicio'),
                                        'estadio'          => array('nombre'),
                                        'equipo local'     => array('nombre completo', 'siglas', 'ciudad', 'estado'),
                                        'equipo visitante' => array('nombre completo', 'siglas', 'ciudad', 'estado')
                                )
                        );

                        return array_reduce(
                                self::retrieveAll('Juego'),
                                function ($acc, $j) use ($search_opts, $search_opt, $search_query) {
                                        $new = array(
                                                'juego'            => $j,
                                                'equipo local'     => UIFacade::select('Equipo' , array('id' => $j->get('equipo local'    ))),
                                                'equipo visitante' => UIFacade::select('Equipo' , array('id' => $j->get('equipo visitante'))),
                                                'estadio'          => UIFacade::select('Estadio', array('id' => $j->get('estadio'         )))
                                        );

                                        if (!array_key_exists($search_opt, $search_opts)) $acc[] = $new;
                                        else {
                                                foreach ($search_opts[$search_opt] as $obj => $fs) {
                                                        foreach ($fs as $f) {
                                                                if (stristr($new[$obj]->get($f), $search_query)) {
                                                                        $acc[] = $new;
                                                                        break 2;
                                                                }
                                                        }
                                                }
                                        }

                                        return $acc;
                                },
                                array()
                        );
                }
        }
?>
