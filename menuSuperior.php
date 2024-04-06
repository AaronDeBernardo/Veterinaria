<?php
    if(!isset($_SESSION))
        session_start();
?>

<link rel="stylesheet" href="styles.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="Recursos/logoVeterinaria.png" id="logo" class="d-inline-block align-top" alt="Logo veterinaria. Click para ir al inicio">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
            <div class="collapse navbar-collapse" id="navbarScroll">
                <div class="secciones d-flex flex-wrap">
                    <ul class="navbar-nav mr-auto mx-3 px-4">
                        <li class="nav-item active ">
                            <img id="imgNuestraEmpresa" src="Recursos/logoNuestraEmpresa.png" alt="Nuestra Empresa">
                            <a class="nav-link text-black" id="seccionesNavegacion" href="nuestraEmpresa.php">NUESTRA EMPRESA</a>
                        </li>
                    </ul>
                </div>
            
                <div class="secciones d-flex flex-wrap ">
                    <ul class="navbar-nav mr-auto mx-3 px-4">
                        <li class="nav-item active">
                            <img id="imgNuestraEmpresa" src="Recursos/logoServicios.png" alt="Servicios">
                            <a class="nav-link text-black" id="seccionesNavegacion" href="nuestrosServicios.php">SERVICIOS</a>
                        </li>
                    </ul>
                </div>
                    

                <div class="secciones d-flex flex-wrap">
                    <ul class="navbar-nav mr-auto mx-3 px-4">
                        <li class="nav-item active">
                            <img id="imgNuestraEmpresa" src="recursos/logoUbicacion.png" alt="Ubicacion">
                            <a class="nav-link text-black" id="seccionesNavegacion"  href="nuestraUbicacion.php">UBICACIÓN</a>
                        </li>
                    </ul>
                </div>
                    
            </div>    
    


        <div class="collapse navbar-collapse justify-content-end mx-5">
    <?php
        if (isset($_SESSION['rol'])){?>
            <a href="cerrarSesion.php"><button id="btn-cerrarSesion">Salir</button></a>
    <?php } ?>
        
        </div>
    </div>
</nav>