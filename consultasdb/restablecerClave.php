<?php
    require_once 'iniciarConsulta.php';
    $destino = '../index.php';
    
    if (empty($_SESSION['id_mod_clave']) || empty($_SESSION['tipo_usuario_clave']))
    {
        header('Location: ' . $destino);
        die();
    }
    
    if (isset($_POST['claveNueva']) && isset($_POST['claveRepetida']))
    {
        if ($_POST['claveNueva'] == $_POST['claveRepetida'])
        {
            if ($_SESSION['tipo_usuario_clave'] == 'cliente')
            {
                $q = "UPDATE clientes SET clave = '" . md5($_POST['claveNueva']) . "' WHERE id = '$_SESSION[id_mod_clave]'";
            }
            else if ($_SESSION['tipo_usuario_clave'] == 'personal')
            {
                $q = "UPDATE personal SET clave = '" . md5($_POST['claveNueva']) . "' WHERE id = '$_SESSION[id_mod_clave]'";
            }
            consultaSQL($q);
            
            $q = "UPDATE reset_claves SET utilizado = 1 WHERE id = '$_SESSION[id_reset]'";
            consultaSQL($q);

            $_SESSION['alerta'] = 'Su clave ha sido modificada';
            $_SESSION['icono_alerta'] = 'success';
            header('Location:' . $destino);
            die();
        }
        else
        {
            $_SESSION['alerta'] = 'Las claves ingresadas no coinciden';
            $_SESSION['icono_alerta'] = 'error';
        }
    }
    header('Location:' . $destino);
    die();

?>
