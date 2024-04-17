<?php
    $rol;
    $item = null;

    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION['rol']))
        $rol = $_SESSION['rol'];
    else{
        header("Location: index.php");
        die();
    }
    
    if(isset($_SESSION['item'])){
        $item = $_SESSION['item'];
        $_SESSION['item'] = null;
    }
?>

<link rel="stylesheet" href="stylesMenuLateral.css">

<div class="col-12 col-md-4 col-lg-3 col-xl-2 ">
    <div class="d-flex d-md-none">
        <button class="btnSidebar" type="button" onclick="abrirSidebar()">
            EXPANDIR MENÚ (poner imagen)
        </button>
    </div>

    <div id="sidebar" class="sidebar d-none d-md-block">
        <button class="btnSidebar d-md-none" type="button" onclick="cerrarSidebar()">
            CERRAR MENÚ (imagen)
        </button>

        <a href="abmcAtenciones.php" <?php echo $item == 'atenciones' ? 'id = itemSeleccionado' : null ?>>Atenciones</a>
        <a href="abmcMascotas.php" <?php echo $item == 'mascotas' ? 'id = itemSeleccionado' : null ?>>Mascotas</a>
            
<?php
    if($rol == 'admin' || $rol == 'veterinario' || $rol == 'peluquero'){
?>
        <a href="abmcClientes.php" <?php echo $item == 'clientes' ? 'id = itemSeleccionado' : null ?>>Clientes</a>
<?php }
    
    if($rol == 'admin'){
?>
        <a href="abmcServicios.php" <?php echo $item == 'servicios' ? 'id = itemSeleccionado' : null ?>>Servicios</a>
        <a href="abmcPersonal.php" <?php echo $item == 'personal' ? 'id = itemSeleccionado' : null ?>>Personal</a>
<?php }

    if($rol == 'cliente'){
?>
        <a href="abmcDatos.php" <?php echo $item == 'misDatos' ? 'id = itemSeleccionado' : null ?>>Mis datos</a>

<?php } ?>

    </div>
</div>


<script>
    function abrirSidebar() {
        sidebar.classList.remove("d-none");
    }
    
    function cerrarSidebar() {
        sidebar.classList.add("d-none");
    }
</script>