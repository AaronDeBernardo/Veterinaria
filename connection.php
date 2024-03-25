<?php
    define('SERVIDOR', 'localhost');
    define('USUARIO', 'root');
    define('CONTRASENIA', '');
    define('DATABASE', 'veterinariadb');

    $rutaInicio = 'http://localhost/Veterinaria/';

    function consultaSQL($query){
        $connection = mysqli_connect(SERVIDOR, USUARIO, CONTRASENIA, DATABASE) or die('Conexión fallida');
        $resultados = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $resultados;
    }

    function multiplesConsultas($query){
        $connection = mysqli_connect(SERVIDOR, USUARIO, CONTRASENIA, DATABASE) or die('Conexión fallida');
        $resultados = mysqli_multi_query($connection, $query);
        mysqli_close($connection);
        return $resultados;
    }
?>