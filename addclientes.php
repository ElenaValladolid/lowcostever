<?php
//conecta con la BBDD (base de datos)
include_once 'conexion.php';

//recoger datos del formulario Nuevo Usuario
if($_POST){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $provincia = $_POST['provincia'];
    $pais = $_POST['pais'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipousuario = $_POST['tipousuario'];

     //Cifrar las contraseñas antes de enviarlas al BBDD (hash)
     $hasedPassword = password_hash($password, PASSWORD_DEFAULT);


    $sqlInsert = "INSERT INTO usuarios (id, nombre, apellidos, direccion, ciudad, provincia, pais, email, password, tipousuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array(NULL, $nombre, $apellidos, $direccion, $ciudad, $provincia, $pais, $email, $hasedPassword, $tipousuario));

    header( 'location:listadoclientes.php');
}
?>
