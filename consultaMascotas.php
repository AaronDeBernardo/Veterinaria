<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente'){
        header('Location: index.php');
        die();
    }
    
    include_once 'consultasdb/connection.php';

    $filtro = '';
    if (isset($_POST['soloMascotasVivas']))
    {
        if ($_POST['soloMascotasVivas'] == 'vivas'){
            setcookie('soloMascotasVivas', true, time() + (60 * 60 * 24 * 365 * 5), "/");
            $filtro = "AND ISNULL(fecha_muerte)";
        }
        else{
            unset($_COOKIE['soloMascotasVivas']);
            setcookie('soloMascotasVivas', '', time() - 3600, '/');
        }
    }
    else if (isset($_COOKIE['soloMascotasVivas']))
        $filtro = "AND ISNULL(fecha_muerte)";


    $query = "SELECT id, nombre, foto, raza, color, fecha_de_nac, fecha_muerte FROM mascotas WHERE baja = 0 AND cliente_id = $_SESSION[cliente_id] $filtro ORDER BY nombre";
    $mascotas = consultaSQL($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria San Antón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <link rel="stylesheet" href="styles/stylesMascotas.css" type="text/css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
</head>
<body>
    <?php include_once 'snippets/menuSuperior.php' ?>    

    <div class="container-fluid p-0'">
        <div class="row">
            <?php $_SESSION['item'] = 'mascotas'; include_once 'snippets/menuLateral.php'; ?>
            <div class="col-12 col-md-4 col-lg-5 col-xl-4 mt-3">
                
                <div id="div-filtro">
                    <button type="button" class="btn btn-secondary" style="margin-bottom:10px" data-bs-toggle="collapse" data-bs-target="#formFiltro">Filtrar</button>
                </div>

                <form action="#" method="POST" id="formFiltro" class="collapse bg-light rounded-5 pt-4 mt-2 flex-wrap border border-warning border-4" style="margin-bottom:20px">
                    <div class="form-group">
                        <input type="hidden" name="soloMascotasVivas" value="todas">
                        <input type="checkbox" name="soloMascotasVivas" value="vivas" id="checkMascotas" <?php echo $filtro ? "checked" : "" ?>>
                        <label for="checkMascotas">Sólo mascotas vivas</label>
                    </div>
                    <div style="text-align:center; margin-bottom:10px;">
                        <button type="submit" class="btn btn-secondary">Aceptar</button>
                    </div>
                </form>

                <div id="div_tabla">
                    <table class="table">
                        <thead class="border-3 border-warning">
                            <tr>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Color</th>
                                <th>Fecha de nacimiento</th>
<?php                           if (!$filtro)
                                    echo "<th>Fecha de muerte</th>"?>
                            </tr>
                        </thead>
                        <tbody class="border-3 border-warning">
<?php
    foreach ($mascotas as $m){
?>
                            <?php echo "<tr id=mascota_id:$m[id] onclick=mostrarFoto(this)>"?>
                                <td><?php echo $m['nombre'] ?></td>
                                <td><?php echo $m['raza'] ?></td>
                                <td><?php echo $m['color'] ?></td>
                                <td><?php echo $m['fecha_de_nac'] ?></td>
<?php                           if (!$filtro)
                                    echo "<td>$m[fecha_muerte]</td>"?>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-5">
                <div id="div-separacion">&nbsp;</div>
                <div class="tab-content" id="nav-tabContent">
                <?php
                foreach ($mascotas as $m){
                    echo "<div class='tab-pane fade tarjeta_mascota' role=tabpanel id=list-mascota:$m[id]>";
                        echo "<div class=card>";
                        if (!empty($m['foto'])){
                        ?>
                            <img class='card-img-top' src="data:image/jpeg;base64,<?php echo base64_encode($m['foto'])?>" <?php echo "alt='Foto de $m[nombre]'"?>>
                        <?php
                        }
                            
                        if (empty($m['foto']))
                        {
                            echo "<div class=card-body>";
                            echo "<p class=card-text>La mascota no tiene foto</p>";
                            echo "</div>";
                        }  
                        echo "</div>";
                    echo "</div>";
                }
                ?>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="scripts/scriptConsultaMascotas.js"></script>
</body>
</html>