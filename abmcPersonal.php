<?php
    session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        die();
    }
    include_once 'connection.php';
    $query = "SELECT personal.id, personal.nombre, personal.apellido, personal.email, personal.rol_id, roles.nombre AS nombre_rol FROM personal INNER JOIN roles ON personal.rol_id = roles.id WHERE personal.baja = 0";
    $personal = consultaSQL($query);
    $query = "SELECT id, nombre FROM roles";
    $roles = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Veterinaria San Antón</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css?v=20" type="text/css">
        <link rel="icon" href="Recursos/logoVeterinaria.png">
    </head>
    <body id="body-secretaria">
<?php include_once 'menuSuperior.php' ?>    
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <?php include 'menuLateral.php' ?>
                </div>
            
                <div class="col-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Mail</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    while($row = mysqli_fetch_array($personal)){
        ?>
                            <tr id=<?php echo "idPersonal:$row[id]"?> onclick='getId(this)'>
                                <td name="nombre"><?php echo $row['nombre'] ?></th>
                                <td name="apellido"><?php echo $row['apellido'] ?></td>
                                <td name="email"><?php echo $row['email'] ?></td>
                                <td name="rol_id" id=<?php echo "idRol:$row[rol_id]>$row[nombre_rol]" ?></td>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>

                    <div class="row colBotones" align="right">
                        <div class="col-12">
                            <button type="button" id="btnAnadirPers" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAnadirPers">
                                Nuevo personal
                            </button>
                            <button type="button" id="btnModificarPers" class="btn btn-outline-primary" onclick="mostrarModal(this)">
                                Modificar
                            </button>
                            <button type="button" id="btnEliminarPers" class="btn btn-outline-danger" onclick="mostrarModal(this)">
                                Baja
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modals -->
        <div class="modal fade" id="modalAnadirPers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Nuevo personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="operacionesDB.php" method="POST">
                        <input type="hidden" name="operacion" value="insertarPers">
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
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">    
                                    <label>Contraseña</label>
                                    <input type="password" name="clave" class="form-control" required>
                                </div>
                                <div class="form-group">    
                                    <label>Rol</label>
                                    <select name="rol_id" class="form-control" required>

                                    <?php
                                        foreach ($roles as $r){
                                            echo "<option value=$r[id]>$r[nombre]</option>";
                                        }
                                    ?>

                                    </select>
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

        <div class="modal fade" id="modalModificarPers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Modificar personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="operacionesDB.php" method="POST">
                        <input type="hidden" name="operacion" value="modificarPers">
                        <input type="hidden" id="idModificar" name="idModificar" value="0">    
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
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">    
                                <label>Rol</label>
                                <select name="rol_id" class="form-control" required>

                                <?php
                                    foreach ($roles as $r){
                                        echo "<option value=$r[id]>$r[nombre]</option>";
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

        <div class="modal fade" id="modalEliminarPers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Eliminar personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="operacionesDB.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="operacion" value="eliminarPers">
                            <input type="hidden" id="idEliminar" name="idEliminar" value="0">
                            <div class="form-group">
                                <label>¿Está seguro que desea eliminar el personal seleccionado?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="./scriptPersonal.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>