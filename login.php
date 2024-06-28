<?php 
include 'cabecera.php';
include_once 'conexion.php';
// session_start();

//si existe la sesion reenviar a index.php
if(isset($_SESSION['user'])){
  header('location:index.php');
  exit;
}

//procesar el formulario de login
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  
  try{
      $sqlLogin = "SELECT 
      
       nombre, password, tipousuario FROM usuarios WHERE email = :email";

      $sentenciaLogin = $mbd->prepare($sqlLogin);
      $sentenciaLogin->bindParam(':email', $email, PDO::PARAM_STR);
      $sentenciaLogin->execute();

      //Recoger los datos en un array asociativo
      $resultado = $sentenciaLogin->fetch(PDO::FETCH_ASSOC);

      //verificar que la contraseña es correcta
      if($resultado){
          if(password_verify($password, $resultado['password'])){
              $_SESSION['user'] = $email; 
              $_SESSION['nombre'] = $resultado['nombre'];
              $_SESSION['tipousuario'] = $resultado['tipousuario'];
              header('location:index.php');
              exit;
          }
          
          else{
              $mensajeError='Credenciales incorrectas';
          }
      }
      else{
          $mensajeError='Ususario no correcto';
          }
  }
  catch(PDOException $e)
  {
      $mensajeError='Error en la base de datos: ' . $e->getMessage();
  }
}


?>

<div class="container col-md-6 text-center mb-5">
<form action="login.php" method="POST">
    <img class="mb-4" src="market-6212590_1280.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>
    <?php if(isset($mensajeError)):?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($mensajeError);?>
            </div>
            <?php endif ?>


    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca email</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
   
  </form>
  </div>

  <?php include 'piepagina.php'?> 