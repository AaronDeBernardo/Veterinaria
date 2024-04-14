<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';
    $query = "SELECT servicios.id, servicios.nombre, servicios.rango_fechas FROM servicios INNER JOIN roles_tiposservicios 
        ON servicios.tipo_servicio_id = roles_tiposservicios.tipo_servicio_id WHERE roles_tiposservicios.rol_id = '$_SESSION[rol_id]' AND baja = 0 ORDER BY servicios.nombre";
    $servicios = consultaSQL($query);
    
    $query = "SELECT id, CONCAT(apellido, ' ', nombre) AS apeynom FROM clientes WHERE baja = 0 ORDER BY apeynom";
    $clientes = consultaSQL($query);

    $query = "SELECT id, cliente_id, nombre FROM mascotas WHERE ISNULL(fecha_muerte) AND baja = 0 ORDER BY nombre";
    $mascotas = consultaSQL($query);

    $query = "SELECT atenciones.id, atenciones.mascota_id, mascotas.nombre AS mascota_nombre, mascotas.cliente_id, CONCAT(clientes.apellido, ' ', clientes.nombre) AS duenio, atenciones.servicio_id, 
        servicios.nombre, atenciones.personal_id, CONCAT(personal.apellido, ' ', personal.nombre) AS personal, atenciones.fecha_hora, atenciones.fecha_hora_salida, 
        atenciones.titulo, atenciones.precio FROM atenciones INNER JOIN mascotas ON mascotas.id = atenciones.mascota_id INNER JOIN servicios ON servicios.id = atenciones.servicio_id 
        INNER JOIN personal ON personal.id = atenciones.personal_id INNER JOIN clientes ON mascotas.cliente_id = clientes.id ORDER BY atenciones.fecha_hora DESC";
    $atenciones = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Veterinaria San Antón</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" type="text/css">
        <link rel="stylesheet" href="stylesAtenciones.css" type="text/css">
        <link rel="stylesheet" href="plugins/chosen/chosen.css">
        <link rel="icon" href="Recursos/logoVeterinaria.png">
    </head>
    <body id="body-secretaria">
        <?php include_once 'menuSuperior.php' ?>    
    
        <div class="container-fluid">
            <div class="row">
                <?php  $_SESSION['item'] = 'atenciones'; include_once 'menuLateral.php'; ?>
                
                <div class="col-12 col-md-8 col-lg-9 col-xl-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Fecha y hora</th>
                                <th scope="col">Mascota</th>
                                <th scope="col">Dueño</th>
                                <th scope="col">Servicio</th>
                                <th scope="col">Personal</th>
                                <th scope="col">Título</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
                        while($a = mysqli_fetch_array($atenciones)){
                            echo "<tr id=idAtencion:$a[id] onclick=getId(this)>";
                                echo "<td name=fechaHora>$a[fecha_hora]</td>";
                                echo "<td id=idMascota:$a[mascota_id]>$a[mascota_nombre]</td>";
                                echo "<td id=idDuenio:$a[cliente_id]>$a[duenio]</td>";
                                echo "<td id=idServicio:$a[servicio_id]>$a[nombre]</td>";
                                echo "<td id=idPersonal:$a[personal_id]>$a[personal]</td>";
                                echo "<td name=titulo>$a[titulo]</a>";
                            echo "</tr>";
                        }
?>

                        </tbody>
                    </table>
                    <div class="colBotones" style="margin-top:25px;">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAnadirAtencion">Nueva atención</button>
                        <button type="button" class="btn btn-outline-primary" id="btnModificarAtencion" onclick="mostrarModal(this)">Modificar</button>
                        <button type="button" class="btn btn-outline-danger" id="btnEliminarAtencion" onclick="mostrarModal(this)">Baja</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="modalAnadirAtencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Nueva atención</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="consultasdb/atencion.php" method="POST">
                        <input type="hidden" name="operacion" value="insertar">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label>Dueño</label>
                                <select id="select_cliente" name="cliente_id" class="form-control chosen-select" required>
                                    <option disabled selected value=""> -- Selecciona un cliente -- </option>
                                    <?php
                                        foreach ($clientes as $c){
                                            echo "<option value=$c[id]>$c[apeynom]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mascota</label>
                                <select id="select_mascota" name="mascota_id" class="form-control chosen-select" required>
                                    <option disabled selected value=""> -- Selecciona una mascota -- </option>
                                    <?php
                                        foreach ($mascotas as $m){
                                            echo "<option id=cliente_id:$m[cliente_id] value=$m[id]>$m[nombre]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Servicio</label>
                                <select id="select_servicio" name="servicio_id" class="form-control chosen-select" required>
                                    <option disabled selected value=""> -- Selecciona un servicio -- </option>
                                    <?php
                                        foreach ($servicios as $s){
                                            echo "<option id=fec_salida:$s[rango_fechas] value=$s[id]>$s[nombre]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div id="cont_dt_agregar" class="form-group" style="display:none;">
                                <label>Fecha y hora de salida</label>
                                <input id="dt_agregar" type="datetime-local" name="fecha_hora_salida" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="form-group">    
                                <label>Descripcion</label>
                                <textarea name="descripcion" rows="5" class="form-control"></textarea>
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
                    <form action="consultasdb/atencion.php" method="POST">
                        <input type="hidden" name="operacion" value="modificar">
                        <input type="hidden" id="idModificar" name="idModificar" value="0">    
                        <div class="modal-body">
                            
                            





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarAtencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Eliminar atención</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="consultasdb/atencion.php" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="operacion" value="eliminar">
                                <input type="hidden" id="id_eliminar" name="id_eliminar" value="0">
                                <div class="form-group">
                                    <label>¿Está seguro que desea eliminar la atención seleccionada?</label>
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
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="plugins/jquery/jquery-3.7.1.min.js"></script>
        <script src="plugins/chosen/chosen.jquery.js"></script>
        <script src="./scriptAtenciones.js"></script>
    </body>
</html>