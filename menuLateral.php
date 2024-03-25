<?php
    $rol;
    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION['rol']))
        $rol = $_SESSION['rol'];
    else{
        header("Location: index.php");
        die();
    }
?>

<ul id="menuLateral" class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="#">Atenciones</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Mascotas</a>
    </li>



<?php
    if($rol == 'admin' || $rol == 'veterinario' || $rol == 'peluquero'){
?>
    <li class="nav-item">
        <a class="nav-link" href="abmcClientes.php">Clientes</a>
    </li>
<?php } ?>



<?php
    if($rol == 'admin'){
?>
    <li class="nav-item">
        <a class="nav-link" href="abmcServicios.php">Servicios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="abmcPersonal.php">Personal</a>
    </li>
<?php } ?>



<?php
    if($rol == 'cliente'){
?>
    <li class="nav-item">
        <a class="nav-link" href="#">Mis datos</a>
    </li>
<?php } ?>


</ul>