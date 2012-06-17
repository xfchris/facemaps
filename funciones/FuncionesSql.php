<?php

//Conectar a la Base de datos
function sql_connect($Serv, $userS, $passS, $BDD){  
	 $dbi=mysql_connect($Serv, $userS, $passS);
	  if(!$dbi){
		  echo 'N. '; 	
		  session_destroy();
	  }
	  if (!mysql_select_db($BDD))
		  echo 'No db';
			
	return $dbi;
}
//Hacer una consulta a la base de datos
function sql_query($query, $ref_id){
    return mysql_query($query, $ref_id);
}
//saber cuantas lineas fueron afectadas
function sql_affected_rows(){
	$r=mysql_affected_rows();
		if($r==-1){
		return 0;
	}
	return $r;
}
//leer consulta de una tabla resultado=1
function sql_fetch_row($res){
	$row = mysql_fetch_row($res);
	mysql_free_result($res); 
    return $row;
}
//leer consulta de una tabla resultado=varias
function sql_fetch_array($res){
	$row = mysql_fetch_array($res);
    return $row;
}
//proteje consultas ante sql_Injection
function sql_real_escape_string($texto){
	return mysql_real_escape_string($texto);
}

?>