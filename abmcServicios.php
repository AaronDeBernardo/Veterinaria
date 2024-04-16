<?php
    session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        die();
    }
    include_once 'consultasdb/connection.php';
    $query = "SELECT servicios.id, servicios.nombre, servicios.tipo_servicio_id, servicios.rango_fechas, tipos_servicios.nombre AS tipo, servicios.precio 
        FROM servicios INNER JOIN tipos_servicios ON servicios.tipo_servicio_id = tipos_servicios.id WHERE baja = 0 ORDER BY servicios.nombre";
    $resultados = consultaSQL($query);
    $query = "SELECT id, nombre FROM tipos_servicios;";
    $tipos_servicios = consultaSQL($query);
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
                <?php  $_SESSION['item'] = 'servicios'; include_once 'menuLateral.php'; ?>
                <div class="col-12 col-md-8 col-lg-9 col-xl-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Rango de fechas</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    while($row = mysqli_fetch_array($resultados)){
        ?>
                            <tr <?php echo "id=servicio_id:$row[id]" ?> onclick='getId(this)'>
                                <?php echo "<td>$row[nombre]</td>" ?>
                                <?php echo "<td data-tipo_id=$row[tipo_servicio_id]>$row[tipo]" ?></td>
                                <?php echo "<td>$row[precio]</td>"?>
                                <?php echo $row['rango_fechas'] ? '<td data-check_fechas=1>Sí</td>' : '<td data-check_fechas=0>No</td>' ?>
                            </tr>
<?php } ?>
                            
                        </tbody>
                    </table>

                    <div class="row colBotones">
                        <div class="col-12">
                            <button type="button" id="btnAnadirServ" class="btn btn-outline-success" onclick="mostrarModalServicio(this)">
                                Nuevo servicio
                            </button>
                            <button type="button" id="btnModificarServ" class="btn btn-outline-primary" onclick="mostrarModalServicio(this)">
                                Modificar
                            </button>
                            <button type="button" id="btnEliminarServ" class="btn btn-outline-danger" onclick="mostrarModalEliminar(this)">
                                Baja
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modals -->
        <div class="modal fade" id="modalServicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalServicio" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 id="labelModalServicio" class="modal-title fs-5">Servicio</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="consultasdb/servicio.php" method="POST">
                        <input type="hidden" name="operacion">
                        <input type="hidden" name="id_modificar">    
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
                                <select name="tipo_servicio_id" class="form-select" required>
                                    <option value=""> -- Seleccione un tipo -- </option>
                                <?php
                                    foreach ($tipos_servicios as $t){
                                        echo "<option value=$t[id]>$t[nombre]</option>";
                                    }
                                ?>

                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="rango_fechas" id="checkFechas" value="1">
                                <label class="form-check-label" for="checkFechas">Con rango de fechas</label>
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
                            <h1 id="labelModalEliminar" class="modal-title fs-5">Eliminar servicio</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="consultasdb/servicio.php" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="operacion" value="eliminar">
                                <input type="hidden" id="id_eliminar" name="id_eliminar">
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

        
            <script src="./scriptServicios.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>