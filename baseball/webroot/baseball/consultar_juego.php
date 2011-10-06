<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Triple Play</title>
                <link href="style.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
                <div id="consult">
                        <div id="logo">
                                <h1><a href="inicio.html"><span class="hidden">Triple Play</span></a></h1>
                        </div>
                        <div id="container">
                                <div id="header"></div>
                                <div id="navigation">
                                        <h2 class="hidden">Navigation</h2>
                                        <ul>
                                                <li><a href="consultar.html"  class="consult"><span class="hidden">Consultar </span></a></li>
                                                <li><a href="insertar.html"   class="insert" ><span class="hidden">Insertar  </span></a></li>
                                                <li><a href="eliminar.html"   class="delete" ><span class="hidden">Eliminar  </span></a></li>
                                                <li><a href="actualizar.html" class="update" ><span class="hidden">Actualizar</span></a></li>
                                        </ul>
                                </div>
                                <div id="content">
                                        <div id="content-left">
                                                <div id="title">
                                                        <h2 class="hidden">Indice</h2>
                                                </div>
												<center>
                                                <div id="description" >
												
													<div class="menu_elem">
													<a href="consultar_equipo.php" class="link_hide">Por Equipo</a>
													</div>
													
													<div class="menu_elem">
													<a href="consultar_juego.php" class="link_hide">Por Juego</a>
													</div>
													
													<div class="menu_elem">
													<a href="consultar_estadio.php" class="link_hide">Por Estadio</a>
													</div>
                                                </div>
												</center>
                                        </div>
                                        <div id="content-right">
                                                <div id="main">
                                                 																							
															<form action="consultarjuego.php" method="POST" id="consultar_juego">
																<table border="0" style="text-align:left;" cellpadding="5px;" >
																																		
																	<tr>
																		<td>
																			Equipo:
																		</td>
																		<td>
																			<select name="equipo" id="equipo">
																				<option >Navegantes del Magallanes</option>
																				<option >Leones del Caracas</option>
																				<option >Tigres de Aragua</option>
																			</select>
																		</td>	
																	</tr>
																	
																	<tr>
																		<td>
																			Estadio:
																		</td>
																		<td>
																			<select name="estadio" id="estadio">
																				<option >Estadio Universitario</option>
																				<option >Estadio Enzo Hernández</option>
																				<option > Estadio José Bernardo Pérez</option>
																			</select>
																		</td>	
																	</tr>
																	<tr>
																		<td COLSPAN="2" style="text-align:center;">
																			<input type="submit" value="BUSCAR" style="font-weight:bold; width:100px; height:30px; color:white; background-color:#885411;">
																		</td>	
																	</tr>																	 
																			
																</table>
															</form>																																																			
							                    </div>
                                        </div>
                                </div>
                        </div>
                        <div id="footer">
                                <p>Un producto de Ñángara, Inc. <img src="images/vendor.png" alt="Una pieza del teclado de un computador, con el simbolo de ñangara." /></p>
                        </div>
                </div>
        </body>
</html>
