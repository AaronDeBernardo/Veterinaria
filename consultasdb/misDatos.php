<?php
    require_once 'iniciarConsulta.php';
    $destino = '../abmcDatos.php';
    
    if (empty($op) || $tipoUsuario != 'cliente')
    {
        header('Location: ' . $destino);
        die();
    }

    if ($op == 'modificar')
    {
        if (isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
        {
            $query = "UPDATE clientes SET email = '$_POST[email]', telefono = '$_POST[telefono]', ciudad = '$_POST[ciudad]', direccion = '$_POST[direccion]' WHERE id = '$_SESSION[cliente_id]';";
        }
    }
    elseif ($op == 'modificarClave')
    {
        if (isset($_POST['claveActual']) && isset($_POST['claveNueva']) && isset($_POST['claveRepetida']))
        {
            if ($_POST['claveNueva'] == $_POST['claveRepetida'])
            {
                $q = "SELECT clave FROM clientes WHERE id = '$_SESSION[cliente_id]'";
                $r = consultaSQL($q);
                $claveActual = mysqli_fetch_array($r)[0];

                if ($claveActual == md5($_POST['claveActual']))
                {
                    $query = "UPDATE clientes SET clave = '" . md5($_POST['claveNueva']) . "' WHERE id = '$_SESSION[cliente_id]'";
                }
                else
                {
                    echo "<script>
                    alert('Clave actual erronea!');
                    window.location.href='" . $destino . "';
                    </script>";
                    die();
                }
            }
        }
    }

    require_once 'finalizarConsulta.php';
?>