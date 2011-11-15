<?php
	class Database {
		private static $instance;
		private static $hostname = "localhost";
		private static $username = "postgres";
		private static $password = "chester";
		private static $database = "postgres";

		private function __construct(){}

		public static function getHostname(){
			return self::$hostname;
		}

		public static function getUsername(){
			return self::$username;
		}

		public static function getPassword(){
			return self::$password;
		}

		public static function getDatabase(){
			return self::$database;
		}

		public static function setHostname($hostname){
			self::$hostname = $hostname;
		}

		public static function setUsername($username){
			self::$username = $username;
		}

		public static function setPassword($password){
			self::$password = $password;
		}

		public static function setDatabase($database){
			self::$database = $database;
		}

		public static function getInstance(){
			if (!isset(self::$instance)) {
				self::$instance = new Database;
			}
			return self::$instance;		
		}

		public static function connect(){
			$link = pg_connect('host='.self::$hostname.' dbname='.self::$database.
                               ' user='.self::$postgres.' password='.self::$password)
			or die('Could not connect to PostgreSQL');
}			return $link;
		}

		public static function disconnect($link){
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
