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
        if (!empty($_POST['id_eliminar'])){
            $query = "UPDATE personal SET baja = 1 WHERE id = '$_POST[id_eliminar]'";
            $_SESSION['alerta'] = 'Personal eliminado con éxito';
        }
    }
    else if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['rol_id']))
    {
        if ($op == 'insertar' && isset($_POST['clave']))
        {
            $q = "SELECT id FROM personal WHERE email = '$_POST[email]'";
            $r1 = consultaSQL($q);
            $q = "SELECT id FROM clientes WHERE email = '$_POST[email]'";
            $r2 = consultaSQL($q);

            if ($r1->num_rows == 0 && $r2->num_rows == 0)
            {
                $query = "INSERT INTO personal (nombre, apellido, email, clave, rol_id) 
                    VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[rol_id]');";
                $_SESSION['alerta'] = 'Personal guardado con éxito';
            }
            else{
                $_SESSION['alerta'] = 'Ya existe un usuario con el email ingresado';
                $_SESSION['icono_alerta'] = 'error';
                header('Location:' . $destino);
                die();
            }
        }   
        else if ($op == 'modificar' && !empty($_POST['id_modificar']))
        {
            $q = "SELECT id FROM personal WHERE email = '$_POST[email]' AND id != '$_POST[id_modificar]'";
            $r1 = consultaSQL($q);

            $q = "SELECT id FROM clientes WHERE email = '$_POST[email]'";
            $r2 = consultaSQL($q);

            if ($r1->num_rows == 0 && $r2->num_rows == 0)
            {
                $query = "UPDATE personal SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', 
                    rol_id = '$_POST[rol_id]' WHERE id = '$_POST[id_modificar]';";
                $_SESSION['alerta'] = 'Personal modificado con éxito';
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