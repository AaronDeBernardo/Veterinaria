<?php
    if (!isset($_SESSION))
        session_start();
    if (!empty($_SESSION['rol']))
    {
        header('Location: abmcAtenciones.php');
        die();
    }
        
    
    include_once 'consultasdb/connection.php';
    
    if (isset($_POST['email']) && isset($_POST['password'])){
        $query = "SELECT personal.id, roles.nombre, roles.id FROM personal INNER JOIN roles ON personal.rol_id = roles.id WHERE email = '$_POST[email]' AND clave = '" . md5($_POST['password']) . "'";      
        $resultados = consultaSQL($query);
        
        if (mysqli_num_rows($resultados) != 0){
            $aux = mysqli_fetch_array($resultados);
            $_SESSION['personal_id'] = $aux[0];
            $_SESSION['rol'] = $aux[1];
            $_SESSION['rol_id'] = $aux[2];
            header('Location: abmcAtenciones.php');
            die();
        }
        
        $query = "SELECT id FROM clientes WHERE email = '$_POST[email]' AND clave = '" . md5($_POST['password']) . "'";
        $resultados = consultaSQL($query);
        $aux = mysqli_fetch_array($resultados);

        if (!empty($aux[0])){
            $_SESSION['cliente_id'] = $aux[0];
            $_SESSION['rol'] = 'cliente';
            header('Location: abmcTurnos.php');
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Veterinaria San Antón</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css?v=" type="text/css">
        <link rel="icon" href="Recursos/logoVeterinaria.png">
    </head>

    <body>
        
<?php
    include_once 'menuSuperior.php';
?>

        <div class="container">
            <div class="row">
            <?php
                $files = glob('Recursos/Publicidad/*.{jpg,png}', GLOB_BRACE);
                if (count($files) > 0){
            ?>

                <div class="col-12 col-lg-7 mb-4 mt-4">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($files as $file){ ?>
                                <div class="carousel-item active">
                                    <img src=<?php echo $rutaInicio . $file ?> class="d-block w-100" alt="Publicidad Veterinaria">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>

                </div>
                <?php } ?>
                <div class="col-lg-1 d-none d-md-block">

                </div>
                <div class="col-12 col-lg-4 bg-light rounded-5 pt-4 mb-5 mt-5 flex-wrap border border-warning border-4 ">
<?php
    if (isset($_POST['email'])){
?>
                    <div class="alert alert-danger pt-2" role="alert">El usuario y/o la contraseña no son correctos
                    <button type="button" class="btn-close ms-4" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
<?php } ?>                
                    <form action="" method="POST">
                        <h1 class="text-secondary border-bottom border-warning border-5">Iniciar Sesión</h1>
                        <div class="form-floating mb-3">
                            <input name="email" class="form-control ingreso" id="floatingInput" placeholder="Correo Electronico" required>
                            <label for="floatingInput">Correo electrónico</label>
                        </div>
                        <div class="form-floating">
                            <input name="password" type="password" class="form-control ingreso" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Contraseña</label>
                        </div>
                        <p><a href="#" class="link-secondary link-offset-2 link-underline-opacity-25 mb-2 link-underline-opacity-100-hover reestablecer">¿Olvidó su contraseña?</a></p>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-warning mb-4 mt-2" type="submit">Iniciar Sesión</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <?php include_once 'footer.php';?> 
    </body>
</html>
