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
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Nuestra empresa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ubicación</a>
            </li>
        </ul>
    </div>


    <div class="collapse navbar-collapse justify-content-end mx-5">

<?php
    if (isset($_SESSION['rol'])){
?>      <a href="cerrarSesion.php"><button id="btn-cerrarSesion">Salir</button></a>
<?php } ?>
    
    </div>
</nav>