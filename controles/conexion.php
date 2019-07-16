<?php  

function conexion(){

/*	$conexion = mysqli_connect('jcjimenezmx36756.ipagemysql.com','jcjimenezmx36756','Busc.0412','galeria');*/
	$conexion = mysqli_connect('localhost','root','','galeria');
	return $conexion;
}

