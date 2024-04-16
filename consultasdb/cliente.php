<?php
    require_once 'iniciarConsulta.php';
    $destino = '../abmcClientes.php';


    if (empty($op) || ($tipoUsuario != 'admin' && $tipoUsuario != 'veterinario' && $tipoUsuario != 'peluquero'))
    {
        header('Location: ' . $destino);
        die();
    }


    if ($op == 'eliminar')
    {
        if (!empty($_POST['id_eliminar']))
        {
            $query = "UPDATE clientes SET baja = 1 WHERE id = '$_POST[id_eliminar]';
                UPDATE mascotas SET baja = 1 WHERE cliente_id = '$_POST[id_eliminar]';";
            $multiQuery = true;
        }
    }
    elseif ($op == 'modificar_clave')
    {
        if (!empty($_POST['id_modificar']) && isset($_POST['clave']))
        {
            $query = "UPDATE clientes SET clave = '" . md5($_POST['clave']) . "' WHERE id = '$_POST[id_modificar]'";
        }
    }
    elseif (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
    {
        if ($op == 'insertar' && isset($_POST['clave']))
        {
            $query = "INSERT INTO clientes (nombre, apellido, email, clave, telefono, ciudad, direccion) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[telefono]', '$_POST[ciudad]', '$_POST[direccion]');";
        }
        elseif ($op == 'modificar' && !empty($_POST['id_modificar']))
        {
            $query = "UPDATE clientes SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', telefono = '$_POST[telefono]', ciudad = '$_POST[ciudad]', direccion = '$_POST[direccion]' WHERE id = '$_POST[id_modificar]';";
        }
    }

    require_once 'finalizarConsulta.php';
?>