<?
include 'config.php';
$id=$_GET['id'];

$count = $baseball->exec("DELETE FROM estadio WHERE id = ".$id."");

if ($count>0) {
?>
        <script>
        alert('La información del estadio fue eliminada exitosamente.');
        location.href='eliminar_jugador.php';
        </script>

<? } else {?>
        <script>
        alert('La información del estadio no pudo ser eliminada.');
        location.href='eliminar_jugador.php';
        </script>

<? } ;

?>
