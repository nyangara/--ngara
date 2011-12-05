<?php
 $equipo = "LEON";
 $url = "http://www.lvbp.com/scripts/home/estadisticas_equip.asp?equipo=".$equipo."&co_temporada=1&co_ano_temporada=5&ds_temporada=Temporada%202011%20-%202012";
 $input = @file_get_contents($url) or die("Could not access file: $url");

  preg_match_all("|<tr>[\s\n]*<td align=\"left\" class=\"tdTablaPos1\"><a href=\"(.*)\" class=\"fuenteLideresDet2\">(.*)</a></td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">".$equipo."</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<\/tr>|"
            , $input, $matches,PREG_PATTERN_ORDER);
 
   // $date = getdate();
   date_default_timezone_set('America/Caracas');
    $date = date("Y/m/d");
    
    $url = "http://www.lvbp.com/scripts/home/estadisticas_equip.asp?equipo=".$equipo."&co_temporada=1&co_ano_temporada=5&ds_temporada=Temporada%202011%20-%202012";

        $input = @file_get_contents($url) or die("Could not access file: $url");

        preg_match_all("|<tr>[\s\n]*<td align=\"left\" class=\"tdTablaPos1\"><a href=\"(.*)\" class=\"fuenteLideresDet2\">(.*)</a></td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">".$equipo."</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<td align=\"center\" class=\"tdTablaPos1\">(.*)</td>[\s\n]*<\/tr>|"
            , $input, $matches,PREG_PATTERN_ORDER);
    
    
    
    echo count($matches[0]);
	/*for ($i = 1; $i < count($matches[0]); $i++){*/
        echo 'nomb  ';
		echo $matches[2][0]; //nombre
		echo ' el  ';
		echo $matches[11][0]; //el
        echo ' cl ';
		echo $matches[17][0]; //cl 
        echo '  i ';
		echo $matches[12][0];//i
        echo '  bb  ';
		
		echo $matches[18][0];//bb
		echo '   k  ';
       
        echo $matches[19][0];//k
        echo '   jg  ';
        echo $matches[5][0];//jg
    

?>