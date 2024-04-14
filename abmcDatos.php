<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';
    $query = "SELECT clientes.id, clientes.nombre, clientes.apellido, clientes.email,   /*Faltaria ver como relacionar turnos.emisor_id si es alguien del personal o es propio*/
        clientes.clave, clientes.ciudad, clientes.direccion, clientes.telefono FROM clientes
        WHERE clientes.id = '$_SESSION[cliente_id]'";
    $datosPersonales = consultaSQL($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="Recursos/logoVeterinaria.png">
    <title>Mis Datos</title>
</head>
<body>
    <?php
        include_once 'menuSuperior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php  $_SESSION['item'] = 'misDatos';?>
            
            <?php include_once 'menuLateral.php';
            $row = mysqli_fetch_array($datosPersonales); ?>
            <div class="col-md-1 col-lg-1 col-xl-2 d-none d-md-block"></div>
            <div class="col-12 col-md-5 col-lg-6 col-xl-6 bg-light rounded-5  pt-4 mt-2 flex-wrap border border-warning border-4 "> <!--ACOMODAR MARGIN , CUANDO SE COLOCA EL MISMO SE ENDIABLA LA PAGINA -->
            
                <form class="row g-2" action="" method="post">
                    <h1 class="text-secondary border-bottom border-warning border-5">Mis Datos</h1>
                    <div class="col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php echo $row['nombre'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="surname">Apellido</label>
                        <input type="text" class="form-control" id="surname" placeholder="Apellido" value="<?php echo $row['apellido'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" value="<?php echo $row['ciudad'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" placeholder="Dirección" value="<?php echo $row['direccion'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control" id="mail" placeholder="Email" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="cel">Teléfono</label>
                        <input type="number" class="form-control" id="cel" placeholder="Teléfono" value="<?php echo $row['telefono'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="pass">Contraseña</label>
                        <input type="password" class="form-control" id="pass" placeholder="Contraseña" value="<?php echo $row['clave'] ?>"> <!-- MANDA LA CONTRASEÑA ENCRIPTADA-->
                    </div>


                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-warning mb-4 mt-2">Modificar Datos</button>
                    </div>
                </form>
            </div>
            

            
        </div>
    </div>

</body>
</html>