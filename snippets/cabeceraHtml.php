<?php
    function mostrarCabecera($lineasCabecera = '', $titulo = 'Veterinaria San Antón', $styles = true){
?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="icon" href="recursos/logoVeterinaria.png">
                <?php echo "<title>" . $titulo . "</title>" ?>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">                
<?php
                if($styles) echo "<link rel='stylesheet' href='styles/styles.css' type='text/css'>";
                if(!empty($lineasCabecera)) echo $lineasCabecera;
?>
            </head>
<?php
    }
?>
