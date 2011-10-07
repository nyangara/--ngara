<?
include 'config.php';
$id=$_GET['id'];

$count = $baseball->exec("DELETE FROM jugador WHERE id = ".$id."");

if ($count>0) {
?>
        <script>
        alert('La información del jugador fue eliminada exitosamente.');
        location.href='eliminar_jugador.php';
        </script>

        <? } else {?>
        <script>
        alert('La información del jugador no pudo ser eliminada.');
        location.href='eliminar_jugador.php';
        </script>

<? } ;

?>
