<?php
    require_once 'iniciarConsulta.php';
    $destino = '../abmcServicios.php';

    if (empty($op) || $tipoUsuario != 'admin')
    {
        header('Location: '. $destino);
        die();
    }
    
    if ($op == 'eliminar')
    {
        if (!empty($_POST['id_eliminar'])){
            $query = "UPDATE servicios SET baja = 1 WHERE id = '$_POST[id_eliminar]';";
            $_SESSION['alerta'] = 'Servicio eliminado con éxito';
        }
    }
    elseif (isset($_POST['nombre']) && isset($_POST['tipo_servicio_id']) && isset($_POST['precio']))
    {
        $rangoFechas = isset($_POST['rango_fechas']);

        if ($op == 'insertar'){
            $query = "INSERT INTO servicios (nombre, tipo_servicio_id, precio, rango_fechas) VALUES ('$_POST[nombre]', '$_POST[tipo_servicio_id]', '$_POST[precio]', '$rangoFechas');";
            $_SESSION['alerta'] = 'Servicio guardado con éxito';
        }
        elseif ($op == 'modificar' && !empty($_POST['id_modificar'])){
            $query = "UPDATE servicios SET nombre = '$_POST[nombre]', tipo_servicio_id = '$_POST[tipo_servicio_id]', precio = '$_POST[precio]', rango_fechas = '$rangoFechas' WHERE id = '$_POST[id_modificar]';";
            $_SESSION['alerta'] = 'Servicio modificado con éxito';
        }
    }

    require_once 'finalizarConsulta.php';
?>