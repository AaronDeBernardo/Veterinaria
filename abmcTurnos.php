<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';
    $query = "SELECT turnos.id, mascotas.nombre, servicios.nombre, turnos.fecha_hora,   /*Faltaria ver como relacionar turnos.emisor_id si es alguien del personal o es propio*/
        turnos.fecha_hora_turno, turnos.emisor_id, turnos.estado FROM turnos
        INNER JOIN mascotas ON turnos.mascota_id = mascotas.id 
        INNER JOIN servicios ON turnos.servicio_id = servicios.id
        WHERE mascotas.cliente_id = '$_SESSION[cliente_id]'";
    $turnos = consultaSQL($query);
    $queryMascotas = "SELECT mascotas.nombre FROM mascotas WHERE mascotas.cliente_id = '$_SESSION[cliente_id]' AND mascotas.baja != '1' AND mascotas.fecha_muerte = NULL";
    $mascotas = consultaSQL($queryMascotas);
    $queryServicios = "SELECT servicios.nombre, servicios.precio, servicios.tipo_servicio_id, servicios.rango_fechas FROM servicios WHERE servicios.baja != '1'" ;
    $servicios = consultaSQL($queryServicios);
    $queryProfesionales = "SELECT personal.id, personal.apellido FROM personal WHERE personal.rol_id != '1'";
    $profesionales = consultaSQL($queryProfesionales);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="Recursos/logoVeterinaria.png">
    <title>Turnos</title>
</head>
<body>
    <?php
        include_once 'menuSuperior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
        <?php  $_SESSION['item'] = 'misTurnos'; include_once 'menuLateral.php'; ?>
        <div class="col-12 col-md-8 col-lg-9 col-xl-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mascota</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Fecha Pedido</th>
                        <th scope="col">Fecha Turno</th>
                        <th scope="col">Emisor</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            while($row = mysqli_fetch_array($turnos)){
            ?>
                    <tr id=<?php echo "idTurno:$row[id]"?> onclick='getId(this)'>
                        <td name="nombreMascota"><?php echo $row[1] ?></th>
                        <td name="nombreServicio"><?php echo $row[2] ?></td>
                        <td name="fechaPedido"><?php echo $row['fecha_hora'] ?></td>
                        
                        <td name="fechaHoraTurno" ><?php echo $row['fecha_hora_turno'] ?></td>
                        <td name="emisor"><?php echo $row['emisor_id'] ?></td>
                        <td name="estado"><?php echo $row['estado'] ?></td>
                    </tr>
<?php } ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="button" class="btn btn-warning mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalModificarDatos">Nuevo Turno</button>
                    </div>
                </form>
            </div> 
            <div class="modal fade" id="modalModificarDatos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Nuevo Turno</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="consultasdb/misDatos.php" method="POST">
                            <input type="hidden" name="operacion" value="modificar">   
                            <div class="modal-body">
                                <div class="form-group">    
                                    <label>Servicio</label>

                                        <select name="select">
                                        <?php if(!empty($servicios)){
                                                foreach ($servicios as $s){
                                                    echo "<option value=$s[id]>$s[nombre]</option>";
                                                }
                                                }?>
                                                </select><!--SEGUIR ACA, ACORDARSE QUE HICISTE CONSULTAS ARRIBA, FIJATE SI DESPUES LAS TERMINAMOS USANDO-->

                                </div>
                                <div class="form-group">
                                <label>Profesional</label>

                                    <select name="select">
                                        <?php if(!empty($profesionales)){
                                                foreach ($profesionales as $p){
                                                    echo "<option value=$p[id]>$p[apellido]</option>";
                                                }
                                                }?>
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" name="telefono" class="form-control" value="<?php echo $row['telefono'] ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>