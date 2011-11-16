<?php
        class Database {
                private static $instance;
                private static $hostname = "localhost";
                private static $username = "postgres";
                private static $password = "18942761";
                private static $database = "Fantasy";

                public static function getHostname() { return self::$hostname; }
                public static function getUsername() { return self::$username; }
                public static function getPassword() { return self::$password; }
                public static function getDatabase() { return self::$database; }

                public static function setHostname($hostname) { self::$hostname = $hostname; }
                public static function setUsername($username) { self::$username = $username; }
                public static function setPassword($password) { self::$password = $password; }
                public static function setDatabase($database) { self::$database = $database; }

                public static function getInstance() {
                        if (!isset(self::$instance)) {
                                self::$instance = new Database;
                        }
                        return self::$instance;
                }

                private function __construct() {}

                public static function connect() {
                        return pg_connect(
                                'host='      . self::$hostname .
                                ' dbname='   . self::$database .
                                ' user='     . self::$username .
                                ' password=' . self::$password
                        );
                }

                public static function disconnect($link) {
                        pg_close($link);
                }

                public static function query($query) {
                        return pg_query($query);
                }

                public static function num_rows($result) {
                        return pg_num_rows($result);
                }

                public static function fetch($result) {
                        return pg_fetch_assoc($result);
                }
        }
?>
