<?php
    if(!isset($_SESSION))
        session_start();

    if (isset($_SESSION['alerta']))
    {
?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: "<?php echo $_SESSION['icono_alerta'] ?>",
                title: "<?php echo $_SESSION['alerta'] ?>",
                confirmButtonColor: "#f0ad4e",
            });
        </script>
<?php
        unset($_SESSION['alerta']);
    }
?>