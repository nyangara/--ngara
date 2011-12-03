<?php


class Clases {
    
    public function insertar(){
        $instancia = fachadaBD::singleton();
        $instancia->insertar($this);
    }

    public function actualizar(){

        $instancia = fachadaBD::singleton();
        $instancia->actualizar($this);
    }

    public function eliminar(){

        $instancia = fachadaBD::singleton();
        $instancia->eliminar($this);
    }
    
    //Esta Obtiene un Elemento
    public function obtener(){
        $instancia = fachadaBD::singleton();
        $instancia->obtener($this);
    }
    
    //Esta Obtiene un Arreglo de Elementos
    public function obtenerTodos(){
        $instancia = fachadaBD::singleton();
        return $instancia->obtenerTodos($this);
        
    }    
    
    
}


?>
