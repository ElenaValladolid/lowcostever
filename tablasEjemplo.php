<?php include 'cabecera.php' ?>


<div clas="Container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr><th>Nombre</th><th>Telefono</th><th>email</th></tr>
                </thead>
                <tbody>   
                        <?php foreach $resultado as $dato:?>
                    <tr>
                        <td><?php echo $dato['nombre']; ?></td>
                        <td><?php echo $dato['telefono']; ?></td>
                        <td><?php echo $dato['email']; ?></td>
                    </tr>
                    <?php endforeach ?>   
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'piepagina.php'?> 