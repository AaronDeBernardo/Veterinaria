<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';
    $filtro = '';
    
    if (isset($_GET['cliente_id']) && $_GET['cliente_id'] != 'todos')
        $filtro = "AND cliente_id = '$_GET[cliente_id]'";
    if (isset($_GET['mascota_id']) && $_GET['mascota_id'] != 'todos')
        $filtro = $filtro . " AND mascotas.id = '$_GET[mascota_id]'";
    if (isset($_GET['estadoMascota']))
        $filtro = $filtro . " AND ISNULL(fecha_muerte)";
    
    $query = "SELECT mascotas.id, mascotas.cliente_id, CONCAT(clientes.apellido, ' ', clientes.nombre) AS duenio, mascotas.nombre, mascotas.foto, 
        mascotas.raza, mascotas.color, mascotas.fecha_de_nac, mascotas.fecha_muerte FROM mascotas 
        INNER JOIN clientes ON mascotas.cliente_id = clientes.id WHERE mascotas.baja = 0 $filtro ORDER BY duenio";
    $mascotas = consultaSQL($query);

    $query = "SELECT id, CONCAT(apellido, ' ', nombre) AS apeynom FROM clientes ORDER BY apeynom";
    $clientes = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria San Antón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <link rel="stylesheet" href="styles/stylesMascotas.css" type="text/css">
    <link rel="stylesheet" href="plugins/chosen/chosen.css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
</head>
<body>
    <?php include_once 'snippets/menuSuperior.php' ?>    

    <div class="container-fluid p-0">
        <div class="row">
            <?php $_SESSION['item'] = 'mascotas'; include_once 'snippets/menuLateral.php'; ?>
            
            <div class="col-12 col-md-4 col-lg-5 col-xl-4 mt-3">
                
                <div id="div-filtro">
                    <button type="button" class="btn btn-secondary" style="margin-bottom:10px" data-bs-toggle="collapse" data-bs-target="#formFiltro">Filtrar</button>
                    <?php echo $filtro ? "<button type=button class='btn btn-secondary' style=margin-bottom:10px onclick=borrarFiltros()>Borrar filtros</button>" : null ?>
                </div>

                <form action="#" method="GET" id="formFiltro" class="collapse bg-light rounded-5 pt-4 mt-2 flex-wrap border border-warning border-4" style="margin-bottom:20px">
                    <div class="form-group">
                        <label for="select_mascota_filtro">Mascota</label>
                        <select id="select_mascota_filtro" name="mascota_id" class="form-control chosen-select">
                            <option selected value="todos"> -- Todas las mascotas -- </option>
                            <?php
                                foreach ($mascotas as $m)
                                    echo "<option " . (isset($_GET['mascota_id']) && $_GET['mascota_id'] == $m['id'] ? "selected " : "") . "value=$m[id]>$m[nombre]</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select_cliente_filtro">Dueño de la mascota</label>
                        <select id="select_cliente_filtro" name="cliente_id" class="form-control chosen-select">
                            <option selected value="todos"> -- Todos los clientes -- </option>
                            <?php
                                foreach ($clientes as $c)
                                    echo "<option " . (isset($_GET['cliente_id']) && $_GET['cliente_id'] == $c['id'] ? "selected " : "") . "value=$c[id]>$c[apeynom]</option>";
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="estadoMascota" value="vivas" id="checkMascotas" <?php echo isset($_GET['estadoMascota']) ? "checked" : "" ?>>
                        <label for="checkMascotas">Sólo mascotas vivas</label>
                    </div>
                    <div style="text-align:center; margin-bottom:10px;">
                        <button type="submit" class="btn btn-secondary">Aceptar</button>
                    </div>
                </form>

                <div id="div_tabla">
                    <table class="table">
                        <thead class="border-3 border-warning">
                            <tr>
                                <th>Dueño</th>
                                <th>Mascota</th>
                                <th>Raza</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody class="border-3 border-warning">
<?php
    foreach ($mascotas as $m){
?>
                            <?php echo "<tr id=idMascota:$m[id] onclick=getId(this) tabindex=0 onkeydown=\"if(event.key=='Enter'){getId(this)}\">"?>
                                <?php echo "<td data-cliente_id=$m[cliente_id]>$m[duenio]</td>" ?>
                                <td><?php echo $m['nombre'] ?></td>
                                <td><?php echo $m['raza'] ?></td>
                                <td><?php echo $m['color'] ?></td>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="colBotones" style="margin-top:16px;">
                    <button type="button" class="btn btn-outline-success" id="btnAnadirMascota" onclick="mostrarModalMascota(this)">Nueva mascota</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModificarMascota" onclick="mostrarModalMascota(this)">Modificar</button>
                    <button type="button" class="btn btn-outline-danger" id="btnEliminarMascota" onclick="mostrarModalEliminar(this)">Baja</button>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-5 mt-3">
                <div id="div-separacion">&nbsp;</div>
                <div class="tab-content" id="nav-tabContent">
                <?php
                foreach ($mascotas as $m){
                    echo "<div class='tab-pane fade tarjeta_mascota' role=tabpanel id=list-mascota:$m[id] data-fecha_de_nac=$m[fecha_de_nac]" . (!empty($m['fecha_muerte']) ? " data-fecha_muerte=$m[fecha_muerte]>" : ">");
                        echo "<div class=card>";
                        if (!empty($m['foto'])){
                        ?>
                            <img class='card-img-top' src="data:image/jpeg;base64,<?php echo base64_encode($m['foto'])?>" <?php echo "alt='Foto de $m[nombre]'"?>>
                        <?php
                        }
                            echo "<div class=card-body>";
                                if (empty($m['foto']))
                                    echo "<p class=card-text>La mascota no tiene foto</p>";

                                echo '<p class=card-text>Fecha de nacimiento: ' . date("d/m/Y", strtotime($m['fecha_de_nac'])) . '</p>';
                                if (!empty($m['fecha_muerte']))
                                    echo '<p class=card-text>Fecha de muerte: ' . date("d/m/Y", strtotime($m['fecha_muerte'])) . '</p>';

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
    <div class="modal fade" id="modalMascota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalMascota" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="labelModalMascota" class="modal-title fs-5">Mascota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="consultasdb/mascota.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="operacion">
                    <input type="hidden" name="id_modificar">    
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="clienteModal">Dueño</label>
                            <select name="cliente_id" class="form-select chosen-select" id="clienteModal" required>
                                <option disabled value=""> -- Selecciona un cliente -- </option>
                            <?php
                                foreach ($clientes as $c)
                                    echo "<option value=$c[id]>$c[apeynom]</option>";
                            ?>
                            </select>
                        </div>
                        <div class="form-group">    
                            <label for="nombreModal">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombreModal" required>
                        </div>
                        <div class="form-group">    
                            <label for="razaModal">Raza</label>
                            <input type="text" name="raza" class="form-control" id="razaModal" required>
                        </div>
                        <div class="form-group">    
                            <label for="colorModal">Color</label>
                            <input type="text" name="color" class="form-control" id="colorModal" required>
                        </div>
                        <div class="form-group">    
                            <label for="nacModal">Fecha de nacimiento</label>
                            <input type="date" name="fecha_de_nac" class="form-control" id="nacModal" required>
                        </div>

                        <div class="form-group" id="div_fecha_muerte">    
                            <label for="muerteModal">Fecha de muerte</label>
                            <input type="date" name="fecha_muerte" class="form-control" id="muerteModal">
                        </div>

                        <div class="form-group">
                            <label for="fotoModal" id="label_foto_modal">Foto</label><br>
                            <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg" id="fotoModal"><br>
                            <small class="form-text text-muted">El tamaño máximo es de 16MB</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button name="btn_enviar" type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminarMascota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalEliminar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="labelModalEliminar" class="modal-title fs-5">Eliminar mascota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="consultasdb/mascota.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="operacion" value="eliminar">
                        <input type="hidden" id="id_eliminar" name="id_eliminar" value="0">
                        <div class="form-group">
                            <p>¿Está seguro que desea eliminar la mascota seleccionada?</p>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="plugins/jquery/jquery-3.7.1.min.js"></script>
    <script src="plugins/chosen/chosen.jquery.js"></script>
    <script src="scripts/scriptMascotas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include_once 'snippets/mostrarAlerta.php'?>
</body>
</html>