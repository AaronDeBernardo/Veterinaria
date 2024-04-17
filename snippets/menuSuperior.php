<?php
    if (!isset($_SESSION))
        session_start();
    if (isset($_SESSION['apellido']) && isset($_SESSION['nombre'])) {
        $nombreCompleto = $_SESSION['apellido'] . ' ' . $_SESSION['nombre'];
        } else {
        $nombreCompleto = "Usuario";
        }
          

?>



<link rel="stylesheet" href="styles/stylesMenuSuperior.css" type="text/css">

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="recursos/logoVeterinaria.png" id="logoVeterinaria" class="d-inline-block align-top" alt="Logo veterinaria. Click para ir al inicio">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="d-flex flex-wrap">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active  seccionesNavegacion">
                        <a class="nav-link text-black"  href="nuestraEmpresa.php"><img class="logo" src="recursos/logoNuestraEmpresa.png" alt="">NUESTRA EMPRESA</a>
                    </li>
                    <li class="nav-item active  seccionesNavegacion" >         
                        <a class="nav-link text-black"  href="nuestrosServicios.php"><img class="logo" src="recursos/logoServicios.png" alt="">SERVICIOS</a>
                    </li>
                    <li class="nav-item active  seccionesNavegacion">
                        <a class="nav-link text-black"   href="nuestraUbicacion.php"><img class="logo" src="recursos/logoUbicacion.png" alt="">UBICACIÓN</a>
                    </li>
                    <li class="nav-item active  seccionesNavegacion">
                        <a class="nav-link text-black"   href="faq.php"><img class="logo" src="recursos/faq.png" alt="">PREGUNTAS</a>
                    </li>
                </ul>
            </div>
        </div>

        <?php if (isset($_SESSION['rol'])){?>
            <div class="justify-content-end ps-2 me-3 ">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nombreCompleto ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="consultasdb/misDatos.php">Mis Datos</a></li>
                            <li><a class="dropdown-item" href="snippets/cerrarSesion.php">Cerrar Sesión</a></li>  
                        </ul>
                    </div>
                </div>
        <?php } ?>

    </div>
</nav>