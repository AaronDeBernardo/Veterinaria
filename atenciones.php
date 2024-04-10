<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }
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
                <?php  $_SESSION['item'] = 'atenciones'; include_once 'menuLateral.php'; ?>
                <div class="col-12 col-md-8 col-lg-9 col-xl-10">

                </div>
            </div>
        </div>

    </body>
</html>