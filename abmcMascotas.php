<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'connection.php';
    $filtro = '';
    
    if (isset($_GET['idCliente']) && $_GET['idCliente'] != 'todos')
        $filtro = "AND cliente_id = '$_GET[idCliente]'";
    if (isset($_GET['filtro']))
        $filtro = $filtro . " AND mascotas.nombre LIKE '%$_GET[filtro]%'";
    if (isset($_GET['estadoMascota']) && $_GET['estadoMascota'] == 'vivas')
        $filtro = $filtro . " AND ISNULL(fecha_muerte)";
    
    $query = "SELECT mascotas.id, mascotas.cliente_id, CONCAT(clientes.apellido, ' ', clientes.nombre) AS duenio, mascotas.nombre, mascotas.foto, 
        mascotas.raza, mascotas.color, mascotas.fecha_de_nac, mascotas.fecha_muerte FROM mascotas 
        INNER JOIN clientes ON mascotas.cliente_id = clientes.id WHERE mascotas.baja = 0 $filtro ORDER BY duenio";
    $mascotas = consultaSQL($query);

    $query = "SELECT id, CONCAT(apellido, ' ', nombre) AS nomyape FROM clientes ORDER BY nomyape";
    $clientes = consultaSQL($query);
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
            <?php include 'menuLateral.php' ?>
            <div class="col-12 col-md-4 col-lg-5 col-xl-4">
                
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#formFiltro">Filtrar resultados</button>
                </div>

                <form action="" method="GET" class="collapse" id="formFiltro">
                    <div class="form-group">
                        <label>Buscar mascota</label>
                        <input type="search" name="filtro" class="form-control" value=<?php echo $var = $_GET['filtro'] ?? '';?>>
                        <small class="form-text text-muted">Presione enter para filtrar las mascotas.</small>
                    </div>
                    <div class="form-group">
                        <label>Dueño de la mascota</label>
                        <select name="idCliente" class="form-control">
                            <option selected value="todos"> -- Todos los clientes -- </option>
                            <?php
                                while ($c = mysqli_fetch_array($clientes))
                                    echo "<option value=$c[id]>$c[nomyape]</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="estadoMascota" value="vivas" id="checkMascotas">
                        <label for="checkMascotas">Sólo mascotas vivas</label>
                    </div>
                    <button type="submit" class="btn btn-secondary">Aceptar</button>
                    <button type="button" class="btn btn-secondary" onclick="borrarFiltros()">Borrar los filtros</button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Dueño</th>
                            <th>Nombre mascota</th>
                            <th>Raza</th>
                            <th>Color</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    while($m = mysqli_fetch_array($mascotas)){
?>
                        <tr id=<?php echo "idMascota:$m[id]"?> onclick='getId(this)'>
                            <td name="cliente" id=<?php echo "idCliente:$m[cliente_id]>$m[duenio]" ?></td>
                            <td name="nombre"><?php echo $m['nombre'] ?></td>
                            <td name="raza"><?php echo $m['raza'] ?></td>
                            <td name="color"><?php echo $m['color'] ?></td>
                        </tr>
<?php } ?>
                    </tbody>
                </table>
                
                <div class="colBotones" style="margin-top:25px;">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAnadirMascota">Nueva mascota</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModificarMascota" onclick="mostrarModal(this)">Modificar</button>
                    <button type="button" class="btn btn-outline-danger" id="btnEliminarMascota" onclick="mostrarModal(this)">Baja</button>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-6">
                <div class="tab-content" id="nav-tabContent">
                <?php
                mysqli_data_seek($mascotas, 0);
                while($m = mysqli_fetch_array($mascotas)){
                    echo "<div class='tab-pane fade' id=list-mascota:$m[id] role=tabpanel aria-labelledby=list-profile-list>";
                        echo "<div class=card>";
                        if (!empty($m['foto']))
                            echo "<img src=data:image/jpeg;base64," . base64_encode($m['foto']) . " class=card-img-top alt='Foto de $m[nombre]'>";

                            echo "<div class=card-body>";
                                if (empty($m['foto']))
                                    echo "<p class=card-text>La mascota no tiene foto</p>";

                                echo "<p class=card-text name=fecha_de_nac>Fecha de nacimiento: $m[fecha_de_nac]</p>";
                                if (!empty($m['fecha_muerte']))
                                    echo "<p class=card-text name=fecha_muerte>Fecha de muerte: $m[fecha_muerte]</p>";

                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                ?>

                </div>
            </div>
        </div>
    </div>





    <!-- Modals -->
    <div class="modal fade" id="modalAnadirMascota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Nueva mascota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="operacionesDB.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="operacion" value="insertarMascota">
                    <div class="modal-body">
                        
                        <div class="form-group">    
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Dueño</label>
                            <select name="cliente_id" class="form-control" required>
                                <option disabled selected> -- Selecciona un cliente -- </option>

                            <?php
                                foreach ($clientes as $c){
                                    echo "<option value=$c[id]>$c[nomyape]</option>";
                                }
                            ?>

                            </select>
                        </div>

                        <div class="form-group">    
                            <label>Raza</label>
                            <input type="text" name="raza" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Fecha de nacimiento</label>
                            <input type="date" name="fecha_de_nac" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg"><br>
                            <small class="form-text text-muted">El tamaño máximo es de 16MB</small>
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

    <div class="modal fade" id="modalModificarMascota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Modificar cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="operacionesDB.php" method="POST">
                    <input type="hidden" name="operacion" value="modificarCliente">
                    <input type="hidden" id="idModificar" name="idModificar" value="0">    
                    <div class="modal-body">
                        
                        <div class="form-group">    
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Dueño</label>
                            <select name="cliente_id" class="form-control" required>
                                <option disabled selected> -- Selecciona un cliente -- </option>

                            <?php
                                foreach ($clientes as $c){
                                    echo "<option value=$c[id]>$c[nomyape]</option>";
                                }
                            ?>

                            </select>
                        </div>

                        <div class="form-group">    
                            <label>Raza</label>
                            <input type="text" name="raza" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Fecha de nacimiento</label>
                            <input type="date" name="fecha_de_nac" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label>Fecha de muerte</label>
                            <input type="date" name="fecha_muerte" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg"><br>
                            <small class="form-text text-muted">El tamaño máximo es de 16MB</small>
                        </div>




                        <div class="form-group" id="foto_existente">
                            <label>Foto existente</label>
                            <img name="foto_existente" src="" alt="" >
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

    <div class="modal fade" id="modalEliminarMascota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Eliminar mascota</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="operacionesDB.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="operacion" value="eliminarMascota">
                            <input type="hidden" id="idEliminar" name="idEliminar" value="0">
                            <div class="form-group">
                                <label>¿Está seguro que desea eliminar la mascota seleccionada?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar mascota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./scriptMascotas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>