<?php
    //Procesar la información recibida por $_POST
    if($_POST){
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    
    // echo "<P> $email </p>";
    // echo "<P> $password </p>";
    // echo "<p> $checkme </p>";

    header('location:index.php');

?>
