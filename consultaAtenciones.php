<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';

    $filtroM = '';
    if (isset($_POST['soloMascotasVivas']))
    {
        if ($_POST['soloMascotasVivas'] == 'vivas'){
            setcookie('soloMascotasVivas', true, time() + (60 * 60 * 24 * 365 * 5), "/");
            $filtroM = "AND ISNULL(fecha_muerte)";
        }
        else{
            unset($_COOKIE['soloMascotasVivas']);
            setcookie('soloMascotasVivas', '', time() - 3600, '/');
        }
    }
    else if (isset($_COOKIE['soloMascotasVivas']))
        $filtroM = "AND ISNULL(fecha_muerte)";

    
    $filtroA = $filtroM;

    if (isset($_POST['mascota_id']) && $_POST['mascota_id'] != 'todos')
        $filtroA = $filtroA . " AND mascotas.id = '$_POST[mascota_id]'";
    if (!empty($_POST['fecha_desde']))
        $filtroA = $filtroA . " AND DATE(atenciones.fecha_hora) >= '$_POST[fecha_desde]'";
    if (!empty($_POST['fecha_hasta']))
        $filtroA = $filtroA . " AND DATE(atenciones.fecha_hora) <= '$_POST[fecha_hasta]'";

    
    $query = "SELECT id, nombre FROM mascotas WHERE cliente_id = $_SESSION[cliente_id] AND baja = 0 $filtroM ORDER BY nombre";
    $mascotas = consultaSQL($query);

    $query = "SELECT atenciones.id, mascotas.nombre AS mascota_nombre, servicios.nombre, CONCAT(personal.apellido, ' ', personal.nombre) AS personal, atenciones.fecha_hora, 
        atenciones.fecha_hora_salida, atenciones.titulo, atenciones.precio, atenciones.descripcion FROM atenciones INNER JOIN mascotas ON mascotas.id = atenciones.mascota_id 
        INNER JOIN servicios ON servicios.id = atenciones.servicio_id INNER JOIN personal ON personal.id = atenciones.personal_id 
        INNER JOIN clientes ON mascotas.cliente_id = clientes.id WHERE mascotas.cliente_id = $_SESSION[cliente_id] $filtroA ORDER BY atenciones.fecha_hora DESC";
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
        <link rel="icon" href="recursos/logoVeterinaria.png">
    </head>
    <body>
        <?php include_once 'snippets/menuSuperior.php' ?>    
   
        <div class="container-fluid p-0">
            <div class="row">
                <?php  $_SESSION['item'] = 'atenciones'; include_once 'snippets/menuLateral.php'; ?>
                
                <div class="col-12 col-md-7 col-lg-8 col-xl-9 mt-3">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div>
                            <button type="button" class="btn btn-secondary" style="margin-bottom:10px" data-bs-toggle="collapse" data-bs-target="#formFiltro">Filtrar</button>
                            <?php echo $filtroM != $filtroA ? "<button type=button class='btn btn-secondary' style=margin-bottom:10px onclick=borrarFiltros()>Borrar filtros</button>" : null ?>
                        </div>

                        <form action="#" method="POST" id="formFiltro" class="collapse bg-light rounded-5 pt-4 mt-2 flex-wrap border border-warning border-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label for="select_mascota_filtro">Mascota</label>
                                <select id="select_mascota_filtro" name="mascota_id" class="form-select">
                                    <option selected value="todos"> -- Todas las mascotas -- </option>
                                    <?php
                                        foreach ($mascotas as $m)
                                            echo "<option " . (isset($_POST['mascota_id']) && $_POST['mascota_id'] == $m['id'] ? "selected " : "") . "value=$m[id]>$m[nombre]</option>";
                                    ?>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label for="fecha_desde">Fecha desde</label>
                                <input type="date" name="fecha_desde" id="fecha_desde"class="form-control" <?php echo (isset($_POST['fecha_desde']) ? "value=$_POST[fecha_desde]" : "")?>>
                                <label for="fecha_hasta">Fecha hasta</label>
                                <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" <?php echo (isset($_POST['fecha_hasta']) ? "value=$_POST[fecha_hasta]" : "")?>>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="soloMascotasVivas" value="todas">
                                <input type="checkbox" name="soloMascotasVivas" value="vivas" id="checkMascotas" <?php echo $filtroM ? "checked" : "" ?>>
                                <label for="checkMascotas">Sólo mascotas vivas</label>
                            </div>
                            <div style="text-align:center; margin-bottom:10px;">
                                <button type="submit" class="btn btn-secondary">Aceptar</button>
                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <thead class="border-3 border-warning">
                            <tr>
                                <th scope="col">Fecha y hora</th>
                                <th scope="col">Mascota</th>
                                <th scope="col">Servicio</th>
                                <th scope="col" class="d-none d-sm-table-cell">Personal</th>
                                <th scope="col" class="d-none d-sm-table-cell">Título</th>
                                <th style=display:none;>Descripción</th>
                                <th style=display:none;>Salida</th>
                                <th style=display:none;>Precio</th>
                            </tr>
                        </thead>
                        <tbody class="border-3 border-warning">

<?php
                        foreach ($atenciones as $a){
                            echo "<tr id=idAtencion:$a[id] onclick=getId(this) ondblclick=mostrarAtencion() tabindex=0 onkeydown=if(event.key=='Enter'){getId(this)}>";
                                echo "<td>$a[fecha_hora]</td>";
                                echo "<td>$a[mascota_nombre]</td>";
                                echo "<td>$a[nombre]</td>";
                                echo "<td class='d-none d-sm-table-cell'>$a[personal]</td>";
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
                        <button type="button" class="btn btn-primary" id="btnVerAtencion" onclick="mostrarAtencion()">Ver atención</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInforme">Informe gastos</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="modalDatos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalDatos" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="labelModalDatos">Datos atención</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mascota">Mascota</label>
                            <input type="text" name="mascota" id="mascota" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="servicio">Servicio</label>
                            <input type="text" name="servicio" id="servicio" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="personal">Personal</label>
                            <input type="text" name="personal" id="personal" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="fecha_hora_atencion">Fecha y hora de atención</label>
                            <input type="text" name="fecha_hora" id="fecha_hora_atencion"class="form-control" disabled>
                        </div>
                        <div class="form-group contenedor_dt">
                            <label for="fecha_hora_salida">Fecha y hora de salida</label>
                            <input type="text" name="fecha_hora_salida" id="fecha_hora_salida" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" name="precio" id="precio" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo"  class="form-control" disabled>
                        </div>
                        <div class="form-group">    
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="5" class="form-control" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalInforme" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalInforme" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="labelModalInforme">Solicitar informe gastos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="snippets/enviarMail.php" method="POST">
                        <input type="hidden" name="operacion" value="informeGastos">
                        <div class="modal-body">
                            <p>El informe llegará a su casilla de correo electrónico</p>
                            <div class="form-group">
                                <label for="mes">Mes seleccionado</label>
                                <input type="month" id="mes" name="mes" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="scripts/scriptConsultaAtenciones.js"></script>

    </body>
</html>