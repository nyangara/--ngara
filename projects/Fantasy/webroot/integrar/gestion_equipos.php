<?
                echo '<form id="form" action="Agregar_Eq.php" method="post">
                        <input type="submit" value="Agregar Equipo">
                      </form>';

                echo '<h2>Equipos</h2>';


                $FachadaEquipo = new EquipoFachada;
                $Equipos = $FachadaEquipo->getEquipos();

                $N = count($Equipos);

                for($i=0;$i<$N;$i++){
                        echo'
                                <div class="alcanceEquipo">
                                        <form class="Fila" action="Datos_Eq.php" method="post" >
                                                <input type="hidden" name="idequipo" value="'.$Equipos[$i]->getId().'">
                                                <input class="imagen" type="image" src="assets/images/Fotos_Equipos/generico.jpg" />
                                                <div class="datos">
                                                        <div>Nombre: '.$Equipos[$i]->getnombre().'</div>
                                                        <div>Siglas: '.$Equipos[$i]->getsiglas().'</div>
                                                        <div>Fecha de Fundacion: '.$Equipos[$i]->getfecha_fundacion().'</div>
                                                </div>
                                        </form>
                                </div>';
                }

echo '</div>';
include("Static/sideBar.php");
include("Static/footer.php");

?>
