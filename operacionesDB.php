<?php
    session_start();
    $tipoUsuario = $_SESSION['rol'];
    $op = $_POST['operacion'];
    include_once 'connection.php';
    $query;
    $multiQuery = false;
    $resultados;
    $destino; //la página a la que será redirigido el usuario
    
    if (empty($op))
    {
        header('Location: index.php');
        die();
    }
    else
    {
        if ($op == 'insertarPers' && $tipoUsuario == 'admin')
        {
            if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['rol_id']))
            {
                $query = "INSERT INTO personal (nombre, apellido, email, clave, rol_id) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST[clave]) . "', '$_POST[rol_id]');";
            }
            $destino = 'abmcPersonal.php';
        }
        elseif ($op == 'modificarPers' && $tipoUsuario == 'admin')
        {
            if (!empty($_POST['idModificar']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['rol_id']))
            {
                $query = "UPDATE personal SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', rol_id = '$_POST[rol_id]' WHERE id = '$_POST[idModificar]';";
            }
            $destino = 'abmcPersonal.php';
        }
        elseif ($op == 'eliminarPers' && $tipoUsuario == 'admin')
        {
            if (!empty($_POST['idEliminar']))
            {
                $query = "UPDATE personal SET baja = 1 WHERE id = '$_POST[idEliminar]'";
            }
            $destino = 'abmcPersonal.php';
        }

        else if ($op == 'insertarServ' && $tipoUsuario == 'admin')
        {
            if (isset($_POST['nombre']) && isset($_POST['tipo_servicio_id']) && isset($_POST['precio']))
            {
                $rangoFechas = false;
                if (isset($_POST['rango_fechas']))
                    $rangoFechas = true;
                $query = "INSERT INTO servicios (nombre, tipo_servicio_id, precio, rango_fechas) VALUES ('$_POST[nombre]', '$_POST[tipo_servicio_id]', '$_POST[precio]', '$rangoFechas');";
            }
            $destino = 'abmcServicios.php';
        }
        elseif ($op == 'modificarServ' && $tipoUsuario == 'admin')
        {
            if (!empty($_POST['idModificar']) && isset($_POST['nombre']) && isset($_POST['tipo_servicio_id']) && isset($_POST['precio']))
            {
                $rangoFechas = false;
                if (isset($_POST['rango_fechas']))
                    $rangoFechas = true;
                $query = "UPDATE servicios SET nombre = '$_POST[nombre]', tipo_servicio_id = '$_POST[tipo_servicio_id]', precio = '$_POST[precio]', rango_fechas = '$rangoFechas' WHERE id = '$_POST[idModificar]';";
            }
            $destino = 'abmcServicios.php';
        }
        elseif ($op == 'eliminarServ' && $tipoUsuario == 'admin')
        {
            if (!empty($_POST['idEliminar']))
            {
                $query = "UPDATE servicios SET baja = 1 WHERE id = '$_POST[idEliminar]';";
            }
            $destino = 'abmcServicios.php';
        }

        elseif ($op == 'insertarCliente' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
            {
                $query = "INSERT INTO clientes (nombre, apellido, email, clave, telefono, ciudad, direccion) VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '" . md5($_POST['clave']) . "', '$_POST[telefono]', '$_POST[ciudad]', '$_POST[direccion]');";
            }
            $destino = 'abmcClientes.php';
        }
        elseif ($op == 'modificarCliente' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (!empty($_POST['idModificar']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['ciudad']) && isset($_POST['direccion']))
            {
                $query = "UPDATE clientes SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', email = '$_POST[email]', telefono = '$_POST[telefono]', ciudad = '$_POST[ciudad]', direccion = '$_POST[direccion]' WHERE id = '$_POST[idModificar]';";
            }
            $destino = 'abmcClientes.php';
        }
        elseif ($op == 'eliminarCliente' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (!empty($_POST['idEliminar']))
            {
                $query = "UPDATE clientes SET baja = 1 WHERE id = '$_POST[idEliminar]';
                UPDATE mascotas SET baja = 1 WHERE cliente_id = '$_POST[idEliminar]';";
                $multiQuery = true;
            }
            $destino = 'abmcClientes.php';
        }
        elseif ($op == 'modificarClaveCliente' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (!empty($_POST['idModificar']) && isset($_POST['clave']))
            {
                $query = "UPDATE clientes SET clave = '" . md5($_POST['clave']) . "' WHERE id = '$_POST[idModificar]'";
            }
            $destino = 'abmcClientes.php';
        }

        elseif ($op == 'insertarMascota' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (isset($_POST['nombre']) && isset($_POST['cliente_id']) && isset($_POST['raza']) && isset($_POST['color']) && isset($_POST['fecha_de_nac']))
            {
                $foto = NULL;

                if(!empty($_FILES['foto']['name'])) { 
                    $fileName = basename($_FILES['foto']['name']); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                    $allowTypes = array('jpg','png','jpeg'); 
                    if(in_array($fileType, $allowTypes))
                    {
                        $aux = $_FILES['foto']['tmp_name'];
                        $foto = addslashes(file_get_contents($aux));
                    }
                }

                $query = "INSERT INTO mascotas (nombre, cliente_id, raza, color, fecha_de_nac, foto) VALUES ('$_POST[nombre]', '$_POST[cliente_id]', '$_POST[raza]', '$_POST[color]', '$_POST[fecha_de_nac]', NULLIF('$foto',''));";
            }
            $destino = 'abmcMascotas.php';
        }
        elseif ($op == 'modificarMascota' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (!empty($_POST['idModificar']) && isset($_POST['nombre']) && isset($_POST['cliente_id']) && isset($_POST['raza']) && isset($_POST['color']) && isset($_POST['fecha_de_nac']))
            {
                $fechaMuerte = isset($_POST['fecha_muerte']) ? $_POST['fecha_muerte'] : NULL;

                $foto = NULL;

                if(!empty($_FILES['foto']['name'])) { 
                    $fileName = basename($_FILES['foto']['name']); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                    $allowTypes = array('jpg','png','jpeg'); 
                    if(in_array($fileType, $allowTypes))
                    {
                        $aux = $_FILES['foto']['tmp_name'];
                        $foto = addslashes(file_get_contents($aux));
                    }
                }

                $query = "UPDATE mascotas SET nombre = '$_POST[nombre]', cliente_id = '$_POST[cliente_id]', raza = '$_POST[raza]', color = '$_POST[color]', 
                    fecha_de_nac = '$_POST[fecha_de_nac]', foto = NULLIF('$foto',''), fecha_muerte = NULLIF('$fechaMuerte','') WHERE id = '$_POST[idModificar]';";
            }
            $destino = 'abmcMascotas.php';
        }
        elseif ($op == 'eliminarMascota' && ($tipoUsuario == 'admin' || $tipoUsuario == 'veterinario' || $tipoUsuario == 'peluquero'))
        {
            if (!empty($_POST['idEliminar']))
            {
                $query = "UPDATE mascotas SET baja = 1 WHERE id = '$_POST[idEliminar]'";
            }
            $destino = 'abmcMascotas.php';
        }
    }
    

    if (!empty($query) && $multiQuery)
        $resultados = multiplesConsultas($query);
    elseif (!empty($query))
        $resultados = consultaSQL($query);
    
    if (empty($resultados)){
        echo "<script>
        alert('Error al realizar la operación solicitada');
        window.location.href='" . $destino . "';
        </script>";
        die();
    }
    else{
        header('Location: ' . $destino);
        die();
    }
    
?>