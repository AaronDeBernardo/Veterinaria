<?php
    require_once 'iniciarConsulta.php';
    $destino = 'abmcClientes.php';


    if (empty($op) || ($tipoUsuario != 'admin' && $tipoUsuario != 'veterinario' && $tipoUsuario != 'peluquero'))
    {
        header('Location: ' . $destino);
        die();
    }


    if ($op = 'eliminar')
    {
        if (!empty($_POST['idEliminar']))
        {
            $query = "UPDATE clientes SET baja = 1 WHERE id = '$_POST[idEliminar]';
                UPDATE mascotas SET baja = 1 WHERE cliente_id = '$_POST[idEliminar]';";
            $multiQuery = true;
        }
    }
    elseif ($op == 'modificarClave')
    {
        if (!empty($_POST['idModificar']) && isset($_POST['clave']))
        {
            $query = "UPDATE clientes SET clave = '" . md5($_POST['clave']) . "' WHERE id = '$_POST[idModificar]'";
        }
    }
    elseif (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
    {
        if ($op == 'insertar')
        {
            $query = "INSERT INTO clientes (nombre, apellido, email, clave, telefono, ciudad, direccion) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[telefono]', '$_POST[ciudad]', '$_POST[direccion]');";
        }
        elseif ($op == 'modificar' && !empty($_POST['idModificar']))
        {
            $query = "UPDATE clientes SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', telefono = '$_POST[telefono]', ciudad = '$_POST[ciudad]', direccion = '$_POST[direccion]' WHERE id = '$_POST[idModificar]';";
        }
    }

    require_once 'finalizarConsulta.php';
?>