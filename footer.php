<?php
    if(!isset($_SESSION))
        session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesFooter.css" type="text/css">
</head>
<body>


    <div class="container-fluid">
        <div class="row p-3 bg-light text-black ">
            <div class="col-xs-12 col-md-12 col-lg-3 d-flex text-center justify-content-center">
                <div class="container-fluid w-50 m-20 p-0">
                    <a href="index.php"><img src="Recursos/logoVeterinaria.png" class="img-fluid" alt="Logo Veterinaria"></a>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-3 text-center">
                <p class="h4 my-3 text-warning">Enlaces de interés</p>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="nuestraEmpresa.php">Quienes Somos?</a>
                </div>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="nuestrosServicios.php">Servicios</a>
                </div>
                <div class="mb-2">
                    <p class="h4 my-2 text-warning">Contacto</p>
                    <p class="text-black text-decoration-none m-0 ">Habitual: (0341) xxxxxxxx</p>
                    <p class="text-black text-decoration-none m-0">Emergencias: (0341) yyyyyyyy</p>
                </div>

            </div>
            <div class="col-xs-12 col-md-4 col-lg-3 text-center">
                <p class="h4 my-3 text-warning">Ubicación</p>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="nuestraUbicacion.php">Zeballos 1341, 2000 Rosario, Santa Fe</a>
                </div>
                <div class="mb-2">
                    <p class="h4 my-2 text-warning">Horarios</p>
                    <p class="h5 text-black text-decoration-none ">Todos los días</p>
                    <p class="text-black text-decoration-none">08:00hs - 19:00hs</p>
                </div>
               
            </div>

            <div class="col-xs-12 col-md-4 col-lg-3 text-center">
                <p class="h4 my-3 text-warning">Redes Sociales</p>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="https://www.instagram.com/?hl=es">Instagram</a>
                </div>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="https://es-la.facebook.com/">Facebook</a>
                </div>
                <div class="mb-2">
                    <a class="text-black text-decoration-none" href="https://wa.me/543462629993">Whatsapp</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
