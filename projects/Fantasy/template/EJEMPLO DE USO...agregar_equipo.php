<?php
include("Static/head.php");
include("Static/header.php");
echo '<div id="content">
    <div id="contenido">';
				require_once("Classes/EstadioFachade.php");
				
				$equipo = array('Siglas','Nombre_Estadio','Nombre','AVG','JJ','VB','CA','BA','H','H2','H3',
				                'HR','CI','BB','SO','SH','SF','BR','ORB','SLG','HB','OBG',
								'EFE','JJ_Picheo','JI','JG','JP','JS','JC','IP','H_Picheo',
								'H2_Picheo','H3_Picheo','HR_Picheo','BB_Picheo','SO_Picheo',
								'Carreras_Limpias','WP','BK');
				echo "<form action=\"agregar_equipo_2.php\" method=\"post\" id=\"add_form\" >";
				echo "<table border='1'>";
				
				echo "<tr>";
				for($i=0;$i<3;$i++) {
					echo "<td>".$equipo[$i]."</td>";
				} 
				
				echo "</tr>";
				echo "<tr>";
				echo "<td><input type=\"text\" size=\"10\" name=\"".$equipo[0]."\"/></td>";
				
				$eFac = new EstadioFachade();
				$estadio = $eFac->getAllEstadio();
				$n = count($estadio);
	
				
				echo "<td>";
				echo "<select name=\"Nombre_Estadio\">";
				echo "<option size=30 value=000 selected>Seleccionar</option>";
				
				if($n != 0) {
					for($i = 0;$i < $n;$i++) {
						echo "<option>".$estadio[$i]->getNombre_estadio()."</option>";
					}
				}
				else {
					echo "<option>No existen campos</option>";
				}
				
				echo "<td><input type=\"text\" size=\"10\" name=\"".$equipo[2]."\"/></td>";
				echo "</td>";
				echo "</tr>"; 
				
				echo "<tr>";
				for($i=4;$i<12;$i++) {
					echo "<td>".$equipo[$i]."</td>";
				}
				echo "</tr>";
				
				echo "<tr>";
				for($i=4;$i<12;$i++) {
					echo "<td><input type=\"text\" size=\"10\" value=0 name=\"".$equipo[$i]."\"/></td>";
				}
				echo "</tr>";
				
				echo "<tr>";
				for($i=12;$i<21;$i++) {
					if($i != 19) {
						echo "<td>".$equipo[$i]."</td>";
					}
				}
				echo "</tr>";
				
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
				
				echo "<tr>";
				for($i=31;$i<39;$i++) {
					echo "<td><input type=\"text\" size=\"10\" value=0 name=\"".$equipo[$i]."\"/></td>";
				}
				echo "</tr>";
				
				echo "</table>";
				echo "<div id=\"add_form_errorloc\" class=\"error_strings\"></div>";
				echo "<input type=\"submit\" value=\"Enviar\">";
				echo "</form>";
echo	'<script type="text/javascript">
		var frmvalidator  = new Validator("add_form");
		var equi = new Array("JJ","VB","CA","BA","H","H2","H3","HR","CI","BB",
					"SO","SH","SF","BR","ORB","HB","JJ_Picheo",
					"JI","JG","JP","JS","JC","IP","H_Picheo","H2_Picheo",
					"H3_Picheo","HR_Picheo","BB_Picheo","SO_Picheo",
					"Carreras_Limpias","WP","BK");
		frmvalidator.addValidation("Siglas","req","Siglas: campo requerio");
		frmvalidator.addValidation("Siglas","maxlen=3","Siglas: maximo de caracteres 3");
		frmvalidator.addValidation("Siglas","alpha","Siglas: solo caracteres alfabeticos");
		frmvalidator.addValidation("Nombre_Estadio","dontselect=000","Nombre_Estadio: campo requerio");
		frmvalidator.addValidation("Nombre_Estadio","maxlen=30","Nombre_Estadio: maximo de caracteres 25");
		frmvalidator.addValidation("Nombre","req","Nombre: campo requerio");
		frmvalidator.addValidation("Nombre","maxlen=30","Nombre: maximo de caracteres 25");
		frmvalidator.addValidation("Nombre","alpha_s","Nombre: solo caracteres alfabeticos");
		
		for(var campo=0;campo < 32; campo++) {
			frmvalidator.addValidation(equi[campo],"num",equi[campo]+": solo caracteres numericos");
			frmvalidator.addValidation(equi[campo],"gt=-1",equi[campo]+": el campo no puede ser negativo");
		}
		
		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		</script>
	</div>
</div>';
include("Static/sideBar.php");
include("Static/footer.php");
?>
