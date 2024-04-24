<?php
    include_once 'consultasdb/connection.php';

    if (isset($_GET['i']) && isset($_GET['c']))
    {
        $query = "SELECT id, tipo_usuario FROM reset_claves WHERE codigo = '" . MD5($_GET['c']) . "' AND 
            id_usuario = $_GET[i] AND timestampdiff(HOUR, fecha_hora, CURRENT_TIMESTAMP()) < 24 AND utilizado = 0";
        
        $resultados = consultaSQL($query);
        session_start();

        if (mysqli_num_rows($resultados) > 0)
        {
            $r = mysqli_fetch_array($resultados);
            $_SESSION['id_mod_clave'] = $_GET['i'];
            $_SESSION['id_reset'] = $r[0];
            $_SESSION['tipo_usuario_clave'] = $r[1];
        }
        else
        {    
            $_SESSION['alerta'] = 'El enlace no es válido.';
            $_SESSION['icono_alerta'] = 'error';
            header('Location:index.php');
            die();
        }
    }
    else
    {
        header('Location:index.php');
        die();
    }

?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="icon" href="recursos/logoVeterinaria.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">   
    <div class="row d-flex justify-content-center mt-3">
        <div class="col-12 col-md-6">
            <h2>Modificar Contraseña</h2>
            <form action="consultasdb/restablecerClave.php" onsubmit="return validarClave()" method="POST">
                <div class="mb-3">
                    <label for="claveNueva" class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control" name="claveNueva" id="claveNueva" required>
                </div>
                <div class="mb-3">
                    <label for="claveRepetida" class="form-label">Repetir nueva contraseña</label>
                    <input type="password" class="form-control" name="claveRepetida" id="claveRepetida" required>
                </div>
                <button type="submit" class="btn btn-warning">Modificar Contraseña</button>
            </form>
        </div>
    </div>  
</div>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="scripts/scriptMisDatos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
        include_once 'snippets/mostrarAlerta.php';
    ?>
</body>
</html>