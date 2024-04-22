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
            $_SESSION['alerta'] = 'Cliente eliminado con éxito';
        }
    }
    elseif ($op == 'modificar_clave')
    {
        if (!empty($_POST['id_modificar']) && isset($_POST['clave']))
        {
            $query = "UPDATE clientes SET clave = '" . md5($_POST['clave']) . "' WHERE id = '$_POST[id_modificar]'";
            $_SESSION['alerta'] = 'Clave modificada con éxito';
        }
    }
    elseif (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
    {
        if ($op == 'insertar' && isset($_POST['clave']))
        {
            $q = "SELECT id FROM personal WHERE email = '$_POST[email]'";
            $r1 = consultaSQL($q);
            $q = "SELECT id FROM clientes WHERE email = '$_POST[email]'";
            $r2 = consultaSQL($q);

            if ($r1->num_rows == 0 && $r2->num_rows == 0)
            {
                $query = "INSERT INTO clientes (nombre, apellido, email, clave, telefono, ciudad, direccion) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[telefono]', '$_POST[ciudad]', '$_POST[direccion]');";
                $_SESSION['alerta'] = 'Cliente guardado con éxito';
            }
            else{
                $_SESSION['alerta'] = 'Ya existe un usuario con el email ingresado';
                $_SESSION['icono_alerta'] = 'error';
                header('Location:' . $destino);
                die();
            }
        }
        elseif ($op == 'modificar' && !empty($_POST['id_modificar']))
        {
            $q = "SELECT id FROM personal WHERE email = '$_POST[email]'";
            $r1 = consultaSQL($q);

            $q = "SELECT id FROM clientes WHERE email = '$_POST[email]' AND id != '$_POST[id_modificar]'";
            $r2 = consultaSQL($q);

            if ($r1->num_rows == 0 && $r2->num_rows == 0)
            {
                $query = "UPDATE clientes SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', telefono = '$_POST[telefono]', ciudad = '$_POST[ciudad]', direccion = '$_POST[direccion]' WHERE id = '$_POST[id_modificar]';";
                $_SESSION['alerta'] = 'Cliente modificado con éxito';
            }
            else{
                $_SESSION['alerta'] = 'Ya existe un usuario con el email ingresado';
                $_SESSION['icono_alerta'] = 'error';
                header('Location:' . $destino);
                die();
            }
        }
    }

    require_once 'finalizarConsulta.php';
?>