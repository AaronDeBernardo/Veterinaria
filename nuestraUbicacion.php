<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/stylesLocation.css" type="text/css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
    <title>Nuestra Ubicación</title>

</head>
<body>

    <?php 
    include_once 'snippets/menuSuperior.php';
    ?>
    <div class="container-fluid my-4 px-5">
        <div class="row">
            <div class="col-12 col-md-7 p-0 border border-warning border-4 rounded-5 mt-3 mb-2">
                <iframe title="Ubicación Google Maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3347.8704282892736!2d-60.64630682359547!3d-32.95443017228297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab11d0eb49c3%3A0x11f1d3d54f950dd0!2sUniversidad%20Tecnol%C3%B3gica%20Nacional%20%7C%20Facultad%20Regional%20Rosario!5e0!3m2!1ses!2sar!4v1711402786413!5m2!1ses!2sar" class="rounded-5 map" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-1 d-none d-md-block">

            </div>
            <div class="col-12 col-md-4 bg-light rounded-5 pt-4 mt-2 flex-wrap border border-warning border-4 ">
                <form class="row g-2" action="https://formsubmit.co/0be7fe7fd9fcaaaf56ee408af67cb498" method="POST">
                    <h1 class="text-secondary border-bottom border-warning border-5">Dejanos tu consulta!</h1>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Nombre" placeholder="Nombre" title="Nombre">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Apellido" placeholder="Apellido" title="Apellido">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Ciudad" placeholder="Ciudad" title="Ciudad">
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" name="CodPostal" placeholder="Código Postal" title="Código postal">
                    </div>

                    <div class="col-12">
                        <input type="text" class="form-control" name="Direccion" placeholder="Dirección" title="Dirección">
                    </div>
                    <div class="col-12">
                        <input type="email" class="form-control" name="Email" placeholder="Email" title="Email">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="CodArea" placeholder="Cód. Área" title="Código de área">
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="Telefono" placeholder="Teléfono" title="Teléfono">
                    </div>
                    <div class="col-12">
                        <select class="form-select" name="Motivo" aria-label="Floating label select example" title="motivo">
                            <option selected disabled>Seleccione el motivo...</option>
                            <option value="CuidadosAnimales">Cuidados Animales</option>
                            <option value="CuidadosMedicinales">Cuidados Medicinales</option>
                            <option value="CuidadosEsteticos">Cuidados Estéticos</option>
                            <option value="OtrosServicios">Otros Servicios</option>
                        </select>
                    </div>
                    <div class="form">
                        <textarea class="form-control" name="Problema" placeholder="Describa su consulta: " title="Describa su consulta: "></textarea>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-warning mb-4 mt-2">Enviar Consulta</button>
                    </div>
                    <input type="hidden" name="_next" value="http://localhost:8080">
                    <input type="hidden" name="_captcha" value="false">
                </form>
            </div>
        </div>
    </div>
    <?php 
    include_once 'snippets/footer.php';
    ?>
</body>
</html>