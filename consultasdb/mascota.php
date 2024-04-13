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