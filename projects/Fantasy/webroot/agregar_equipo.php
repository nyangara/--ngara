<?php
        require_once("Classes/EstadioFachade.php");

        include("static/head.php");
        include("static/header.php");

        $equipo = array('Siglas', 'Nombre_Estadio', 'Nombre', 'AVG', 'JJ', 'VB', 'CA', 'BA', 'H', 'H2', 'H3', 'HR', 'CI', 'BB', 'SO', 'SH', 'SF', 'BR', 'ORB', 'SLG', 'HB', 'OBG', 'EFE', 'JJ_Picheo', 'JI', 'JG', 'JP', 'JS', 'JC', 'IP', 'H_Picheo', 'H2_Picheo', 'H3_Picheo', 'HR_Picheo', 'BB_Picheo', 'SO_Picheo', 'Carreras_Limpias', 'WP', 'BK');
?>
<div id="content">
        <div id="contenido">
                <form action="agregar_equipo_2.php" method="post" id="add_form">
                        <table border="1">
                                <tr>
                                        <?php for($i = 0; $i < 3; $i++) echo "<td>" . $equipo[$i] . "</td>"; ?>
                                </tr>

                                <tr>
                                        <td>
                                                <input type="text" size="10" name="<?php echo $equipo[0]; ?>"/>
                                        </td>
                                        <td>
                                                <select name="Nombre_Estadio">
                                                        <option size="30" value="000" selected>Seleccionar</option>
                                                        <?php
                                                                $eFac = new EstadioFachade();
                                                                $estadio = $eFac->getAllEstadio();
                                                                $n = count($estadio);

                                                                if ($n == 0) echo "<option>No existen campos</option>";
                                                                else for($i = 0; $i < $n; $i++) {
                                                                        echo "<option>" . $estadio[$i]->getNombre_estadio() . "</option>";
                                                                }
                                                        ?>
                                                </select>
                                        </td>
                                        <td>
                                                <input type="text" size="10" name="<?php echo $equipo[2]; ?>"/>
                                        </td>
                                </tr>

                                <tr><?php for($i =  4; $i < 12; $i++) echo '<td>'                                              . $equipo[$i] .    '</td>'; ?></tr>
                                <tr><?php for($i =  4; $i < 12; $i++) echo '<td><input type="text" size="10" value="0" name="' . $equipo[$i] . '"/></td>'; ?></tr>
                                <tr><?php for($i = 12; $i < 21; $i++) if($i != 19) echo "<td>".$equipo[$i]."</td>";                                        ?></tr>

<?php
// Me dio ladilla seguir arreglando el código.  Por favor trabajen con un poco de orden para que su código sea legible y editable.
echo "<tr>";
for($i=12;$i<21;$i++) {
        if($i != 19) {
                echo "<td><input type=\"text\" size=\"10\" value=0 name=\"".$equipo[$i]."\"/></td>";
        }
}
echo "</tr>";

echo "<tr>";
for($i=23;$i<31;$i++) {
        echo "<td>".$equipo[$i]."</td>";
}
echo "</tr>";

echo "<tr>";
for($i=23;$i<31;$i++) {
        echo "<td><input type=\"text\" size=\"10\" value=0 name=\"".$equipo[$i]."\"/></td>";
}
echo "</tr>";

echo "<tr>";
for($i=31;$i<39;$i++) {
        echo "<td>".$equipo[$i]."</td>";
}
echo "</tr>";
?>
                                <tr>
                                        <?php for($i = 31; $i < 39; $i++) echo '<td><input type="text" size="10" value="0" name="' . $equipo[$i] . '"/></td>'; ?>
                                </tr>
                        </table>
                        <div id="add_form_errorloc" class="error_strings"/>
                        <input type="submit" value="Enviar"/>
                </form>

                <script type="text/javascript">
                        var frmvalidator = new Validator("add_form");
                        var equi = new Array("JJ", "VB", "CA", "BA", "H", "H2", "H3", "HR", "CI", "BB", "SO", "SH", "SF", "BR", "ORB", "HB", "JJ_Picheo", "JI", "JG", "JP", "JS", "JC", "IP", "H_Picheo", "H2_Picheo", "H3_Picheo", "HR_Picheo", "BB_Picheo", "SO_Picheo", "Carreras_Limpias", "WP", "BK");

                        frmvalidator.addValidation("Siglas"        , "req"           , "Siglas: campo requerio"                 );
                        frmvalidator.addValidation("Siglas"        , "maxlen=3"      , "Siglas: maximo de caracteres 3"         );
                        frmvalidator.addValidation("Siglas"        , "alpha"         , "Siglas: solo caracteres alfabeticos"    );
                        frmvalidator.addValidation("Nombre_Estadio", "dontselect=000", "Nombre_Estadio: campo requerio"         );
                        frmvalidator.addValidation("Nombre_Estadio", "maxlen=30"     , "Nombre_Estadio: maximo de caracteres 25");
                        frmvalidator.addValidation("Nombre"        , "req"           , "Nombre: campo requerio"                 );
                        frmvalidator.addValidation("Nombre"        , "maxlen=30"     , "Nombre: maximo de caracteres 25"        );
                        frmvalidator.addValidation("Nombre"        , "alpha_s"       , "Nombre: solo caracteres alfabeticos"    );

                        for (var campo = 0; campo < 32; campo++) {
                                frmvalidator.addValidation(equi[campo], "num"  , equi[campo] + ": solo caracteres numericos"     );
                                frmvalidator.addValidation(equi[campo], "gt=-1", equi[campo] + ": el campo no puede ser negativo");
                        }

                        frmvalidator.EnableOnPageErrorDisplaySingleBox();
                        frmvalidator.EnableMsgsTogether();
                </script>
        </div>
</div>

<?php
        include("Static/sideBar.php");
        include("Static/footer.php");
?>
