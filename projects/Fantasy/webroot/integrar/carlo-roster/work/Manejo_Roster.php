<?php
        if ($_POST['action'] == 'vender_equipo') {
                // recibir equipo por post.  si el equipo está activo, desactivar y definir su fecha de venta como la actual.  update().
                // $_POST['equipo_activo'] = true;
                // $_POST['fecha_venta_equipo'] = date("d/m/Y H:i:s");
                // $_POST['equipo_activo'] = 0;

                // actualizar créditos
                // $Manager->creditos += $RostersE->precio_compra_equipo;
        }

        if ($_POST['action'] == 'vender_jugador') {
                // recibir jugador por post.  si el jugador está activo, desactivar y definir su fecha de venta como la actual.  update().
                // $_POST['jugador_activo'] = true;
                // $_POST['fecha_venta_jugador'] = date("d/m/Y H:i:s");
                // $_POST['jugador_activo'] = 0;

                // actualizar créditos
                // $Manager->creditos += $RostersJ->precio_compra_jugador;
        }

        if ($_POST['action'] == 'renegociar_equipo') {
                // recibo un equipo.  si lo tengo comprado y el precio cuando lo compré era mayor que el precio actualmente, entonces actualizo la fecha de compra a la actual, el precio de compra al nuevo, y me sumo los créditos de la diferencia.
                // $pn=$Equipo->precio;
                // $pv=$Roster_Equipo->precio_compra_equipo;
                // if ($pv > $pn){
                //         $_POST['fecha_compra_equipo'] = date("d/m/Y H:i:s");
                //         $_POST['precio_compra_equipo']=$pn;
                //         $_POST['creditos']= $Manager->creditos + $pv - $pn;
                // }
        }

        if ($_POST['action'] == 'renegociar_equipo') {
                // recibo un jugador.  si lo tengo comprado y el precio cuando lo compré era mayor que el precio actualmente, entonces actualizo la fecha de compra a la actual, el precio de compra al nuevo, y me sumo los créditos de la diferencia.
                // $pn=$Jugador->precio;
                // $pv=$Roster_Jugador->precio_compra_jugador;
                // if ($pv > $pn) {
                //         $_POST['fecha_compra_jugador'] = date("d/m/Y H:i:s");
                //         $_POST['precio_compra_jugador']=$pn;
                //         $_POST['creditos']= $Manager->creditos + $pv - $pn;
                // }
        }

        if ($_POST['action'] == 'comprar_equipo') {
                // $Manager->creditos -= $Equipo->precio;
                // if ($Manager->creditos >= 0) {
                //         $_POST['fecha_compra_equipo'] = date("d/m/Y H:i:s");
                //         $_POST['precio_compra_equipo'] = $Equipo->precio;
                //         $_POST['equipo_activo'] = true;
                // }
        }

        if ($_POST['action'] == 'comprar_jugador') {
                // $Manager->creditos -= $Jugador->precio;
                // if ($Manager->creditos >= 0) {
                //         $_POST['fecha_compra_jugador'] = date("d/m/Y H:i:s");
                //         $_POST['precio_compra_jugador'] = $Jugador->precio;
                //         $_POST['jugador_activo'] = true;
                //         $_POST['posicion_jugador'] = $POSICION;
                // }
        }
?>
