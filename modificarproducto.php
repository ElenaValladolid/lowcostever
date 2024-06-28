<?php
//conectar con la BBDD
include_once 'conexion.php';
//Procesar la información recibida por $_POST(recoger datos formulario)
if($_POST){
$id = $_POST['id'];
$producto = $_POST['producto'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$unidades = $_POST['unidades'];


//Sentencia de modificar registro en tabla BBDD
$sqlUpdate = "UPDATE productos SET producto = :producto, descripcion = :descripcion, precio = :precio,  unidades = :unidades WHERE id = :id"; 

//Preparar los  valores del sql
$sentenciaUpdate = $mbd->prepare ($sqlUpdate);
$sentenciaUpdate->bindParam(':id', $id, PDO::PARAM_INT);
$sentenciaUpdate->bindParam(':producto', $producto, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':precio', $precio, PDO::PARAM_STR);
$sentenciaUpdate->bindParam(':unidades', $unidades, PDO::PARAM_INT);



$sentenciaUpdate->execute();

header('location:listadoproductos.php');
}
?>