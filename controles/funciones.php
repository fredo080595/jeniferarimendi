<?php  
require "conexion.php";

function visulizarDatos(){

	$conexion = conexion();
	$sql = "SELECT f_id,f_nombre_foto,f_ruta,id_nombre_galeria FROM fotos";
	$result = mysqli_query($conexion,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}

function visulizarDatosGaleria($id_galeria){

	$conexion = conexion();
	$sql = "SELECT f_id,f_nombre_foto,f_ruta,id_nombre_galeria FROM fotos where id_nombre_galeria = '$id_galeria'";
	$result = mysqli_query($conexion,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}

function fotoInicio(){
	$conexion = conexion();
	$sql = "SELECT f_id,f_nombre_foto,f_ruta FROM fotos LIMIT 1";
	$result = mysqli_query($conexion,$sql);
	return mysqli_fetch_row($result);

}

function visulizarDatosindex(){

	$conexion = conexion();
	$sql = "SELECT f_id,f_nombre_foto,f_ruta FROM fotos LIMIT 6";
	$result = mysqli_query($conexion,$sql);
	return mysqli_fetch_all($result,MYSQLI_ASSOC);

}
function entrarUsuario($user,$pass){
	session_start();
	$conexion = conexion();
	$passw = sha1($pass);
	$sql = "SELECT user FROM usuario where user = '$user' and pass = '$passw'";
	$result = mysqli_query($conexion,$sql);
	if (count(mysqli_fetch_array($result)) > 1) {
		$_SESSION['user'] = $user;
		return 1;
	}else{
		return 0;
	}

}
function eliminarDato($id){
	if (compara_img($id)) {
		$conexion = conexion();
		$sql = "DELETE FROM fotos WHERE f_id='$id'";
		$result = mysqli_query($conexion,$sql);
		if ($result) {
			return 1;
			
		}else{
			return 2;
		}
	}else{
		return 0;
	}

}

function insertaImagen($datosImagen,$id_random){

	if (!empty($datosImagen)) {
		$extension = pathinfo($datosImagen['name'], PATHINFO_EXTENSION);
		$extension = strtolower($extension);
		$validextensions = array("jpg", "jpeg", "png", "gif", "PNG", "JPG", "JPEG");

		if (in_array($extension, $validextensions)) {

		        $random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
		        $nombre_foto = $random . "_" . date("YmdHis") . "." . $extension;
		        $ruta_destino = "../img/portfolio/fullsize/" . $nombre_foto;
		        $archivo_movido_ok = move_uploaded_file($datosImagen['tmp_name'], $ruta_destino);


		        if ($archivo_movido_ok) {
		        	consultaImg($datosImagen['name'],$nombre_foto,$id_random);

		            return true;	

		        } else {
		            return false;
		        }
		    
		} 
	}else{
		return 0;
	}

}

function consultaImg($datosImagen,$ruta,$id_random){

	$conexion = conexion();
	$sql = "INSERT INTO fotos(f_nombre_foto,f_ruta,id_nombre_galeria) values ('$datosImagen','$ruta','$id_random')";
	$result = mysqli_query($conexion,$sql);
	if ($result) {
		return 1;
	}else{
		return 0;
	}

}


function comparaImg($id){

	$conexion = conexion();
	$sql = "SELECT f_id,f_nombre_foto,f_ruta FROM fotos WHERE f_id = '$id'";
	$result = mysqli_query($conexion,$sql);
	return mysqli_fetch_row($result);


}

function compara_img($id){{
            $elim = comparaImg($id);
            if (isset($elim[2])) {
                unlink("../img/portfolio/fullsize/".$elim[2]);
                return true;
            } else {
                return false;
            }
        } 

}

function eliminarTodo($dato){

	if ($dato == 1) {

		$files = glob('../img/portfolio/fullsize/*');

		foreach ($files as $file) {
			if (is_file($file)) {
				unlink($file);
			}

		}
		$conexion = conexion();
		$sql = 'DELETE FROM fotos';
		$result = mysqli_query($conexion,$sql);

		if ($result) {
			return 1;
		}else{
			return 0;
		}

	}else{
		return 0;
	}


}

