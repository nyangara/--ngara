<?php


	class Database {
		private static $instance;
		private static $hostname = "localhost";
		private static $username = "root";
		private static $password = "a0639563";
		private static $database = "cluster";

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
			$link = mysql_connect(self::$hostname,self::$username,self::$password);
			mysql_select_db(self::$database);
			
			return $link;
		}
		
		public static function query($query){
			return mysql_query($query);
		}
		
		public static function fetch($result) {
			return mysql_fetch_assoc($result);
		}
		
		public static function num_rows($result) {
			return mysql_num_rows($result);
		}
		
		public static function disconnect($link){
			mysql_close($link);
		}
	}
?>
