<?php

class fachadaBD {
    private static $instancia;
    private static $hostname = "localhost";
    private static $username = "cluster";
    private static $password = "failwhale";
    private static $database = "FantasyRoster";    
    
    private function __construct(){}
    
    public static function singleton(){
        if (!isset(self::$instancia))
            self::$instancia = new fachadaBD();
        return self::$instancia;
    }   
    
    public function insertar($obj){
        
        $link = pg_connect('host='.self::$hostname.' dbname='.self::$database.' user='.self::$username.' password='.self::$password);
        
        $query = "INSERT INTO \"Fantasy\".\"".get_class($obj)."\" ( ";
        
        $vars_clase = $obj->get();
        
        $i=0;
        foreach ($vars_clase as $nombre => $valor)
            if($nombre != 'id' && $valor >= 0){
                if($i==0)
                    $query .= "\"".$nombre."\"" ;
                else        
                    $query .= ", "."\"".$nombre."\"" ;
                $i++;
            }
        
        $query .= ") VALUES (";
        $i=0;
        foreach ($vars_clase as $nombre => $valor)
            if($nombre != 'id' && $valor >= 0 ){
                if($i==0)
                    $query .= "'".$valor."'" ;
                else        
                    $query .= ", '".$valor."'" ;
                $i++;
            }
        
        $query .= ")";
        
        pg_query($query);
        pg_close($link);        
    }
    
    public function actualizar($obj){
        $link = pg_connect('host='.self::$hostname.' dbname='.self::$database.' user='.self::$username.' password='.self::$password);
        
        $query = "UPDATE \"Fantasy\".\"".get_class($obj)."\" SET ";
        $vars_clase = $obj->get();
        $i=0;
        foreach ($vars_clase as $nombre => $valor){
            if($nombre != 'id' && $valor >= 0){
                    if($i==0)
                        $query .= "\"".$nombre."\""." = '".$valor."'";
                    else        
                        $query .= ", "."\"".$nombre."\""." = '".$valor."'";
                    $i++;
                }
        }
        
        $query .= " WHERE id = '".$vars_clase['id']."'";
        
        pg_query($query);
        pg_close($link);
    }
    
    public function eliminar($obj){
        $link = pg_connect('host='.self::$hostname.' dbname='.self::$database.' user='.self::$username.' password='.self::$password);
        
        $query = "DELETE FROM \"Fantasy\".\"".get_class($obj)."\" WHERE ";
        
        $i=0;
        $Conexiones = $obj->get();
        foreach ($Conexiones as $nombre => $valor)
            if($valor >= 0){
                if($i==0)
                    $query .= "\"".$nombre."\""." = '".$valor."'";
                else        
                    $query .= "AND "."\"".$nombre."\""." = '".$valor."'";
                $i++;
            }
            
        pg_query($query);
        pg_close($link);        
    }
    
    public function obtener($obj){
                
        $link = pg_connect('host='.self::$hostname.' dbname='.self::$database.' user='.self::$username.' password='.self::$password);
        $i=0;
        $Conexiones = $obj->get();
        
        $query = "SELECT ";
        
        foreach ($Conexiones as $nombre => $valor)
            if($valor < 0){
                if($i==0)
                    $query .= "\"".$nombre."\"";
                else        
                    $query .= " , "."\"".$nombre."\"";
                $i++;
            }
        
        $query .= " FROM \"Fantasy\".\"".get_class($obj)."\" WHERE ";
        $i=0;
        foreach ($Conexiones as $nombre => $valor)
            if($valor >= 0){
                if($i==0)
                    $query .= "\"".$nombre."\""." = '".$valor."'";
                else        
                    $query .= "AND "."\"".$nombre."\""." = '".$valor."'";
                $i++;
            }
        
         $result = pg_query($query);
         
         $row = pg_fetch_assoc($result);
         $obj->reload($row);
        
         pg_close($link);
    }
    
    public function obtenerTodos($obj){
        $link = pg_connect('host='.self::$hostname.' dbname='.self::$database.' user='.self::$username.' password='.self::$password);
                
        $Conexiones = $obj->get();
        $i=0;
        
        $query = "SELECT ";
        
        foreach ($Conexiones as $nombre => $valor)
            if($valor < 0){
                if($i==0)
                    $query .= "\"".$nombre."\"";
                else        
                    $query .= " , "."\"".$nombre."\"";
                $i++;
            }
        
        $query .= " FROM \"Fantasy\".\"".get_class($obj)."\"";
        $i=0;
        foreach ($Conexiones as $nombre => $valor)
            if($valor >= 0){
                if($i==0)
                    $query .= " WHERE "."\"".$nombre."\""." = '".$valor."'";
                else        
                    $query .= "AND "."\"".$nombre."\""." = '".$valor."'";
                $i++;
            }
        
         $result = pg_query($query);
         
         $Res = new ArrayObject();
         
         while ($row = pg_fetch_assoc($result)){
            $Tmp = clone $obj;
            $Tmp->reload($row);
            $Res->append($Tmp); //Este Reload Queda Extraño aqui
         }
         
         pg_close($link);
         
         return $Res->getArrayCopy();
    }
	
}

?>
