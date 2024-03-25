<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }
    include_once 'connection.php';
    $query = "SELECT id, CONCAT(apellido, ' ', nombre) AS nombre, email, ciudad, direccion, telefono FROM clientes WHERE baja = 0 ORDER BY apellido";
    $clientes = consultaSQL($query);

    $query ="SELECT cliente_id, nombre FROM mascotas WHERE ISNULL(fecha_muerte)";
    $mascotas = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria San Antón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="Recursos/logoVeterinaria.png">
</head>
<body id="body-secretaria">
<?php include_once 'menuSuperior.php' ?>    

    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <?php include 'menuLateral.php' ?>
            </div>
            

            <div class="col-3">
                <div class="list-group" id="list-tab" role="tablist" style="height: 300px; line-height: 1em; overflow-y: auto;">
                <?php
                while($row = mysqli_fetch_array($clientes)){
                    echo "<a class=list-group-item list-group-item-action id=idCliente:$row[id] data-bs-toggle=list href=#list-cliente$row[id] role=tab 
                    aria-controls=list-home onclick='getId(this)'>$row[nombre]</a>";
                }
                ?>
                </div>
            </div>
            <div class="col-6">
                <div class="tab-content" id="nav-tabContent">
                <?php
                mysqli_data_seek($clientes, 0);
                while($cliente = mysqli_fetch_array($clientes)){
                    echo "<div class=tab-pane fade id=list-cliente$cliente[id] role=tabpanel aria-labelledby=list-profile-list>Información de $cliente[nombre]";
                    mysqli_data_seek($mascotas, 0);
                    while ($m = mysqli_fetch_array($mascotas)){
                        if ($m['cliente_id'] == $cliente['id']){
                            echo "Dueño de $m[nombre]";
                        }
                    }
                    echo "</div>";
                }
                ?>
                </div>
            </div>
        </div>
        
        <div class="row colBotones">
            <div class="col-12">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAnadirCliente">Nuevo cliente</button>
                <button type="button" class="btn btn-outline-primary">Modificar</button>
                <button type="button" class="btn btn-outline-danger">Baja</button>
            </div>
        </div>
    </div>





    <!-- Modals -->
    <div class="modal fade" id="modalAnadirCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Nuevo cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="operacionesDB.php" method="POST">
                    <input type="hidden" name="operacion" value="insertarCliente">
                    <div class="modal-body">
                        
                        <div class="form-group">    
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Correo electrónico</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalModificarServ" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Modificar servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="operacionesDB.php" method="POST">
                    <input type="hidden" name="operacion" value="modificarServ">
                    <input type="hidden" id="idModificar" name="idModificar" value="0">    
                    <div class="modal-body">
                        <div class="form-group">    
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">    
                            <label>Tipo de servicio</label>
                            <select name="tipo_servicio_id" class="form-control" required>

                            <?php
                                foreach ($tipos_servicios as $t){
                                    echo "<option value=$t[id]>$t[nombre]</option>";
                                }
                            ?>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminarServ" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Eliminar servicio</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="operacionesDB.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="operacion" value="eliminarServ">
                            <input type="hidden" id="idEliminar" name="idEliminar" value="0">
                            <div class="form-group">
                                <label>¿Está seguro que desea eliminar el servicio seleccionado?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar servicio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script src="./scriptClientes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>