<?php
  
class singleton
{
    public static function &getInstance ($class)
    // Implementa patron de diseno singleton
    {
        static $instances = array();  // arreglo de instancias
        
        if (!array_key_exists($class, $instances)) {
            // si la instancia no existe la crea.
            $instances[$class] = new $class;
        } // if
        
        $instance =& $instances[$class];
        
        return $instance;
        
    } 
    
} 
?>
