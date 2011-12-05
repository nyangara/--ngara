<?php
require_once("Clases/fachadaInterface.php");
date_default_timezone_set('America/Caracas');
$instancia = fachadaInterface::singleton();

//Siempre la Entrada para Especificar el Roster (id)
$ID_Roster  = $_POST['id'];
$ID_Equipo  = isset($_POST['id_Equipo'] ) ? $_POST['id_Equipo'] : -1;
$ID_Jugador = isset($_POST['id_Jugador']) ? $_POST['id_Jugador'] : -1;


unset($_POST);


if($ID_Equipo != -1){//Renegociar Equipo Lanzadores
    
    $_POST['TIPO']='Equipo';
    $_POST['id']=$ID_Equipo;
    $Equipo = $instancia->obtener();
    unset($_POST);    

    $_POST['TIPO']='Roster_Equipo';
    $_POST['roster']=$ID_Roster;
    $Roster_Equipo = $instancia->obtener();
    unset($_POST); 

    $_POST['TIPO']='Roster';
    $_POST['id']=$ID_Roster;
    $Roster = $instancia->obtener();
    unset($_POST);
    
    $_POST['TIPO']='Manager';
    $_POST['id']=$Roster->manager;
    $Manager = $instancia->obtener();
    unset($_POST);
    
	$pn=$Equipo->precio;
	$pv=$Roster_Equipo->precio_compra_equipo;
    if($pv>$pn){
			$_POST['creditos']= $Manager->creditos + $pv - $pn;
	}else{ 
		$_POST['creditos']= $Manager->creditos; 
	}
	$_POST['TIPO']='Manager';
    $_POST['id']=$Manager->id;
    $_POST['puntaje']=$Manager->puntaje;
    $_POST['usuario'] = $Manager->usuario;
	$instancia->actualizar();

/////////////// Fin
}

if($ID_Jugador != -1){//Renegociar Jugador
    //FALTA ACTUALIZAR EL PRECIO_COMPRA_EQUIPO para q sea pn
    $_POST['TIPO']='Jugador';
    $_POST['id']  =$ID_Jugador;
    $Jugador = $instancia->obtener();
    
    $_POST['TIPO']='Roster_Jugador';
    $_POST['roster']=$ID_Roster;
    $Roster_Jugador = $instancia->obtener();
    unset($_POST); 

    $_POST['TIPO']='Roster';
    $_POST['id']=$ID_Roster;
    $Roster = $instancia->obtener();
    unset($_POST);
    
    $_POST['TIPO']='Manager';
    $_POST['id']=$Roster->manager;
    $Manager = $instancia->obtener();
    unset($_POST);
    
	$pn=$Jugador->precio;
	$pv=$Roster_Jugador->precio_compra_equipo;
    if($pv>$pn){
			$_POST['creditos']= $Manager->creditos + $pv - $pn;
	}else{ 
		$_POST['creditos']= $Manager->creditos; 
	}
	$_POST['TIPO']='Manager';
    $_POST['id']=$Manager->id;
    $_POST['puntaje']=$Manager->puntaje;
    $_POST['usuario'] = $Manager->usuario;
	$instancia->actualizar();
	
/////////////// Fin
}
    $_POST['TIPO']='Roster_Jugador';
    $_POST['roster']= 1;
    $Roster_Jugador = $instancia->obtenerTodos();
    unset($_POST); 
?>


<form action="renegociar.php" method="POST">
	<input type="hidden" name="id" value="1">
	<select name="id_Jugador">
<?php		
	foreach($Roster_Jugador as $J_R){
    $Tmp =$J_R->jugador;
    echo '<option value="'. $Tmp .'" />Jugador '.$Tmp.'</option>' ;
	}
?>
	</select>
	<input type="submit" value = "Renegociar"/>
</form>



