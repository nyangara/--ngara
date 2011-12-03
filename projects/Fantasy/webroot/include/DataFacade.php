<?php
        class DataFacade {
                protected static function dolar($i) { return '$' . $i; }
                protected static function quote($i) { return '"' . $i . '"'; }
                protected static function conds($i, $j) { return self::quote($i) . ' = ' . self::dolar($j); }
                protected static function sets ($i, $j) { return 'SET ' . self::conds($i, $j); }

                // No se incluyen en el query a los campos que no estén definidos.
                // Si están definidos y valen null, sí se incluyen y se guarda NULL.
                public static function insert($entity) {
                        global $dbconn;
                        global $pqs;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $ef = $ec::fields();
                        $fs = array_reduce(
                                $ef,
                                function ($acc, $f) use (&$entity) {
                                        if ($entity->is_set($f)) $acc[$f] = $entity->get($f);
                                        return $acc;
                                },
                                array()
                        );
                        $fn = array_keys($fs);
                        $fc = count($fs);
                        $fr = range(1, $fc);
                        $pq = 'INSERT ' . $en . '(' . join(', ', $fn) . ')';

                        if (!isset($pqs)) $pqs = array();
                        if (!in_array($pq, $pqs)) {
                                $query =
                                        'INSERT INTO "Fantasy"."' . $en . '" ('  .
                                        join(', ', array_map('self::quote', $fn)) .
                                        ') VALUES ('                             .
                                        join(', ', array_map('self::dolar', $fr)) .
                                        ')';
                                $result = pg_prepare($dbconn, $pq, $query) or die('pg_prepare: ' . pg_last_error());
                                $pqs[] = $pq;
                        }

                        $result = pg_execute($dbconn, $pq, array_values($fs)) or die('pg_execute: ' . pg_last_error());

                        return;
                }

                public static function retrieveAll($ec) {
                        global $dbconn;

                        $en = $ec::table();
                        $ef = $ec::fields();

                        $query =
                                'SELECT ' . join(', ', array_map('self::quote', $ef)) .
                                ' FROM "Fantasy"."' . $en . '"';

                        $result = pg_query($dbconn, $query) or die('pg_prepare: ' . pg_last_error());

                        $n = pg_num_fields($result);
                        $r = array();
                        while ($row = pg_fetch_row($result)) {
                                $e = new $ec;
                                for ($i = 0; $i < $n; ++$i) {
                                        $e->set(pg_field_name($result, $i), $row[$i]);
                                }
                                $r[] = $e;
                        }
                        pg_free_result($result);

                        return $r;
                }

                public static function select($entity) {
                        global $dbconn;
                        global $pqs;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $ef = $ec::fields();
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range(1, $kn);
                        $pq = 'SELECT ' . $en;

                        $data = array_map(
                                function ($i) use (&$entity) { return $entity->get($i); },
                                $pk
                        );

                        if (!isset($pqs)) $pqs = array();
                        if (!in_array($pq, $pqs)) {
                                $query =
                                        'SELECT ' . join(', ', array_map('self::quote', $ef)) .
                                        ' FROM "Fantasy"."' . $en . '" WHERE '                .
                                        join(' AND ', array_map('self::conds', $pk, $kr));

                                $result = pg_prepare($dbconn, $pq, $query) or die('pg_prepare: ' . pg_last_error());
                                $pqs[] = $pq;
                        }

                        $result = pg_execute($dbconn, $pq, $data) or die('pg_execute: ' . pg_last_error());

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
                        global $pqs;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $ef = $ec::fields();
                        $fs = array_reduce(
                                $ef,
                                function ($acc, $f) use (&$entity) {
                                        if ($entity->is_set($f)) $acc[$f] = $entity->get($f);
                                        return $acc;
                                },
                                array()
                        );
                        $fn = array_keys($fs);
                        $fc = count($fs);
                        $fr = range(1, $fc);
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range($fc + 1, $fc + $kn);
                        $pq = 'UPDATE ' . $en . '(' . join(', ', $fn) . ')';

                        $get = function ($i) use (&$entity) { return $entity->get($i); };
                        $data = array_merge(array_values($fs), array_map($get, $pk));

                        if (!isset($pqs)) $pqs = array();
                        if (!in_array($pq, $pqs)) {
                                $query =
                                        'UPDATE "Fantasy"."' . $en . '" SET '                         .
                                        join(', '    , array_map('self::conds', $fs, $fr)) . ' WHERE ' .
                                        join(' AND ', array_map('self::conds', $pk, $kr));
                                $result = pg_prepare($dbconn, $pq, $query) or die('pg_prepare: ' . pg_last_error());
                                $pqs[] = $pq;
                        }

                        $result = pg_execute($dbconn, $pq, $data) or die('pg_execute: ' . pg_last_error());

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
                        global $pqs;

                        $ec = get_class($entity);
                        $en = $ec::table();
                        $pk = $ec::pk();
                        $kn = count($pk);
                        $kr = range(1, $kn);
                        $pq = 'DELETE ' . $en;

                        $data = array_map(
                                function ($i) use (&$entity) { return $entity->get($i); },
                                $pk
                        );

                        if (!isset($pqs)) $pqs = array();
                        if (!in_array($pq, $pqs)) {
                                $query =
                                        'DELETE FROM "Fantasy"."' . $en . '" WHERE ' .
                                        join(' AND ', array_map('self::conds', $pk, $kr));
                                $result = pg_prepare($dbconn, $pq, $query) or die('pg_prepare: ' . pg_last_error());
                                $pqs[] = $pq;
                        }

                        $result = pg_execute($dbconn, $pq, $data) or die('pg_execute: ' . pg_last_error());

                        return true;
                }
        }
?>
