<?php
    if (!isset($_SESSION))
        session_start();
    
    require_once 'connection.php';
    $tipoUsuario = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;;
    $op = isset($_POST['operacion']) ? $_POST['operacion'] : null;
    
    $multiQuery = false;
    $query;
    $resultados;
?>