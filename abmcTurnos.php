<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'connection.php';
    $query = "SELECT turnos.id, mascotas.nombre, servicios.nombre, turnos.fecha_hora,   /*Faltaria ver como relacionar turnos.emisor_id si es alguien del personal o es propio*/
        turnos.fecha_hora_turno, turnos.emisor_id, turnos.estado FROM turnos
        INNER JOIN mascotas ON turnos.mascota_id = mascotas.id 
        INNER JOIN servicios ON turnos.servicio_id = servicios.id
        WHERE mascotas.cliente_id = '$_SESSION[cliente_id]'";
    $turnos = consultaSQL($query);

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
        </div>
    </div>
    </div>

</body>
</html>