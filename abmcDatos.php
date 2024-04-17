<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }

    include_once 'consultasdb/connection.php';
    $query = "SELECT clientes.id, clientes.nombre, clientes.apellido, clientes.email,  
        clientes.ciudad, clientes.direccion, clientes.telefono FROM clientes
        WHERE clientes.id = '$_SESSION[cliente_id]'";
    $datosPersonales = consultaSQL($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
    <title>Mis Datos</title>
</head>
<body>
    <?php
        include_once 'snippets/menuSuperior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php  $_SESSION['item'] = 'misDatos';?>
            
            <?php include_once 'snippets/menuLateral.php';
            $row = mysqli_fetch_array($datosPersonales); ?>
            <div class="col-md-1 col-lg-1 col-xl-2 d-none d-md-block"></div>
            <div class="col-12 col-md-5 col-lg-6 col-xl-6 bg-light rounded-5  pt-4 mt-2 flex-wrap border border-warning border-4 "> <!--ACOMODAR MARGIN , CUANDO SE COLOCA EL MISMO SE ENDIABLA LA PAGINA -->
            
                <form class="row g-2" action="" method="post">
                    <h1 class="text-secondary border-bottom border-warning border-5">Mis Datos</h1>
                    <div class="col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php echo $row['nombre'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="surname">Apellido</label>
                        <input type="text" class="form-control" id="surname" placeholder="Apellido" value="<?php echo $row['apellido'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="city">Ciudad</label>
                        <input type="text" class="form-control" id="city" placeholder="Ciudad" value="<?php echo $row['ciudad'] ?>" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" placeholder="Dirección" value="<?php echo $row['direccion'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control" id="mail" placeholder="Email" value="<?php echo $row['email'] ?>"disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="cel">Teléfono</label>
                        <input type="number" class="form-control" id="cel" placeholder="Teléfono" value="<?php echo $row['telefono'] ?>"disabled>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#modalModificarContraseña">Cambiar Contraseña</button>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="button" class="btn btn-warning mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalModificarDatos">Modificar Datos</button>
                    </div>
                </form>
            </div> 
            <div class="modal fade" id="modalModificarDatos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Modificar Datos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="consultasdb/misDatos.php" method="POST">
                            <input type="hidden" name="operacion" value="modificar">
                            <input type="hidden" id="idModificar" name="idModificar" value="<?php echo $_SESSION['cliente_id']?>">    
                            <div class="modal-body">
                                <div class="form-group">    
                                    <label>Ciudad</label>
                                    <input type="text" name="ciudad" class="form-control" value="<?php echo $row['ciudad'] ?>"  required>
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" class="form-control" value="<?php echo $row['direccion'] ?>"  required>
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


            <div class="modal fade" id="modalModificarContraseña" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Modificar Contraseña</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="consultasdb/misDatos.php" id="formularioContraseña" onsubmit="return validarClave()" method="POST">
                            <input type="hidden" name="operacion" value="modificarClave">
                            <input type="hidden" id="idModificar" name="idModificar" value="<?php echo $_SESSION['cliente_id']?>"> 
                            <div class="modal-body">
                                <div class="form-group">  
                                    <label>Contraseña Actual</label>
                                    <input type="password" name="claveActual" id="claveActual"class="form-control" required>
                                </div>
                                <div class="form-group">  
                                    <label>Nueva Contraseña</label>
                                    <input type="password" name="claveNueva" id="claveNueva" class="form-control" required>
                                </div>
                                <div class="form-group">  
                                    <label>Repetir Nueva Contraseña</label>
                                    <input type="password" name="claveRepetida" id="claveRepetida" class="form-control" required>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="scripts/scriptMisDatos.js"></script>
    <?php include_once 'snippets/mostrarAlerta.php'?>
</body>
</html>