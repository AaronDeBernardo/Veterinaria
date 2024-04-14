<?php
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