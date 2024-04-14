<?php
    require_once 'iniciarConsulta.php';
    $destino = '../abmcMascotas.php';
    
    if (empty($op) || ($tipoUsuario != 'admin' && $tipoUsuario != 'veterinario' && $tipoUsuario != 'peluquero'))
    {
        header('Location: ' . $destino);
        die();
    }
  
    if ($op == 'eliminar')
    {
        if (!empty($_POST['idEliminar']))
            $query = "UPDATE mascotas SET baja = 1 WHERE id = '$_POST[idEliminar]'";
    }
    elseif (isset($_POST['nombre']) && isset($_POST['cliente_id']) && isset($_POST['raza']) && isset($_POST['color']) && isset($_POST['fecha_de_nac']))
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


        if ($op == 'insertar')
            $query = "INSERT INTO mascotas (nombre, cliente_id, raza, color, fecha_de_nac, foto) VALUES ('$_POST[nombre]', '$_POST[cliente_id]', '$_POST[raza]', '$_POST[color]', '$_POST[fecha_de_nac]', NULLIF('$foto',''));";
        
    
        elseif ($op == 'modificar' && !empty($_POST['idModificar']))
        {
            $fechaMuerte = isset($_POST['fecha_muerte']) ? $_POST['fecha_muerte'] : NULL;

            $query = "UPDATE mascotas SET nombre = '$_POST[nombre]', cliente_id = '$_POST[cliente_id]', raza = '$_POST[raza]', color = '$_POST[color]', 
                fecha_de_nac = '$_POST[fecha_de_nac]', foto = NULLIF('$foto',''), fecha_muerte = NULLIF('$fechaMuerte','') WHERE id = '$_POST[idModificar]';";
        
        } 
    }
    
    require_once 'finalizarConsulta.php';
?>