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
            $_SESSION['alerta'] = 'Datos guardados con éxito';
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
                    $_SESSION['alerta'] = 'Su clave ha sido modificada';
                }
                else
                {
                    $_SESSION['alerta'] = 'Clave actual errónea!';
                    $_SESSION['icono_alerta'] = 'error';
                    header('Location:' . $destino);
                    die();
                }
            }
        }
    }

    require_once 'finalizarConsulta.php';
?>