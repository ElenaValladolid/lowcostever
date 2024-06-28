<?php include 'cabecera.php' ?>
<?php
// el usuario no está autentificado y no es el administrador, no podrá entrar 
// en esta página y se envía a la página de login 
if(!isset($_SESSION['user']) || $_SESSION['tipousuario']!== 1){
    header('location:login.php');
    exit;
}
?>

<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT id, producto, descripcion, precio, unidades FROM productos";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

// var_dump($resultado);
?>



<div class ="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
        <table class="table table-success">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">€/ud</th>
                    <th scope="col">Uds</th> 
                    <th scope="col">Acciones</th> 
                    <th scope="col">
                        <button class="btn btn-primary btn-add" onclick="StockProducto()">Stock Minimo</button>
                    </th>
                    
                    
                </tr>
            </thead>
            <tbody> 

  <!-- Resaltar el producto con uds < 10 en la misma tabla de productos con un 
fondo de la fila de color rojo y el texto en blanco -->              
                <?php foreach($resultado as $datos): ?>
                   
                    <?php
                        if($datos['unidades'] < 10){ 
                            echo '<tr class="table-danger">';
                        
                        }else{
                            echo "<tr>";
                        }
                       
                            echo "<th>".$datos['producto']."</th>";
                            echo "<td>".$datos['descripcion']."</td>";
                            echo "<td>".$datos['precio']."</td>";
                            echo "<td>".$datos['unidades']."</td>";
                        ?>
                        <td>
                        <button class="btn btn-primary btn-edit" onclick="editProducto('<?php echo $datos['id']; ?>', '<?php echo $datos['producto']; ?>', '<?php echo $datos['descripcion'];?>', '<?php echo $datos['precio']; ?>', '<?php echo $datos['unidades']; ?>')">Editar</button>
                        </td>

                        <td>
                        <button class="btn btn-primary btn-delete" onclick="deleteProducto('<?php echo $datos['id']; ?>')">Delete</button>
                        </td>

                        </tr>

                        
                       
                                      
            
                <?php endforeach ?>
            </tbody>
        </table>
        
        </div>
        <div class="container text-center mt-2 mb-2">
        
            <button class="btn btn-primary btn-add" onclick="addProducto()">Añadir Producto</button>
               
        </div>

    </div>

</div>

<!-- Crear una nueva tabla bajo la principal con los datos de los productos con uds 
< 10.  -->
<?php
$sqlConsulta2 = "SELECT producto, descripcion, precio, unidades FROM productos WHERE unidades<10 ";

$sentenciaSelect2 = $mbd->prepare($sqlConsulta2);
$sentenciaSelect2->execute();

$resultado2 = $sentenciaSelect2->fetchAll();
?>
<!--<div class ="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
        <table class="table table-success">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>€/ud</th>
                    <th>Uds</th>  
                </tr>
            </thead>
            <tbody> 
                <?php foreach($resultado as $datos): ?>
                    <tr>        
                    <th style="background-color:darkred;color:white;"><?php echo $datos['producto']; ?></th>
                    <td style="background-color:darkred;color:white;"><?php echo $datos['descripcion']; ?></td>
                    <td style="background-color:darkred;color:white;"><?php echo $datos['precio']; ?></td>
                    <td style="background-color:darkred;color:white;"><?php echo $datos['unidades']; ?></td>
                    </tr>
                
                <?php endforeach ?>
            </tbody>
        </table>
        
 
        </div>

    </div>

</div>-->

<!-- Crea una serie de cajitas de alertas con los datos de los productos con uds < 
10. -->

<!--<div class ="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
        <div class="row gap-2">
            
            
                <?php foreach($resultado as $datos): ?>
                <div class="alert col-3" style="background-color:darkred;color:white;">         
                    <p>producto: <?php echo $datos['producto']; ?></p>
                    <p>descripción: <?php echo $datos['descripcion']; ?></p>
                    <p>precio: <?php echo $datos['precio']; ?></p>
                    <p>unidades: <?php echo $datos['unidades']; ?></p>
                    
                </div>
                <?php endforeach ?>
           
                </div>
        

        
        </div>

    </div>


    

</div>-->

<!--Modal de edición de la tabla -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="modificarproducto.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="editModalLabel">Editar productos</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                    <input type="text" id="edit-id" name="id" hidden>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" class="form-control" id="edit-producto" name="producto">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="edit-descripcion" name="descripcion">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step ="any" class="form-control" id="edit-precio" name="precio" >
                        </div>
                        <div class="form-group">
                            <label for="unidades">Unidades</label>
                            <input type="number" class="form-control" id="edit-unidades" name="unidades" >
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>

            </div>

        </div>

    </div> <!--fin del Modal edición -->

    <!-- Modal eliminar registro tabla -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" action="eliminarproductos.php" method="post">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Productos</h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="delete-id" name="id" hidden>
                    <p>Esta acción elimina el registro seleccionado</p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                </div>

            </form>

        </div>

    </div>

</div> <!--fin del Modal eliminar registro tabla -->

<!-- Modal stock Producto -->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="stockModalLabel">Stock minimo</h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <table class="table table-striped">
                        <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>€/ud</th>
                    <th>Uds</th>  
                </tr>
            </thead>
            <tbody> 
                <?php foreach($resultado2 as $datos2): ?>
                    <tr>        
                    <th><?php echo $datos2['producto']; ?></th>
                    <td><?php echo $datos2['descripcion']; ?></td>
                    <td><?php echo $datos2['precio']; ?></td>
                    <td><?php echo $datos2['unidades']; ?></td>
                    </tr>
                
                <?php endforeach ?>
            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

        </div>

    </div>

</div> <!--fin del Modal stock producto -->



<!-- Modal añadir producto -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addForm" action="addproductos.php" method="post">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="addModalLabel">Añadir producto</h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control" id="add-producto" name="producto">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="add-descripcion" name="descripcion" >
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="any" class="form-control" id="add-precio"
                         name="precio" > 
                         <!-- tY
                         type="text"(no haria falta poner step="any") para poner decimales -->
                    </div>
                    <div class="form-group">
                        <label for="unidades">Unidades</label>
                        <input type="number" class="form-control" id="add-unidades" name="unidades" >
                    </div>
                    
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Añadir Producto</button>
                </div>

            </form>

        </div>

    </div>

</div> <!--fin del Modal añadir producto-->

    </div>
<script>
    function editProducto(id, producto, descripcion, precio, unidades){
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-producto').value = producto;
        document.getElementById('edit-descripcion').value = descripcion;
        document.getElementById('edit-precio').value = precio;
        document.getElementById('edit-unidades').value = unidades;

        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }
    function deleteProducto(id){
        document.getElementById('delete-id').value = id;

        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
    function addProducto(){
        
        var modal = new bootstrap.Modal(document.getElementById('addModal'));
        modal.show();
    }

    function StockProducto(){
        // document.getElementById('stock-id').textContent = id;
        // document.getElementById('stock-proucto').textContent = producto;
        // document.getElementById('stock-descripcion').textContent = descripcion;
        // document.getElementById('stock-precio').textContent = precio;
        // document.getElementById('stock-unidades').textContent = unidades;

        var modal = new bootstrap.Modal(document.getElementById('stockModal'));
        modal.show();
    }
</script>


<?php include 'piepagina.php' ?>