<?php
    require_once 'iniciarConsulta.php';
    $destino = '../abmcPersonal.php';
    
    if (empty($op) || $tipoUsuario != 'admin')
    {
        header('Location: ' . $destino);
        die();
    }

    if ($op == 'eliminar')
    {
        if (!empty($_POST['id_eliminar']))
            $query = "UPDATE personal SET baja = 1 WHERE id = '$_POST[idEliminar]'";
    }
    else if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['rol_id']))
    {
        if ($op == 'insertar' && isset($_POST['clave']))
        {
            $query = "INSERT INTO personal (nombre, apellido, email, clave, rol_id) 
                VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[rol_id]');";
        }   
        else if ($op == 'modificar' && !empty($_POST['idModificar']))
        {
            $query = "UPDATE personal SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', 
            rol_id = '$_POST[rol_id]' WHERE id = '$_POST[idModificar]';";
        }
    }

    require_once 'finalizarConsulta.php';
?>