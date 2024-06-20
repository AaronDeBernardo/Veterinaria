<?php
    include_once('snippets/cabeceraHtml.php');
    mostrarCabecera("<link rel='stylesheet' href='styles/stylesLocation.css' type='text/css'>", 'Nuestra Ubicación', false);
?>

<body>
    <?php include_once 'snippets/menuSuperior.php'; ?>
    
    <div class="container-fluid my-4 px-5">
        <div class="row">
            <div class="col-12 col-md-7 p-0 border border-warning border-4 rounded-5 mt-3 mb-2">
                <iframe title="Ubicación Google Maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3347.8704282892736!2d-60.64630682359547!3d-32.95443017228297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab11d0eb49c3%3A0x11f1d3d54f950dd0!2sUniversidad%20Tecnol%C3%B3gica%20Nacional%20%7C%20Facultad%20Regional%20Rosario!5e0!3m2!1ses!2sar!4v1711402786413!5m2!1ses!2sar" class="rounded-5 map" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-1 d-none d-md-block">

            </div>
            <div class="col-12 col-md-4 bg-light rounded-5 pt-4 mt-2 flex-wrap border border-warning border-4 ">
                <form class="row g-2" action="snippets/enviarMail.php" method="POST">
                    <input type="hidden" name="operacion" value="consulta">
                    <h1 class="text-secondary border-bottom border-warning border-5">Dejanos tu consulta!</h1>
                    <div class="col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" id="ciudad">
                    </div>
                    <div class="col-6">
                        <label for="codigoPostal">Codigo Postal</label>
                        <input type="number" class="form-control" name="codPostal" id="codigoPostal">
                    </div>

                    <div class="col-12">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    <div class="col-12">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="area">Cod. Área</label>
                        <input type="number" class="form-control" name="codArea" id="area" required>
                    </div>
                    <div class="col-md-8">
                        <label for="cel">Teléfono</label>
                        <input type="number" class="form-control" name="telefono" id="cel" required>
                    </div>
                    <div class="col-12">
                        <label for="motivo">Motivo</label>
                        <select class="form-select" name="motivo" id="motivo" aria-label="Floating label select example" required>
                            <option selected disabled value="">Seleccione el motivo...</option>
                            <option value="CuidadosAnimales">Cuidados Animales</option>
                            <option value="CuidadosMedicinales">Cuidados Medicinales</option>
                            <option value="CuidadosEsteticos">Cuidados Estéticos</option>
                            <option value="OtrosServicios">Otros Servicios</option>
                        </select>
                    </div>
                    <div class="form">
                        <label for="consulta">Consulta</label>
                        <textarea class="form-control" name="problema" id="consulta" title="Describa su consulta" required></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php 
    include_once 'snippets/footer.php';
    include_once 'snippets/mostrarAlerta.php'
    ?>
</body>
</html>