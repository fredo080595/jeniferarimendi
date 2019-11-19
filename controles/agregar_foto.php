<?php 


require "funciones.php";

$datos = array();

$datos[0] = $_POST['foto'] ?? '';
$datos[1] = $_FILES;

$archivos = array();


$id_rand = substr(str_shuffle("0123456789"), 0, 5);

for ($i = 0; $i < count($_FILES['foto-img']['name']) ; $i++) {
	$archivos[$i] = array('name'=>$_FILES['foto-img']['name'][$i],
						'type'=>$_FILES['foto-img']['type'][$i],
						'tmp_name'=>$_FILES['foto-img']['tmp_name'][$i],
						'error'=>$_FILES['foto-img']['error'][$i],
						'size'=>$_FILES['foto-img']['size'][$i]);
}


for ($i = 0; $i <count($archivos) ; $i++) {
	
	if (insertaImagen($archivos[$i],$id_rand)) {
		$respuesta = 1;
	}else{
		$respuesta = 0;
	}
}

echo $respuesta;


