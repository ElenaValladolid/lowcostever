<?php include 'cabecera.php' ?>

<div class="container col-md-6 text-center mb-5">
  <form action="procesarproducto.php" method="POST">
      <img class="mb-4" src="market-6212590_1280.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Registro nuevo producto</h1>

      <div class="form-floating">
        <input name="producto" type="text" class="form-control" id="floatingInput" >
        <label for="floatingInput">Introduzca producto</label>
      </div>
      <div class="form-floating">
        <input name="descripcion" type="text" class="form-control" id="floatingPassword" >
        <label for="floatingPassword">Introduzca descripcion</label>
      </div>
      <div class="form-floating">
        <input name="precio" type="number" class="form-control" id="floatingPassword" >
        <label for="floatingPassword">Introduzca precio</label>
      </div>
      <div class="form-floating">
        <input name="unidades" type="number" class="form-control" id="floatingPassword" >
        <label for="floatingPassword">Introduzca unidades</label>
      </div>

      
      <button class="btn btn-primary w-100 py-2" type="submit">Registro</button>
    
  </form>
</div>

  <?php include 'piepagina.php'?> 