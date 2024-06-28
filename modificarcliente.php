<?php
//conectar con la BBDD
include_once 'conexion.php';
//Procesar la información recibida por $_POST
if($_POST){
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$provincia = $_POST['provincia'];
$pais= $_POST['pais'];


// $sqlUpdate = "UPDATE usuarios SET email= $email WHERE id= $id";


$sqlUpdate = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email,  direccion = :direccion, ciudad = :ciudad, provincia = :provincia, pais = :pais WHERE id = :id"; 

$sentenciaUpdate = $mbd->prepare ($sqlUpdate);
$sentenciaUpdate->bindParam(':id', $id, PDO::PARAM_INT);
$sentenciaUpdate->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':email', $email, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':direccion', $direccion, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':provincia', $provincia, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':pais', $pais, PDO::PARAM_STR);


$sentenciaUpdate->execute();

header('location:listadoclientes.php');
}
?>