<?php 


require "funciones.php";

$datos = array();

$datos[0] = $_POST['foto'];
$datos[1] = $_FILES['foto-img'];


echo insertaImagen($datos);
