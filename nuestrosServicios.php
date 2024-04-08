<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css?v=" type="text/css">
    <link rel="icon" href="Recursos/logoVeterinaria.png">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once 'menuSuperior.php';
    ?>
    <h1></h1>
    <div class="container">
        <div class="row">
            <div class="col-12 borde" style="background-color: rgb(207, 181, 146);">SERVICIOS</div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 borde" style="background-color: antiquewhite; min-height: 100px;">
                
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <div class="row">
                    <div class="col-12 borde" style="background-color: rgb(175, 138, 59); min-height: 100px;">
                        <div class="alert alert-success" style="margin-top: 15px;" >
                            <strong> La veterinaria ofrece una serie de Servicios y cuidados</strong>
                        </div>
                    </div>
                </div>

              
                <div class="row ">
                        <div class="col-6 col-md-4 borde " style="background-color: rgb(169, 213, 232); min-height: 100px; ">
                          <div class="card " style="width: 80%; background-color: beige; " >
                            <img src="Recursos/Servicios/cuidadoDeAnimales.jpg" class="card-img-top" alt="Cuidado de Animales" >
                            <div class="card-body">
                                <h5 class="card-title">Cuidado de Animales</h5>
                                <p class="card-text">Atención médica:
                                    <ul>
                                        <li>Examenes Fisicos</li>
                                        <li>Desparasitación</li>
                                        <li>Asesoramiento sobre alimentación</li>

                                    </ul>
                                </p>

        
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 borde" style="background-color: rgb(169, 213, 232); min-height: 100px;">
                        <div class="card" style="width: 80%; background-color: beige; height: 372px" ">
                            <img src="Recursos/Servicios/cuidadosMedicinales.jpg " class="card-img-top " alt="Cuidados Medicinales " >
                            <div class="card-body ">
                              <h5 class="card-title ">Cuidados Medicinales</h5>
                              <p class="card-text ">
                                <ul>
                                    <li>Rayos X</li>
                                    <li>Cirugias</li>
                                    <li>Vacunas</li>
                                    <li>Alimentacion</li>
                                    <li>Farmacia</li>
                                </ul>
                              </p>
                              
                            </div>
                          </div>
                        </div>

                        <div class="d-none d-md-block col-md-4 borde " style="background-color: rgb(169, 213, 232); min-height: 100px; ">
                          <div class="card " style="width: 80%; background-color: beige; height: 372px" >
                            <img src="Recursos/Servicios/cuidadosEsteticos.jpg" class="card-img-top" alt="Cuidados Esteticos" >
                            <div class="card-body">
                                <h5 class="card-title">Cuidados Esteticos</h5>
                                <p class="card-text">
                                    <ul>
                                        <li>Baños</li>
                                        <li>Peluqueria</li>
                                        <li>Limpieza de oídos</li>
                                        <li>Cuidado Dental</li>
                                    </ul>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 col-md-4 borde" style="background-color: rgb(169, 213, 232); min-height: 100px;">
                        <div class="card" style="width: 80%; background-color: beige; height: 395px" ">
                      <img src="Recursos/Servicios/arriendoJaulas.jpg " class="card-img-top " alt="Arriendo De Jaulas " height="167">
                      <div class="card-body ">
                        <h5 class="card-title ">Arriendo De Jaulas</h5>
                        <p class="card-text ">
                            <ul>
                                <li>Traslados a domicilio</li>
                                <li>Viajes largos</li>
                                <li>Hospitalización</li>
                            </ul>
                        </p>
                        
                      </div>
                    </div>
                  </div>

                  <div class="col-6 col-md-4 borde " style="background-color: rgb(169, 213, 232); min-height: 100px; ">
                    <div class="card " style="width: 80%; background-color: beige; height: 395px">
                            <img src="Recursos/Servicios/acupuntura.jpg" class="card-img-top" alt="Acupuntura" >
                            <div class="card-body">
                                <h5 class="card-title">Acupuntura</h5>
                                <p class="card-text">
                                    <ul>
                                        <li>Alivio del Dolor</li>
                                        <li>Mejora de la función circulatoria</li>
                                        <li>Regulación del sistema inmunológico</li>
                                        <li>Promoción del bienestar general</li>
                                    </ul>
                                </p>
                                
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block col-md-4 borde" style="background-color: rgb(169, 213, 232); min-height: 100px;">
                        <div class="card" style="width: 80%; background-color: beige; height: 395px ">
                            <img src="Recursos/Servicios/ventaProductos2.jpg" class="card-img-top" alt="Venta de Productos" >
                            <div class="card-body">
                                <h5 class="card-title">Venta de Productos</h5>
                                <p class="card-text">
                                    <ul>
                                        <li>Alimentos Balanceados</li>
                                        <li>Salud e Higiene</li>
                                        <li>Accesorios</li>
                                    </ul>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-6 borde" style="min-height: 100px; background-color: rgb(235, 171, 129);"></div>

                    <div class="col-md-8 col-6 borde" style="min-height: 100px; background-color: rgb(235, 171, 129); max-height: max-content;" align="center">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php';?> 
    </div>
</body>
</html>