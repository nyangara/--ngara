<?php
include_once "config.php";

class Database {
  
  private static $m_pInstance;

  private $dbconn;
  
  private function __construct() {
    //echo "Constructor called<br />\n"; 
  }

  public static function getInstance() {
    if (!self::$m_pInstance) {
      self::$m_pInstance = new Database();
    }

    return self::$m_pInstance;
  }

  public function connect() {
    //echo "Connecting to database...<br />\n";
    
    define("FANTASY_USER_PSQL_PASSWORD", '5e4645vtw54etc');
    
    $this->dbconn = pg_connect(
      "host='localhost' dbname='Fantasy' user='Fantasy (usuario normal)' password='" . preg_replace("/\'/", "\\'", FANTASY_USER_PSQL_PASSWORD) . "'") or die('pg_connect: ' . pg_last_error()
    );
  }
  
  public function disconnect() {
    //echo "Disconnecting from database...<br />\n";
    
    pg_close($this->dbconn);
  }
  
  public function select($columns, $table, $condition) {
    //echo "Running select...<br />\n";
    
    //Connects to the database
    $this->connect();
    
    $query = 'SELECT ';
    
    $n = count($columns, 0);
    $i = 0;
    
    while ($i < $n) {
      $query .= $columns[$i];
      
      if ($i != $n - 1) {
        $query .= ', ';
      }
      
      $i += 1;
    }
    
    $query .= 'FROM ';
    
    $query .= $table;
    
    if ($condition != NULL) {
      $query .= 'WHERE ';
      
      $query .= $condition;
    }
    
    $query .= ';';

    $output = pg_query($this->dbconn, $query) or die('pg_prepare: ' . pg_last_error());
    
    $result = array();
    
    while ($row = pg_fetch_array($output, NULL, PGSQL_NUM)) {
      array_push($result, $row);
    }

    pg_free_result($output);
    
    //Disconnects from the database
    $this->disconnect();
    
    return $result;
  }
  
  public function insert($table, $columns, $values) {
    //echo "Running select...<br />\n";
    
    //Connects to the database
    $this->connect();
    
    $query = 'INSERT INTO ';
    
    $query .= $table;
    
    $query .= ' (';
    
    $n = count($columns, 0);
    $i = 0;
    
    while ($i < $n) {
      $query .= $columns[$i];
      
      if ($i != $n - 1) {
        $query .= ', ';
      }
      
      $i += 1;
    }
    
    $query .= ') ';
    
    $query .= $values;
    
    $query .= ';';

    $output = pg_query($this->dbconn, $query) or die('pg_prepare: ' . pg_last_error());

    $result = $output;

    pg_free_result($output);
    
    //Disconnects from the database
    $this->disconnect();
    
    return $result;
  }
}

?>
