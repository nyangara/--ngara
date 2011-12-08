<ul id="navigation">
<?php
        
        $everyone = array(
                'Inicio'     => array('index'             ),
                'Jugadores'  => array('gestion_jugadores' ),
                'Equipos'    => array('gestion_equipos'   ),
                'Estadios'   => array('gestion_estadios'  ),
                'Calendario' => array('Calendario'        ),
                'Resultados' => array('Resultados'        )
        );
        
        $manager = array(
                'Roster'     => array('gestion_rosters'   ),
                'Ligas'      => array('Consultar_Ligas_Propias', 'Consultar_Ligas', 'Agregar_Liga', 'Modificar_Liga', 'Datos_Liga'),
                'Mi Perfil'  => array('#')
        );
        
        $admin = array(
                'Usuarios'   => array('gestion_usuarios')
        );
        
        $vs = array();
        
        if (isset($_SESSION['Administrador']))
            $vs = array_merge($everyone, $manager, $admin);
        else if (isset($_SESSION['Manager']))
            $vs = array_merge($everyone, $manager);
        else
            $vs = $everyone;

        foreach ($vs as $v => $f) {
?>
            <li <?php echo in_array(basename($_SERVER['SCRIPT_NAME'], '.php'), $f) ? ' class="on"' : ''; ?>>
              <a href="<?php echo $f[0] . '.php'; ?>"><?php echo $v; ?></a>
            </li>
<?php   } ?>
</ul>
