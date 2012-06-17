<?php
require("funciones/Funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8" />
		<title>FaceMaps</title>
		<link rel="shortcut icon" href="http://desarrolloweb.netai.net/img/favicon.ico">
				
	<!--Estilo CSS  -->
	<link title="hoja1" href="css/estilo1.css" rel="stylesheet" type="text/css" media="screen">
     	<link title="hoja2" href="css/estilo2.css" rel="alternate stylesheet" type="text/css" media="screen">
	
	<!--Javascript  -->
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="js/mashup.js"></script>
	<script type="text/javascript" src="js/stylesheetToggle.js"></script>

	<script type="text/javascript">
	$(function()
		{
			$.stylesheetInit();

			$('#estilo').bind(
				'click',
				function(e)
				{
					$.stylesheetToggle();
					return false;
				}
			);
			
		}
	);
	</script>
		
	<!--Fuentes-->
	<link href='http://fonts.googleapis.com/css?family=Averia+Sans+Libre' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
				
	</head>
	<body>
		<div id="contenedor">
		<header>
			<span id="logo"/></span>
			<button id="estilo">¡Cambie su estilo!</button>			
			<span id="eslogan">¡Comparte tu negocio!</span>
		</header>
		
		
			<div id="mapform">
					
					<div id="mapa"></div><!--termina div mapa-->	
					
					
					<div id="formulario">
                    
						<span id="textform">
                           <div id="respuesta"></div>

                         <a href="https://www.facebook.com/pages/Cali-Colombia/102179163156543" target="_blank">
               			 <img src="img/facebook.png" width="17" align="absmiddle" /></a>
                        Agregar negocio de Facebook
                       </span>
               			
                         <form name="form1" id="form1" method="post" action="" onSubmit="return formAjax();">
										
							<input id="url" type="text" placeholder="Ej: https://www.facebook.com/UniversidadSantiagoDeCali">
							
							<select id="categoria"><!--TENER EN CUENTA QUE LOS VALUE SON EN MINUSCULA Y SIN ESPACIO-->
                                 
                                  <option value="" selected="selected">Seleccionar Categoria</option>
                            	 <option value="centro-comercial">Centro comercial</option>
                                  <option value="centro-de-estudio">Centro de estudio</option>
                                  <option value="hotel">Hotel</option>
                                  <option value="bar">Bar</option>
                                  <option value="restaurante">Restaurante</option>
                                  <option value="espacios-culturales"> Espacios culturales</option>
                                  <option value="otras-empresas">Otras empresas</option>
							</select>
							
							<button id="btnform">Añadir Negocio</button>						  
							 
						</form>
					
						
					</div><!--termina div formulario-->			
				
			</div><!--termina div mapform-->
			
			
		
			<div id="info">
				<div id="cajatitulo">
					<span id="tituloinfo">Información</span>
				</div><!--termina div tituloinfo-->
				
				<div class="claseinfo" id="cajainfo">
                  Haz click en un marcador
											
				</div><!--termina cajainfo-->
				
			</div><!--termina div info-->

		<footer>
			<span id="footer">Creative Commons by @Facemaps </span>	
		</footer>
			</div><!--termina div contenedor-->
			
	</body>
</html>
