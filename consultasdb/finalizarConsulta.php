<?php
    if (!empty($query) && $multiQuery)
        $resultados = multiplesConsultas($query);
    elseif (!empty($query))
        $resultados = consultaSQL($query);
    
    $_SESSION['icono_alerta'] = 'success';
    
    if (empty($resultados)){
        $_SESSION['alerta'] = 'Error al ejecutar la operación solicitada';
        $_SESSION['icono_alerta'] = 'error';
    }

    header('Location: ' . $destino);
    die();
?>