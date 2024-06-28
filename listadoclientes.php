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

$sqlConsulta = "SELECT id, nombre, apellidos, direccion, ciudad, provincia, pais, email, tipousuario FROM usuarios WHERE tipousuario=3";


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
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <!-- <th scope="col">Direccion</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Provincia</th>
                <th scope="col">pais</th> -->
                <th scope="col">e-mail</th>
                <th scope="col">Acciones</th>
                <th scope="col"></th>
                <th scope="col"></th>
                

                
            </tr>
        </thead>
        <tbody>   
        
            <?php foreach($resultado as $datos): ?>
            <tr>
                <th scope="row"><?php echo $datos['id']; ?></th>
                <td><?php echo $datos['nombre'];?></th>
                <td><?php echo $datos['apellidos']; ?></td>
                <!--<td><?php //echo $datos['direccion']; ?></td>
                <td><?php //echo $datos['ciudad']; ?></td>
                <td><?php //echo $datos['provincia']; ?></td>
                <td><?php //echo $datos['pais']; ?></td>-->
                <td><?php echo $datos['email']; ?></td>
                <td>
                    <button class="btn btn-primary btn-edit" onclick="editCliente('<?php echo $datos['id']; ?>', '<?php echo $datos['nombre'];?>', '<?php echo $datos['apellidos']; ?>', '<?php echo $datos['email']; ?>', '<?php echo $datos['direccion']; ?>', '<?php echo $datos['ciudad']; ?>', '<?php echo $datos['provincia']; ?>', '<?php echo $datos['pais']; ?>')">Editar</button>
                </td>

                <td>
                <button class="btn btn-primary btn-delete" onclick="deleteCliente('<?php echo $datos['id']; ?>')">Delete</button>
                </td>

                <td>
                <button class="btn btn-primary btn-delete" onclick="detalleCliente('<?php echo $datos['id']; ?>', '<?php echo $datos['nombre'];?>', '<?php echo $datos['apellidos']; ?>', '<?php echo $datos['email']; ?>', '<?php echo $datos['direccion']; ?>', '<?php echo $datos['ciudad']; ?>', '<?php echo $datos['provincia']; ?>', '<?php echo $datos['pais']; ?>' )">Mostrar Detalle</button>
                </td>


            </tr>

            <?php endforeach ?>
        </tbody>
    </table>
        </div>
        <div class="container text-center mt-2 mb-2">
        
            <button class="btn btn-primary btn-add" onclick="addCliente()">Añadir Cliente</button>
               
        </div>
    </div>

    <!--Modal de edición de la tabla -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="modificarcliente.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="editModalLabel">Editar clientes</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="edit-id" name="id" hidden>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="edit-nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="edit-apellidos" name="apellidos">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="edit-direccion" name="direccion" >
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control"  id="edit-ciudad" name="ciudad" >
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control"  id="edit-provincia" name="provincia" >
                        </div>
                        <div class="form-group">
                            <label for="pais">Pais</label>
                            <input type="text" class="form-control"  id="edit-pais" name="pais" >
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
                <form id="deleteForm" action="eliminarclientes.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar</h5>
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

    <!-- Modal añadir cliente -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addForm" action="addclientes.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="addModalLabel">Añadir clientes</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="add-id" name="id" hidden>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="add-nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="add-apellidos" name="apellidos">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="add-email" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="add-direccion" name="direccion" >
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control"  id="add-ciudad" name="ciudad" >
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control"  id="add-provincia" name="provincia" >
                        </div>
                        <div class="form-group">
                            <label for="pais">Pais</label>
                            <input type="text" class="form-control"  id="add-pais" name="pais" >
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control"  id="add-password" name="password" >
                        </div>
                        <input type="number" id="add-tipousuario" name="tipousuario" value="3" hidden>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir Cliente</button>
                    </div>

                </form>

            </div>

        </div>

    </div> <!--fin del Modal añadir cliente-->

    <!-- Modal mostrar detalles -->
    <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="detalleForm">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="detalleModalLabel">Mostrar Detalles</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="detalle-id" name="id" readonly>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="detalle-nombre" name="nombre" readonly>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="detalle-apellidos" name="apellidos" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="detalle-email" name="email" readonly >
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="detalle-direccion" name="direccion" readonly >
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control"  id="detalle-ciudad" name="ciudad" readonly >
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control"  id="detalle-provincia" name="provincia" readonly >
                        </div>
                        <div class="form-group">
                            <label for="pais">Pais</label>
                            <input type="text" class="form-control"  id="detalle-pais" name="pais" redonly >
                        </div>
                        
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>

            </div>

        </div>

    </div> <!--fin del Modal mostrar detalles-->

    </div>

<script>
    function editCliente(id, nombre, apellidos, email, direccion, ciudad, provincia, pais){
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nombre').value = nombre;
        document.getElementById('edit-apellidos').value = apellidos;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-direccion').value = direccion;
        document.getElementById('edit-ciudad').value = ciudad;
        document.getElementById('edit-provincia').value = provincia;
        document.getElementById('edit-pais').value = pais;

        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }
    function deleteCliente(id){
        document.getElementById('delete-id').value = id;

        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();

    }
    function addCliente(){
        
        var modal = new bootstrap.Modal(document.getElementById('addModal'));
        modal.show();
    }

    function detalleCliente(id, nombre, apellidos, email, direccion, ciudad, provincia, pais){
        document.getElementById('detalle-id').value = id;
        document.getElementById('detalle-nombre').value = nombre;
        document.getElementById('detalle-apellidos').value = apellidos;
        document.getElementById('detalle-email').value = email;
        document.getElementById('detalle-direccion').value = direccion;
        document.getElementById('detalle-ciudad').value = ciudad;
        document.getElementById('detalle-provincia').value = provincia;
        document.getElementById('detalle-pais').value = pais;
        
        var modal = new bootstrap.Modal(document.getElementById('detalleModal'));
        modal.show();
    }
</script>

<?php include 'piepagina.php' ?>