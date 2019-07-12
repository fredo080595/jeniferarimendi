<?php  
require "funciones.php";

$user = $_POST['usuario'];
$pass = $_POST['password'];


echo entrarUsuario($user,$pass);


