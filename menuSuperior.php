<?php
    if(!isset($_SESSION))
        session_start();
?>

<link rel="stylesheet" href="styles.css?v=5" type="text/css">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
        <img src="Recursos/logoVeterinaria.png" id="logo" class="d-inline-block align-top" alt="Logo veterinaria. Click para ir al inicio">
    </a>
    
        <div class="collapse navbar-collapse" id="navbarText">
            <div class="secciones d-flex flex-wrap">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <img id="imgNuestraEmpresa" src="Recursos/logoNuestraEmpresa.png" alt="Nuestra Empresa">
                        <a class="nav-link" id="seccionesNavegacion" href="nuestraEmpresa.php">NUESTRA EMPRESA</a>
                    </li>
                </ul>
            </div>
        
            <div class="secciones d-flex flex-wrap">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <img id="imgNuestraEmpresa" src="Recursos/logoServicios.png" alt="Servicios">
                        <a class="nav-link" id="seccionesNavegacion" href="nuestroServicios.php">SERVICIOS</a>
                    </li>
                </ul>
            </div>
                

            <div class="secciones d-flex flex-wrap">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <img id="imgNuestraEmpresa" src="recursos/logoUbicacion.png" alt="Ubicacion">
                        <a class="nav-link" id="seccionesNavegacion"  href="nuestraUbicacion.php">UBICACIÓN</a>
                    </li>
                </ul>
            </div>
                
        </div>    
    </div>


    <div class="collapse navbar-collapse justify-content-end mx-5">
<?php
    if (isset($_SESSION['rol'])){
?>      <a href="cerrarSesion.php"><button id="btn-cerrarSesion">Salir</button></a>
<?php } ?>
    
    </div>
</nav>