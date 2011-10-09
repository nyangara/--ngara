<?php
function map($f, $xs) {
        $r = array();
        foreach ($xs as $x) {
                $r[] = $f($x);
        }
        return $r;
}

function foldl($f, $z, $xs) {
        $r = $z;
        foreach ($xs as $x) {
                $r = $f($r, $x);
        }
        return $r;
}

function foldr($f, $z, $xs) {
        $r = $z;
        foreach ($xs as $x) {
                $r = $f($x, $r);
        }
        return $r;
}

$get = function($s) { return function($xs) use(&$s) { return $xs[$s]; }; };
?>
