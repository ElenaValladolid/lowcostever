<?php include 'cabecera.php' ?>
<?php
// el usuario no está autentificado, no podrá entrar 
// en esta página y se envía a la página de login 
if(!isset($_SESSION['user']) || $_SESSION['tipousuario']!== 1){
  header('location:login.php');
  exit;
}
?>




<div class="container col-md-6 text-center mb-5">
<form action="procesarregistro.php" method="POST">
    <img class="mb-4" src="market-6212590_1280.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Registro nuevo usuario</h1>
    <div class="form-floating">
      <input name="nombre" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca nombre </label>
    </div>
    <div class="form-floating">
      <input name="apellidos" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca apellidos</label>
    </div>
    <div class="form-floating">
      <input name="direccion" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca direccion</label>
    </div>
    <div class="form-floating">
      <input name="ciudad" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca Ciudad</label>
    </div>
    <div class="form-floating">
      <input name="provincia" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca provincia</label>
    </div>
    <div class="form-floating">
      <input name="pais" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Introduzca pais</label>
    </div>
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floting">
      <select name="tipousuario" id="tipousuario" class="form-control">
        <option selected value="0">Tipo usuario</option>
        <option value="1">Admin</option>
        <option value="2">Staff</option>
        <option value="3">Costumer</option>
      </select>
    </div>

    <button class="btn btn-primary w-100 py-2" type="submit">Registro</button>
   
  </form>
  </div>

  <?php include 'piepagina.php'?> 