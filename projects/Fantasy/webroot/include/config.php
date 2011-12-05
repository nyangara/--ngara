<?
        error_reporting(E_ALL);
        mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8');
        date_default_timezone_set('America/Caracas');

        function mb_ucfirst($string, $encoding) {
                $strlen = mb_strlen($string, $encoding);
                $firstChar = mb_substr($string, 0, 1, $encoding);
                $then = mb_substr($string, 1, $strlen - 1, $encoding);
                return mb_strtoupper($firstChar, $encoding) . $then;
        }
?>
