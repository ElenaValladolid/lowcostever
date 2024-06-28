<?php
//conecta con la BBDD (base de datos)
include_once 'conexion.php';

//recoger datos del formulario Nuevo Usuario
if($_POST){
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    


    $sqlInsert = "INSERT INTO productos (id, producto, descripcion, precio,unidades) VALUES (?, ?, ?, ?, ?)";

    

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array(NULL, $producto, $descripcion, $precio, $unidades));

    header( 'location:introducirproductos.php');
}
?>





