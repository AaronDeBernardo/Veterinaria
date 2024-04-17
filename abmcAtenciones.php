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


    $filtro = '';
    if (isset($_GET['mascota_id']) && $_GET['mascota_id'] != 'todos')
        $filtro = $filtro . "AND mascotas.id = '$_GET[mascota_id]' ";
    if (isset($_GET['cliente_id']) && $_GET['cliente_id'] != 'todos')
        $filtro = $filtro . "AND clientes.id = '$_GET[cliente_id]' ";
    if (!empty($_GET['fecha_desde']))
        $filtro = $filtro . "AND DATE(atenciones.fecha_hora) >= '$_GET[fecha_desde]' ";
    if (!empty($_GET['fecha_hasta']))
        $filtro = $filtro . "AND DATE(atenciones.fecha_hora) <= '$_GET[fecha_hasta]' ";
        

    $query = "SELECT atenciones.id, atenciones.mascota_id, mascotas.nombre AS mascota_nombre, mascotas.cliente_id, CONCAT(clientes.apellido, ' ', clientes.nombre) AS duenio, 
        atenciones.servicio_id, servicios.nombre, atenciones.personal_id, CONCAT(personal.apellido, ' ', personal.nombre) AS personal, atenciones.fecha_hora, 
        atenciones.fecha_hora_salida, atenciones.titulo, atenciones.precio, atenciones.descripcion FROM atenciones INNER JOIN mascotas ON mascotas.id = atenciones.mascota_id 
        INNER JOIN servicios ON servicios.id = atenciones.servicio_id INNER JOIN personal ON personal.id = atenciones.personal_id 
        INNER JOIN clientes ON mascotas.cliente_id = clientes.id WHERE 1 = 1 $filtro ORDER BY atenciones.fecha_hora DESC";
    $atenciones = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Veterinaria San Antón</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/styles.css" type="text/css">
        <link rel="stylesheet" href="plugins/chosen/chosen.css">
        <link rel="icon" href="recursos/logoVeterinaria.png">
    </head>
    <body>
        <?php include_once 'snippets/menuSuperior.php' ?>    
    
        <div class="container-fluid">
            <div class="row">
                <?php  $_SESSION['item'] = 'atenciones'; include_once 'snippets/menuLateral.php'; ?>
                
                <div class="col-12 col-md-8 col-lg-9 col-xl-10">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div>
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
                                <label for="fecDesde">Fecha desde</label>
                                <input id="fecDesde" type="date" name="fecha_desde" class="form-control" <?php echo (isset($_GET['fecha_desde']) ? "value=$_GET[fecha_desde]" : "")?>>
                                <label for="fecHasta">Fecha hasta</label>
                                <input id="fecHasta" type="date" name="fecha_hasta" class="form-control" <?php echo (isset($_GET['fecha_hasta']) ? "value=$_GET[fecha_hasta]" : "")?>>
                            </div>

                            <div style="text-align:center; margin-bottom:10px;">
                                <button type="submit" class="btn btn-secondary">Aceptar</button>
                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Fecha y hora</th>
                                <th scope="col">Mascota</th>
                                <th scope="col">Dueño</th>
                                <th scope="col">Servicio</th>
                                <th scope="col" class="d-none d-sm-table-cell">Personal</th>
                                <th scope="col" class="d-none d-sm-table-cell">Título</th>
                                <th style=display:none;>Descripción</th>
                                <th style=display:none;>Fecha y hora de salida</th>
                                <th style=display:none;>Precio</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
                        foreach ($atenciones as $a){
                            echo "<tr id=idAtencion:$a[id] onclick=getId(this) ondblclick=mostrarAtencion() tabindex=0 onkeydown=if(event.key=='Enter'){getId(this)}>";
                                echo "<td>$a[fecha_hora]</td>";
                                echo "<td data-mascota_id=$a[mascota_id]>$a[mascota_nombre]</td>";
                                echo "<td data-cliente_id=$a[cliente_id]>$a[duenio]</td>";
                                echo "<td data-servicio_id=$a[servicio_id]>$a[nombre]</td>";
                                echo "<td data-personal_id=$a[personal_id] class='d-none d-sm-table-cell'>$a[personal]</td>";
                                echo "<td class='d-none d-sm-table-cell'>$a[titulo]</td>";
                                echo "<td style=display:none;>$a[descripcion]</td>";
                                echo "<td style=display:none;>$a[fecha_hora_salida]</td>";
                                echo "<td style=display:none;>$a[precio]</td>";
                            echo "</tr>";
                        }
?>

                        </tbody>
                    </table>

                    <div style="display: inline-block;">
                        <button type="button" class="btn btn-outline-secondary" id="btnVerAtencion" onclick="mostrarAtencion()">Ver atención</button>
                    </div>
                    <div class="colBotones">
                        <button type="button" class="btn btn-outline-success" id="btnAnadirAtencion" onclick="mostrarModalAtencion(this)">Nueva atención</button>
                        <button type="button" class="btn btn-outline-primary" id="btnModificarAtencion" onclick="mostrarModalAtencion(this)">Modificar</button>
                        <button type="button" class="btn btn-outline-danger" id="btnEliminarAtencion" onclick="mostrarModalEliminar(this)">Baja</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="modalAtencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalAtencion" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="labelModalAtencion">Atención</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="consultasdb/atencion.php" method="POST">
                        <input type="hidden" name="operacion">
                        <input type="hidden" name="id_modificar">    
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="select_cliente">Dueño</label>
                                <select id="select_cliente" name="cliente_id" class="form-control chosen-select" required>
                                    <option disabled value=""> -- Selecciona un cliente -- </option>
                                    <?php
                                        foreach ($clientes as $c){
                                            echo "<option value=$c[id]>$c[apeynom]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="select_mascota">Mascota</label>
                                <select id="select_mascota" name="mascota_id" class="form-control chosen-select" required>
                                    <option disabled value="" data-cliente_id=""> -- Selecciona una mascota -- </option>
                                    <?php
                                        foreach ($mascotas as $m){
                                            echo "<option data-cliente_id=$m[cliente_id] value=$m[id]>$m[nombre]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="select_servicio">Servicio</label>
                                <select id="select_servicio" name="servicio_id" class="form-control chosen-select" required>
                                    <option disabled value=""> -- Selecciona un servicio -- </option>
                                    <?php
                                        foreach ($servicios as $s){
                                            echo "<option data-fec_salida=$s[rango_fechas] value=$s[id]>$s[nombre]</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group contenedor_dt">
                                <label for="salidaModal">Fecha y hora de salida</label>
                                <input type="datetime-local" name="fecha_hora_salida" class="form-control" id="salidaModal">
                            </div>

                            <div class="form-group">
                                <label for="tituloModal">Título</label>
                                <input type="text" name="titulo" class="form-control" id="tituloModal" required>
                            </div>
                            <div class="form-group">    
                                <label for="descModal">Descripcion</label>
                                <textarea name="descripcion" rows="5" class="form-control" id="descModal"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="btn_salir">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="btn_enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDatos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalDatos" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="labelModalDatos">Datos atención</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="clienteMD">Dueño</label>
                            <input type="text" name="cliente" class="form-control" id="clienteMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="mascotaMD">Mascota</label>
                            <input type="text" name="mascota" class="form-control" id="mascotaMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="servicioMD">Servicio</label>
                            <input type="text" name="servicio" class="form-control" id="servicioMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="personalMD">Personal</label>
                            <input type="text" name="personal" class="form-control" id="personalMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ateMD">Fecha y hora de atención</label>
                            <input type="text" name="fecha_hora" class="form-control" id="ateMD" disabled>
                        </div>
                        <div class="form-group contenedor_dt">
                            <label for="salidaMD">Fecha y hora de salida</label>
                            <input type="text" name="fecha_hora_salida" class="form-control" id="salidaMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="precioMD">Precio</label>
                            <input type="text" name="precio" class="form-control" id="precioMD" disabled>
                        </div>
                        <div class="form-group">
                            <label for="tituloMD">Título</label>
                            <input type="text" name="titulo" class="form-control" id="tituloMD" disabled>
                        </div>
                        <div class="form-group">    
                            <label for="descMD">Descripcion</label>
                            <textarea name="descripcion" rows="5" class="form-control" id="descMD" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarAtencion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalEliminar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="labelModalEliminar">Eliminar atención</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="consultasdb/atencion.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="operacion" value="eliminar">
                            <input type="hidden" id="id_eliminar" name="id_eliminar" value="0">
                            <div class="form-group">
                                <p>¿Está seguro que desea eliminar la atención seleccionada?</p>
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="plugins/jquery/jquery-3.7.1.min.js"></script>
        <script src="plugins/chosen/chosen.jquery.js"></script>
        <script src="scripts/scriptAtenciones.js"></script>
        <?php include_once 'snippets/mostrarAlerta.php'?>
    </body>
</html>