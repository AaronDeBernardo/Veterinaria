<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria San Antón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="logoVeterinaria.png">
</head>
<body id="body-secretaria">
    <header class="header">
        <div class="logo">
            <a href="index.php">
                <img src="logoVeterinariaPNG.png"  alt="Logo veterinaria. Click para ir al inicio">
            </a>
        </div>
        <nav>
            <ul class="nav-opciones">
                <li><a href="abmclientes.php">CLIENTES</a></li>
                <li><a href="abmmascotas.php">MASCOTAS</a></li>
                <li><a href="abmcServicios.php">SERVICIOS</a></li>
            </ul>
        </nav>
        <a href="index.php" ><button class="btn">Salir</button></a>
    </header>
    <div class="container">
        <div class="row colLista" align="center">
            <div class="col-12 ">
                <h2>REGISTRO DE MASCOTAS</h2>
                <?php
                    include 'connection.php';
                    $consulta = "SELECT * FROM mascotas";
                    $resultado = mysqli_query($cn, $consulta);
                    if($resultado){
                        while($lineaDatos = $resultado->fetch_array())
                            $id = $lineaDatos['id'];
                            $cliente_id= $lineaDatos['cliente_id'];
                            $nombre = $lineaDatos['nombre'];
                            $foto = $lineaDatos['foto'];
                            $raza = $lineaDatos['raza'];
                            $color = $lineaDatos['color'];
                            $fecha_de_nac = $lineaDatos['fecha_de_nac'];
                            $fecha_muerte = $lineaDatos['fecha_muerte'];
                                   
                    }
                    else{
                        echo "No existen clientes registradoos";   
                    }

                    mysqli_close($cn);    
                ?>
            </div>
        </div>
        <div class="row colBotones" align="right">
            <div class="col-12 ">
                <button type="button" class="btn btn-outline-success">Alta</button>
                <button type="button" class="btn btn-outline-danger">Baja</button>
                <button type="button" class="btn btn-outline-primary">Actualizar</button>
            </div>
        </div>
    </div>
</body>
</html>