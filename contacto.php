<?php include 'cabecera.php' ?>

<div class="container mt-5">
    <div class="row">
       <div class="col-sm-6 col-md-6 col-xl-3 mt-5">
       <form action="procesarcontacto.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="checkme" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>
            <div class="col-md-6 mt-5">
            <img class="figure-image rounded" src="map.PNG" alt="mapa" width="100%">
        </div>
    </div>

</div>
<?php include 'piepagina.php'?> 