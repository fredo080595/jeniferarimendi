<?php  

require "funciones.php";

if ($_POST['param'] == 1) {
	
	echo eliminarTodo($_POST['param']); 
}else{
	echo 0;
}