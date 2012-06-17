<?php
//Importo librerias
	require('FuncionesSql.php');
	require("JSON.php"); 
	require("FacebookObj.php"); 


//ATRIBUTOS///////////////////////////////
define("_serv", "mysql13.000webhost.com");
define("_userDB", "a9028921_user");
define("_passDB", "desarrollo2012");
define("_db", "a9028921_web");
/*
define("_serv", "localhost");
define("_userDB", "root");
define("_passDB", "root");
define("_db", "mashupcali");
*/

$json = new Services_JSON;

$dbi=sql_connect(_serv,_userDB,_passDB,_db);


//METODOS/////////////////////////////////

function subirNegocioDeFacebookASql($link, $categoria){
	global $dbi;
	
	$jsonFacebook=new FacebookObj($link);
	
	//Si no es un negocio envia false
	if (!$jsonFacebook->comprobarQueSeaNegocio())
		return "No es un negocio, esta privado o no tiene las coordenadas";
	
	$jsF=$jsonFacebook->getAtributosEnArray();
	
	//Probar que este todo en orden
	$sql = 'INSERT INTO `sitios` (`id`, `nombre`, `nickfacebook`, `imagen`, `categoria`, `direccion`, `telefono`, `paginaweb`, `latitud`, `longitud`, `time`) VALUES (NULL, \''.
	$jsF['nombre'].'\', \''.$jsF['nickfacebook'].'\', \''.$jsF['imagen'].'\', \''.
	$categoria.'\', \''.$jsF['direccion'].'\', \''.$jsF['telefono'].'\', \''.
	$jsF['paginaweb'].'\', \''.$jsF['latitud'].'\', \''.$jsF['longitud'].'\', \''.time().'\');'; 
	
	if (!sql_query($sql, $dbi))
		return 'El negocio ya existe';
	
	return true;
}

function getNegocioEnJson($indice){
	global $dbi;
	
	$result = sql_query("SELECT `id`, `nombre`, `nickfacebook`, `imagen`, `categoria`, `direccion`, `telefono`, `paginaweb`, `latitud`, `longitud` FROM `sitios` WHERE `id`='".sql_real_escape_string($indice)."'", $dbi);
	
	//Convierto a json el array de la base de datos y retorno
	return convertirArrayAJson(sql_fetch_array($result));
}


function getNegocioEnJsonDespuesDeUnTiempo($time){
	global $dbi;
	
	$result = sql_query("SELECT `id`, `nombre`, `nickfacebook`, `imagen`, `categoria`, `direccion`, `telefono`, `paginaweb`, `latitud`, `longitud`".
	"FROM `sitios` WHERE `time`='".$time."'", $dbi);
	
	//Convierto a json el array de la base de datos y retorno
	return convertirArrayAJson(sql_fetch_array($result));
}


function getUltimoNegocioEnJson(){
	global $dbi;
	
	$result = sql_query("SELECT `id`, `nombre`, `nickfacebook`, `imagen`, `categoria`, `direccion`, `telefono`, `paginaweb`, `latitud`, `longitud` FROM `sitios` ORDER BY `id` DESC LIMIT 1", $dbi);
	
	return convertirArrayAJson(sql_fetch_array($result));
}

function getMasInformacion($id, &$nombre, &$nickfacebook, &$imagen, &$categoria, &$direccion, &$telefono, &$paginaweb){
	global $dbi;
	if (!$id)
		return 0;
	$result = sql_query("SELECT `nombre`, `nickfacebook`, `imagen`, `categoria`, `direccion`, `telefono`, `paginaweb` FROM `sitios` WHERE ".
	"`id`='".$id."'", $dbi)or die(mysql_error(0));
	
	list($nombre, $nickfacebook, $imagen, $categoria, $direccion, $telefono, $paginaweb)=sql_fetch_row($result);
}


function getTodoLosNegociosEnJson($mini=0, $desdeId=0){
	
global $dbi;
	
	$columnas='id, nombre, nickfacebook, imagen, categoria, direccion, telefono, paginaweb, latitud, longitud';
	if ($mini)
		$columnas='id, nombre, direccion, categoria,  latitud, longitud';
	
	$result = sql_query("SELECT ".$columnas." FROM sitios WHERE id>=".$desdeId." ORDER BY id ASC", $dbi);
	$i=0;
	while($rowArray=sql_fetch_array($result)){
		
		$sqlArray[$i]=$rowArray;
		$i++;
	}
	mysql_free_result($result); 
	if ($sqlArray==NULL)
		return '';
	return convertirArrayAJson($sqlArray);
}

function convertirArrayAJson($arreglo){
	global $json;
	//stripslashes
	return ($json->encode($arreglo));
}

function extraerDatosUrl($url){
 	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  
	$curlData = curl_exec($curl);
	curl_close($curl);
  
	return ($curlData);  
}

function redirect($url,$seconds=0){
	$ss = $seconds * 1000;
	echo "<script>window.setTimeout('window.location=".chr(34).$url.chr(34).";',".$ss.");</script>";
	if ($seconds<=0)
		die();
}

?>