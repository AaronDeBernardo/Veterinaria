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

<link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
<link rel="stylesheet" href="stylesMenuLateral.css">

<div class="col-12 col-md-4 col-lg-3 col-xl-2">
    <aside id="sidebar" class="expand-md">
        <div class="d-flex d-md-none">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-ticket-alt"></i>
                    <span>Atenciones</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="abmcMascotas.php" class="sidebar-link">
                    <i class="lni lni-mashroom"></i>
                    <span>Mascotas</span>
                </a>
            </li>
            


<?php
    if($rol == 'admin' || $rol == 'veterinario' || $rol == 'peluquero'){
?>
            <li class="sidebar-item">
                <a href="abmcClientes.php" class="sidebar-link">
                    <i class="lni lni-users"></i>
                    <span>Clientes</span>
                </a>
            </li>
<?php }
    
    if($rol == 'admin'){
?>
            <li class="sidebar-item">
                <a href="abmcServicios.php" class="sidebar-link">
                    <i class="lni lni-service"></i>
                    <span>Servicios</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="abmcPersonal.php" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Personal</span>
                </a>
            </li>
<?php }

    if($rol == 'cliente'){
?>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-database"></i>
                    <span>Mis datos</span>
                </a>
            </li>

<?php } ?>


        </ul>
    </aside>

    <script src="scriptMenuLateral.js"></script>
</div>