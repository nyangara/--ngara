<?php
        require_once 'include/session.php';

        $actions = array(
                'liga_insert' => array(
                        'authorization' => 'user',
                        'action' => function () {
                                $data = array('creador' => userdata()->get('id'));
                                if (!has_auth('admin')) $data['es pública'] = 'f';
                                insert_fields('Liga', $data);
                        }
                ),

                'liga_update' => array(
                        'authorization' => 'user',
                        'action' => function () {
                                $l = UIFacade::select('Liga', array('id' => $_POST['id']));
                                $data = array(
                                        'id'      => $l->get('id'),
                                        'creador' => $l->get('creador')
                                );
                                if (!has_auth('admin')) $data['es pública'] = $l->get('es pública');
                                update_fields('Liga', $data);
                        }
                ),

                'contenido_insert' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                insert_fields('Contenido', array(
                                        'fecha' => date('Y-m-d H:i:sP')
                                ));
                        }
                ),

                'equipo_insert' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                $nombre = '';
                                if ($_FILES['imagen']['error'] == 0) {
                                    $nombre = $_FILES['imagen']['name'];

                                    $d = move_uploaded_file($_FILES['imagen']['tmp_name'], 'static/images/equipo/' . $nombre);
                                } else $nombre = 'generico.jpg';

                                insert_fields('Equipo', array('URL del logo' => $nombre));
                        }
                ),

                'equipo_update' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                $nombre = '';
                                if ($_FILES['imagen']['error'] == 0) {
                                    $nombre = $_FILES['imagen']['name'];

                                    $d = move_uploaded_file($_FILES['imagen']['tmp_name'], 'static/images/equipo/' . $nombre);
                                } else $nombre = 'generico.jpg';

                                update_fields('Equipo', array('URL del logo' => $nombre));
                        }
                ),

                'juego_insert' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                insert_fields('Juego', array(
                                        'inicio' => sprintf(
                                                '%s-%s-%s %s:%s %s',
                                                $_POST['year'  ],
                                                $_POST['month' ],
                                                $_POST['day'   ],
                                                $_POST['hour'  ],
                                                $_POST['minute'],
                                                $_POST['ampm'  ]
                                        )
                                ));
                        }
                ),

                'juego_update' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                update_fields('Juego');
                        }
                ),

                'contenido_update' => array(
                        'authorization' => 'admin',
                        'action' => function () {
                                update_fields('Contenido');
                        }
                ),

                'contenido_remove' => array('authorization' => 'admin', 'action' => function () { remove_by_pk('Contenido'); }),
                'juego_remove'     => array('authorization' => 'admin', 'action' => function () { remove_by_pk('Juego'    ); }),
                'equipo_remove'    => array('authorization' => 'admin', 'action' => function () { remove_by_pk('Equipo'   ); }),

                'participa_insert' => array(
                        'authorization' => 'user',
                        'action' => function () {
                                if (
                                        array_key_exists('liga'   , $_POST) &&
                                        array_key_exists('usuario', $_POST)
                                ) {
                                        if (!has_auth('admin')) {
                                                $liga = UIFacade::select('Liga', array('id' => $_POST['liga']));
                                                if (!$liga) return;
                                                if ($liga->get('creador') != userdata()->get('id')) return;
                                        }
                                        insert_fields('Participa');
                                }
                        }
                ),

                'participa_remove' => array(
                        'authorization' => 'user',
                        'action' => function () {
                                if (
                                        array_key_exists('liga'   , $_POST) &&
                                        array_key_exists('usuario', $_POST)
                                ) {
                                        if (!has_auth('admin')) {
                                                $liga = UIFacade::select('Liga', array('id' => $_POST['liga']));
                                                if (!$liga) return;
                                                if ($liga->get('creador') != userdata()->get('id')) return;
                                        }
                                        remove_by_pk('Participa');
                                }
                        }
                ),

                'liga_remove' => array(
                        'authorization' => 'user',
                        'action' => function () {
                                if (userclass() == 'admin') remove_by_pk('Liga');
                                else {
                                        $l = UIFacade::select('Liga', set_pk('Liga'));
                                        if ($l->get('creador') == userdata()->get('id')) $l->remove();
                                }
                        }
                )
        );

        function update_fields($entity_class, $data = array()) {
                UIFacade::update($entity_class, set_fields($entity_class, $data));
        }

        function insert_fields($entity_class, $data = array()) {
                UIFacade::insert($entity_class, set_fields($entity_class, $data));
        }

        function remove_by_pk($entity_class) {
                UIFacade::remove($entity_class, set_pk($entity_class));
        }

        function set_data($entity_class, $data = array(), $kind_of_data = 'fields') {
                if (in_array($kind_of_data, array('fields', 'pk'))) {
                        foreach (UIFacade::$kind_of_data($entity_class) as $f) {
                                $k = str_replace(' ', '_', $f);
                                if (array_key_exists($k, $_POST) and !array_key_exists($f, $data)) $data[$f] = $_POST[$k];
                        }
                }
                return $data;
        }
        function set_fields($entity_class, $data = array()) { return set_data($entity_class, $data, 'fields'); }
        function set_pk    ($entity_class, $data = array()) { return set_data($entity_class, $data, 'pk'    ); }

        if (array_key_exists('action', $_POST)) {
                $an = $_POST['action'];
                if (array_key_exists($an, $actions)) {
                        $a = $actions[$an];
                        $auth = $a['authorization'];
                        if (has_auth($auth)) call_user_func($a['action']);
                        else error_log('Fantasy: intento de llamar función del controlador ' . $an . ' por usuario no autorizado de clase ' . userclass());
                } else error_log('Fantasy: intento de llamar la función inexistente del controlador "' . $an . '" por usuario de clase ' . userclass());
        }

        if (array_key_exists('goto', $_POST)) {
                header('Location: ' . $_POST['goto']);
        } else {
                header('Location: index');
        }
?>
