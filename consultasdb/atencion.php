<?php
    function calcularDias(DateTime $f_h_atencion, DateTime $f_h_salida) //devuelve -1 si la fecha de salida es anterior a la de inicio atención
    {
        $dif = $f_h_atencion->diff($f_h_salida);
        if ($dif->invert)
            return -1;

        $dias = $dif->days;

        if ($dif->h > 0)
            $dias += 1;
        
        if ($dias == 0)
            $dias = 1;
        return $dias;
    }


    require_once 'iniciarConsulta.php';
    $destino = '../abmcAtenciones.php';
    
    if (empty($op) || ($tipoUsuario != 'admin' && $tipoUsuario != 'veterinario' && $tipoUsuario != 'peluquero'))
    {
        header('Location: ' . $destino);
        die();
    }
    

    if ($op == 'eliminar')
    {
        if (!empty($_POST['id_eliminar']))
        {
            $autorizado = $_SESSION['rol'] == 'admin' ? true : false;

            if (!$autorizado){
                $q = "SELECT personal_id FROM atenciones WHERE id = '$_POST[id_eliminar]'";
                $r = consultaSQL($q);
                $autorizado = ($r->num_rows != 0 && mysqli_fetch_array($r)[0] == $_SESSION['personal_id']) ?? true;
            }

            if ($autorizado){
                $query = "DELETE FROM atenciones WHERE id = '$_POST[id_eliminar]'";
                $_SESSION['alerta'] = 'Atención eliminada con éxito';
            }
        }
    }
    elseif (isset($_POST['mascota_id']) && isset($_POST['servicio_id']) && isset($_POST['titulo']))
    {
        $continuar = true;
        $q = "SELECT rango_fechas FROM servicios WHERE id = '$_POST[servicio_id]'";
        $r = consultaSQL($q);
        $rango_fechas = mysqli_fetch_array($r)[0];

        if ($rango_fechas)
            $continuar = isset($_POST['fecha_hora_salida']);
        
        if ($continuar)
        {
            if ($op == 'insertar')
            {
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $fecha_hora_atencion = new DateTime();
                $dias = 1;
                if ($rango_fechas)
                    $dias = calcularDias($fecha_hora_atencion, new DateTime($_POST['fecha_hora_salida']));

                if ($dias != -1)
                {                
                    $fecha_hora_atencion = $fecha_hora_atencion->format('Y-m-d H:i:s');
                    
                    $query = "INSERT INTO atenciones (mascota_id, servicio_id, personal_id, fecha_hora, fecha_hora_salida, titulo, descripcion, precio) 
                        VALUES ('$_POST[mascota_id]', '$_POST[servicio_id]', '$_SESSION[personal_id]', '$fecha_hora_atencion', NULLIF('$_POST[fecha_hora_salida]',''), 
                        '$_POST[titulo]', NULLIF('$_POST[descripcion]',''), $dias * (SELECT precio FROM servicios WHERE id = '$_POST[servicio_id]'));";
                    $multiQuery = true;
                    $_SESSION['alerta'] = 'Atención guardada con éxito';
                }
            }
            elseif ($op == 'modificar' && !empty($_POST['id_modificar']))
            {
                $autorizado = $_SESSION['rol'] == 'admin' ? true : false;

                if (!$autorizado){
                    $q = "SELECT personal_id FROM atenciones WHERE id = '$_POST[id_modificar]'";
                    $r = consultaSQL($q);
                    $autorizado = ($r->num_rows != 0 && mysqli_fetch_array($r)[0] == $_SESSION['personal_id']) ?? true;
                }
    
                if ($autorizado)
                {
                    $q = "SELECT fecha_hora FROM atenciones WHERE id = '$_POST[id_modificar]'";
                    $r = consultaSQL($q);
                    $fecha = mysqli_fetch_array($r)[0];
                    $dias = 1;
                    if ($rango_fechas)
                        $dias = calcularDias(new DateTime($fecha), new DateTime($_POST['fecha_hora_salida']));
                    
                    if ($dias != -1)
                    {
                        $query = "UPDATE atenciones SET mascota_id = '$_POST[mascota_id]', servicio_id = '$_POST[servicio_id]', fecha_hora_salida = NULLIF('$_POST[fecha_hora_salida]',''), 
                            titulo = '$_POST[titulo]', descripcion = NULLIF('$_POST[descripcion]',''), precio = $dias * (SELECT precio FROM servicios WHERE id = '$_POST[servicio_id]') 
                            WHERE id = '$_POST[id_modificar]';";
                        $multiQuery = true;
                        $_SESSION['alerta'] = 'Atención modificada con éxito';
                    }
                }
            }
        }
    }

    require_once 'finalizarConsulta.php';
?>