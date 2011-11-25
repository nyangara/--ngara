<?php
        class Facade {
                public static function create($entity) {
                        global $dbconn;

                        $ec = static::$entity_class;
                        $en = $ec::table();
                        $fs = $ec::fields();
                        $fn = count($fs);
                        $fr = range(1, $fn);

                        $dolar = function ($i) { return '$' . $i;         };
                        $quote = function ($i) { return '"' . $i . '"';   };
                        $get   = function ($i) { return $entity->get($i); };

                        $query =
                                'INSERT INTO "Fantasy"."' . $en . '" (' .
                                join(',', array_map($quote, $fs))       .
                                ') VALUES ('                            .
                                join(',', array_map($dolar, $fr))       .
                                ')';

                        $data = array_map($get, $fs);

                        $result = pg_prepare($dbconn, 'INSERT ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, 'INSERT ' . $en, $data ) or die('pg_execute: ' . pg_last_error());

                        pg_close($dbconn);
                }

                public static function retrieveAll() {
                        global $dbconn;

                        $ec = static::$entity_class;
                        $en = $ec::table();
                        $fs = $ec::fields();

                        $quote = function ($i) { return '"' . $i . '"'; };

                        $query =
                                'SELECT ' . join(',', array_map($quote, $fs)) .
                                'FROM "Fantasy"."' . $en . '"';

                        $result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

                        $n = pg_num_fields($result);
                        $r = array();
                        while ($row = pg_fetch_row($result)) {
                                $e = new $ec;
                                for ($i = 1; $i < $n; ++$i) {
                                        $e->set(pg_field_name($result, $i), $row[$i]);
                                }
                                $r[] = $e;
                        }
                        pg_free_result($result);

                        pg_close($dbconn);
                        return $r;
                }

                public static function retrieve($entity) {
                        global $dbconn;

                        $ec = static::$entity_class;
                        $en = $ec::table();
                        $fs = $ec::fields();

                        $quote = function ($i) { return '"' . $i . '"'; };

                        $query =
                                'SELECT ' . join(',', array_map($quote, $fs)) .
                                'FROM "Fantasy"."' . $en . '" WHERE "id" = $1';

                        $data = array($entity->get('id'));

                        $result = pg_prepare($dbconn, 'SELECT ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, 'SELECT ' . $en, $data ) or die('pg_execute: ' . pg_last_error());

                        if (pg_num_rows($result) === 0) return null;
                        $row = pg_fetch_row($result) or die('pg_fetch_row: ' . pg_last_error());

                        $e = new $ec;
                        $n = pg_num_fields($result);
                        for ($i = 1; $i < $n; ++$i) {
                                $e->set(pg_field_name($result, $i), $row[$i]);
                        }
                        pg_free_result($result);

                        pg_close($dbconn);
                        return $e;
                }

                public static function update($entity) {
                        global $dbconn;

                        $ec = static::$entity_class;
                        $en = $ec::table();
                        $fs = $ec::fields();
                        $fn = count($fs);
                        $fr = range(1, $fn);

                        $get   = function ($i)     { return $entity->get($i);            };
                        $sets  = function ($i, $j) { return 'SET "' . $i . '" = $' . $j; };

                        $query =
                                'UPDATE "Fantasy"."' . $en . '" SET ' .
                                join(',', array_map($sets, $fs, $fr)) .
                                'WHERE "id" = $' . ($fn + 1);

                        $data = array_merge(array_map($get, $fs), array($entity->get("id")));

                        $result = pg_prepare($dbconn, 'UPDATE ' . $en, $query)     or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, 'UPDATE ' . $en, $data ) or die('pg_execute: ' . pg_last_error());

                        pg_close($dbconn);
                        return true;
                }

                public static function removeAll() {
                        global $dbconn;

                        $en = $ec::table();

                        $query = 'DELETE FROM "Fantasy"."' . $en . '"';

                        $result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

                        pg_close($dbconn);
                        return true;
                }

                public static function remove($entity) {
                        global $dbconn;

                        $en = $ec::table();

                        $query = 'DELETE FROM "Fantasy"."' . $en . '" WHERE "id" = $1';
                        $data  = array($entity->get("id"));

                        $result = pg_prepare($dbconn, 'SELECT ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, 'SELECT ' . $en, $data ) or die('pg_execute: ' . pg_last_error());

                        pg_close($dbconn);
                        return true;
                }
        }
?>
