<?php 


require "funciones.php";

$datos = array();

$datos[0] = $_POST['foto'] ?? '';
$datos[1] = $_FILES;


var_dump($datos[1]['foto-img']['name']);