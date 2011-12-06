<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    session_start();
    
    if(isset($_POST['Login']))
        $instancia->login();
    else
        session_destroy();
    
    header('Location: index.php');
   
?>
