<?php
    session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        die();
    }
    include_once 'consultasdb/connection.php';
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
        <link rel="stylesheet" href="styles/styles.css" type="text/css">
        <link rel="stylesheet" href="styles/stylesPersonal.css" type="text/css">
        <link rel="icon" href="recursos/logoVeterinaria.png">
    </head>
    <body>
        <?php include_once 'snippets/menuSuperior.php' ?>    
    
        <div class="container-fluid p-0">
            <div class="row">
                <?php  $_SESSION['item'] = 'personal'; include_once 'snippets/menuLateral.php'; ?>
                
                <div class="col-12 col-md-5 col-lg-8 mt-3 ">
                    <table class="table">
                        <thead class="border-3 border-warning">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="d-none d-sm-table-cell">Mail</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody class="border-3 border-warning">
<?php
    while($row = mysqli_fetch_array($personal)){
        ?>
                            <tr id=<?php echo "personal_id:$row[id]"?> onclick='getId(this)' tabindex="0" onkeydown="if(event.key == 'Enter'){getId(this)}">
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['apellido'] ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $row['email'] ?></td>
                                <?php echo "<td data-rol_id=$row[rol_id]>$row[nombre_rol]</td>" ?>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>

                    <div class="row colBotones">
                        <div class="col-12">
                            <button type="button" id="btnAnadirPers" class="btn btn-outline-success" onclick="mostrarModalPersonal(this)">
                                Nuevo personal
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="btnModificarClave" onclick="mostrarModalClave(this)">
                                Cambiar contraseña
                            </button>
                            <button type="button" id="btnModificarPers" class="btn btn-outline-primary" onclick="mostrarModalPersonal(this)">
                                Modificar
                            </button>
                            <button type="button" id="btnEliminarPers" class="btn btn-outline-danger" onclick="mostrarModalEliminar(this)">
                                Baja
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modals -->
        <div class="modal fade" id="modalPersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalPersonal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="labelModalPersonal" class="modal-title fs-5">Personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="consultasdb/personal.php" method="POST">
                        <input type="hidden" name="operacion">
                        <input type="hidden" name="id_modificar">    
                        <div class="modal-body">
                                <div class="form-group">    
                                    <label for="nombrePersonal">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="nombrePersonal" required>
                                </div>
                                <div class="form-group">    
                                    <label for="apellidoPersonal">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" id="apellidoPersonal" required>
                                </div>
                                <div class="form-group">    
                                    <label for="correoPersonal">Correo electrónico</label>
                                    <input type="email" name="email" class="form-control" id="correoPersonal" required>
                                </div>
                                <div class="form-group div_clave">    
                                    <label for="clavePersonal">Contraseña</label>
                                    <input type="password" name="clave" class="form-control" id="clavePersonal" required>
                                </div>
                                <div class="form-group">    
                                    <label for="selectRol">Rol</label>
                                    <select name="rol_id" class="form-select" id="selectRol" required>
                                        <option disabled value=""> -- Seleccione un rol -- </option>
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
                            <button type="submit" class="btn btn-success" name="btn_enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalEliminar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="labelModalEliminar" class="modal-title fs-5">Eliminar personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="consultasdb/personal.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="operacion" value="eliminar">
                            <input type="hidden" id="id_eliminar" name="id_eliminar" value="0">
                            <div class="form-group">
                                <p>¿Está seguro que desea eliminar el personal seleccionado?</p>
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
        <div class="modal fade" id="modalModificarClave" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalClave" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="labelModalClave" class="modal-title fs-5">Modificar contraseña</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="consultasdb/personal.php" method="POST">
                        <input type="hidden" name="operacion" value="modificar_clave">
                        <input type="hidden" id="id_modificar_clave" name="id_modificar">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cambioClave">Nueva contraseña</label>
                                <input type="password" name="clave" class="form-control" id="cambioClave" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="scripts/scriptPersonal.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php include_once 'snippets/mostrarAlerta.php'?>
    </body>
</html>