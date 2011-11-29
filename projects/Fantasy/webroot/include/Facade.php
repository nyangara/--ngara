<?php
        class Facade {
                protected static function dolar($i) { return '$' . $i; }
                protected static function quote($i) { return '"' . $i . '"'; }
                protected static function conds($i, $j) { return self::quote($i) . ' = ' . self::dolar($j); }
                protected static function sets ($i, $j) { return 'SET ' . self::conds($i, $j); }

                public static function insert($entity) {
                        global $dbconn;
                        global $prepared;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $fs = $ec::fields();
                        $fn = count($fs);
                        $fr = range(1, $fn);

                        $data = array_map(
                                function ($i) use (&$entity) { return $entity->get($i); },
                                $fs
                        );

                        if (!isset($prepared)) $prepared = array();
                        if (!in_array('INSERT ' . $en, $prepared)) {
                                $query =
                                        'INSERT INTO "Fantasy"."' . $en . '" ('  .
                                        join(',', array_map('self::quote', $fs)) .
                                        ') VALUES ('                             .
                                        join(',', array_map('self::dolar', $fr)) .
                                        ')';
                                $result = pg_prepare($dbconn, 'INSERT ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                                $prepared[] = 'INSERT ' . $en;
                        }

                        $result = pg_execute($dbconn, 'INSERT ' . $en, $data) or die('pg_execute: ' . pg_last_error());

                        return;
                }

                public static function retrieveAll($ec) {
                        global $dbconn;

                        $en = $ec::table();
                        $fs = $ec::fields();

                        $query =
                                'SELECT ' . join(',', array_map('self::quote', $fs)) .
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

                        return $r;
                }

                public static function select($entity) {
                        global $dbconn;
                        global $prepared;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $fs = $ec::fields();
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range(1, $kn);

                        $data = array_map(
                                function ($i) use (&$entity) { return $entity->get($i); },
                                $pk
                        );

                        if (!isset($prepared)) $prepared = array();
                        if (!in_array('SELECT ' . $en, $prepared)) {
                                $query =
                                        'SELECT ' . join(',', array_map('self::quote', $fs)) .
                                        'FROM "Fantasy"."' . $en . '" WHERE '                .
                                        join(' AND ', array_map('self::conds', $pk, $kr));

                                $result = pg_prepare($dbconn, 'SELECT ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                                $prepared[] = 'SELECT ' . $en;
                        }

                        $result = pg_execute($dbconn, 'SELECT ' . $en, $data) or die('pg_execute: ' . pg_last_error());

                        if (pg_num_rows($result) === 0) return null;
                        $row = pg_fetch_row($result) or die('pg_fetch_row: ' . pg_last_error());

                        $e = new $ec;
                        $n = pg_num_fields($result);
                        for ($i = 1; $i < $n; ++$i) {
                                $e->set(pg_field_name($result, $i), $row[$i]);
                        }
                        pg_free_result($result);

                        return $e;
                }

                public static function update($entity) {
                        global $dbconn;
                        global $prepared;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $fs = $ec::fields();
                        $fn = count($fs);
                        $fr = range(1, $fn);
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range($fn + 1, $fn + $kn);

                        $get = function ($i) use (&$entity) { return $entity->get($i); };
                        $data = array_merge(array_map($get, $fs), array_map($get, $pk));

                        if (!isset($prepared)) $prepared = array();
                        if (!in_array('UPDATE ' . $en, $prepared)) {
                                $query =
                                        'UPDATE "Fantasy"."' . $en . '" SET '                        .
                                        join(','    , array_map('self::conds', $fs, $fr)) . 'WHERE ' .
                                        join(' AND ', array_map('self::conds', $pk, $kr));
                                $result = pg_prepare($dbconn, 'UPDATE ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                                $prepared[] = 'UPDATE ' . $en;
                        }

                        $result = pg_execute($dbconn, 'UPDATE ' . $en, $data) or die('pg_execute: ' . pg_last_error());

                        return true;
                }

                public static function removeAll($ec) {
                        global $dbconn;

                        $en = $ec::table();

                        $query = 'DELETE FROM "Fantasy"."' . $en . '"';

                        $result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

                        return true;
                }

                public static function remove($entity) {
                        global $dbconn;
                        global $prepared;

                        $en = $ec::table();
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range(1, $kn);

                        $data = array_map(
                                function ($i) use (&$entity) { return $entity->get($i); },
                                $pk
                        );

                        if (!isset($prepared)) $prepared = array();
                        if (!in_array('DELETE ' . $en, $prepared)) {
                                $query =
                                        'DELETE FROM "Fantasy"."' . $en . '" WHERE ' .
                                        join(' AND ', array_map('self::conds', $pk, $kr));
                                $result = pg_prepare($dbconn, 'DELETE ' . $en, $query) or die('pg_prepare: ' . pg_last_error());
                                $prepared[] = 'DELETE ' . $en;
                        }

                        $result = pg_execute($dbconn, 'DELETE ' . $en, $data) or die('pg_execute: ' . pg_last_error());

                        return true;
                }
        }
?>
