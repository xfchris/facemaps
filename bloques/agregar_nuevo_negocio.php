<?php
include ("../funciones/Funciones.php");

	$resp=subirNegocioDeFacebookASql($_POST['url'], $_POST['categoria']);

	if ($resp===true){
		$resp = 'Agregado. En unos segundos aparecera';
	}
	
	echo '<div id="msg">'.$resp.'</div>';
	//print_r($_POST);
?>