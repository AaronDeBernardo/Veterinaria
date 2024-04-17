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
        if (!empty($_POST['id_eliminar'])){
            $query = "UPDATE mascotas SET baja = 1 WHERE id = '$_POST[id_eliminar]'";
            $_SESSION['alerta'] = 'Mascota eliminada con éxito';
        }
    }
    elseif (isset($_POST['nombre']) && isset($_POST['cliente_id']) && isset($_POST['raza']) && isset($_POST['color']) && isset($_POST['fecha_de_nac']))
    {
        $foto = NULL;

        if(!empty($_FILES['foto']['name'])) { 
            $fileName = basename($_FILES['foto']['name']); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $allowTypes = array('jpg','png','jpeg','jfif'); 
            if(in_array($fileType, $allowTypes))
            {
                $aux = $_FILES['foto']['tmp_name'];
                $foto = addslashes(file_get_contents($aux));
            }
        }


        if ($op == 'insertar'){
            $query = "INSERT INTO mascotas (nombre, cliente_id, raza, color, fecha_de_nac, foto) VALUES ('$_POST[nombre]', '$_POST[cliente_id]', '$_POST[raza]', '$_POST[color]', '$_POST[fecha_de_nac]', NULLIF('$foto',''));";
            $_SESSION['alerta'] = 'Mascota guardada con éxito';
        }
        
    
        elseif ($op == 'modificar' && !empty($_POST['id_modificar']))
        {
            $fechaMuerte = isset($_POST['fecha_muerte']) ? $_POST['fecha_muerte'] : NULL;
            $stringfoto = is_null($foto) ? "" : ", foto = '$foto'";

            $query = "UPDATE mascotas SET nombre = '$_POST[nombre]', cliente_id = '$_POST[cliente_id]', raza = '$_POST[raza]', color = '$_POST[color]', 
                fecha_de_nac = '$_POST[fecha_de_nac]', fecha_muerte = NULLIF('$fechaMuerte','') $stringfoto WHERE id = '$_POST[id_modificar]';";
            
            $_SESSION['alerta'] = 'Mascota modificada con éxito';
        } 
    }
    
    require_once 'finalizarConsulta.php';
?>