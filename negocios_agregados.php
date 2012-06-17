<?php
require("funciones/Funciones.php");

header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');

//atributos get
$mini=$_GET['mini'];
$desde=$_GET['desde']+0;
$callback=$_GET['callback'];


if ($callback)
	echo $callback.'(';
	echo getTodoLosNegociosEnJson($mini, $desde);
if ($callback)
	echo ');';
die();
?>