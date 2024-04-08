<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesNuestrosServicios.css" type="text/css">
    <link rel="icon" href="Recursos/logoVeterinaria.png">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once 'menuSuperior.php';
    ?>

    <div class="container-fluid bg-secondary px-5 pb-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center ">
                <h1 class="py-3" id="titulo">
                    Nuestros Servicios
                </h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card cardServicios">
                    <img src="Recursos/Servicios/cuidadoDeAnimales.jpg" class="card-img-top rounded-top cardImage" alt="Cuidado de Animales">
                    <div class="card-body">
                        <h5 class="card-title text-decoration-underline">Cuidado de animales</h5>
                        <p class="card-text">En San Antón queremos que tu mascota tenga una vida larga y saludable. Por eso, ofrecemos una amplia gama de servicios veterinarios de alta calidad, incluyendo:</p>
                        <ul>
                            <li>Examenes Fisicos Completos</li>
                            <li>Desparasitación interna y externa</li>
                            <li>Asesoramiento sobre alimentación</li>
                        </ul>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            QUIERO SABER MAS!
                        </button>
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Información</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <p class="fw-bold">1. Exámenes Físicos Completos:</p>
                                        <p>    Evaluación integral de la salud de tu mascota: Se revisa el estado general, incluyendo pelaje, ojos, oídos, dientes, corazón, pulmones, abdomen y extremidades.
                                            Detección temprana de enfermedades: Permite identificar problemas de salud en sus primeras etapas para un tratamiento oportuno.
                                            Prevención de enfermedades: Se pueden recomendar medidas para mantener a tu mascota sana y prevenir futuros problemas.</p>
                                    
                                        <p class="fw-bold">2. Desparasitación Interna y Externa:</p>
                                        <p>    Eliminación de parásitos internos y externos: Protege a tu mascota de parásitos como lombrices, garrapatas, pulgas y mosquitos.
                                            Prevención de enfermedades: Los parásitos pueden transmitir enfermedades graves a tu mascota y a las personas.
                                            Mejora de la salud y bienestar: Tu mascota estará más sana y tendrá más energía.
                                        </p>
                                        <p class="fw-bold">3. Asesoramiento sobre Alimentación:</p>
                                        <p>    Recomendaciones personalizadas para la dieta de tu mascota: Se consideran factores como la edad, raza, actividad física y estado de salud.
                                            Prevención de problemas de salud: Una dieta adecuada puede prevenir problemas como la obesidad, desnutrición y enfermedades del tracto digestivo.
                                            Mejora de la calidad de vida: Tu mascota tendrá una mejor calidad de vida y una mayor esperanza de vida.
                                        </p>
                                        <p class="fst-italic fw-bold">¡Recuerda que la salud de tu mascota es lo más importante. Estos servicios veterinarios son esenciales para mantenerla sana y feliz!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" onclick="location.href='nuestraUbicacion.php'">Contactanos!</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cardServicios">
                    <img src="Recursos/Servicios/cuidadosMedicinales.jpg" class="card-img-top rounded-top cardImage" alt="Cuidados Medicinales">
                    <div class="card-body">
                        <h5 class="card-title text-decoration-underline">Cuidados Medicinales</h5>
                        <p class="card-text">
                            <p class="card-text">¡Tu mejor amigo esta en las mejores manos!</p>
                            <p class="card-text">San Antón ofrece una atención integral con los más altos estándares de calidad médica, incluyendo:</p>
                            <ul>
                                <li>Rayos X</li>
                                <li>Cirugias</li>
                                <li>Vacunas</li>
                                <li>Alimentacion</li>

                            </ul>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    QUIERO SABER MAS!
                            </button>
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Información</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fw-bold">1. Rayos X:</p>
                                            <ul>
                                                <li>
                                                Diagnóstico preciso: Permite obtener imágenes detalladas del interior del cuerpo de tu mascota para diagnosticar problemas de salud como fracturas, enfermedades pulmonares o tumores.
                                                </li>
                                                <li>
                                                Procedimientos seguros: Se utilizan técnicas seguras y de baja radiación para minimizar la exposición de tu mascota
                                                </li>
                                                <li>
                                                Equipo moderno: Contamos con equipos de rayos X modernos y de alta calidad para obtener imágenes precisas.
                                                </li>
                                            </ul>
                                            <p class="fw-bold">2. Cirugías:</p>
                                            <ul>
                                                <li>
                                                    Atención especializada: Ofrecemos una amplia gama de cirugías, desde procedimientos simples hasta complejos, por parte de un equipo de veterinarios altamente calificados.
                                                </li>
                                                <li>
                                                    Anestesia segura: Utilizamos protocolos de anestesia seguros y monitoreamos a tu mascota durante todo el procedimiento.   
                                                </li>
                                                <li>
                                                    Cuidado postoperatorio: Brindamos atención postoperatoria personalizada para que tu mascota se recupere de manera segura y confortable.
                                                </li>
                                            </ul>
                                            <p class="fw-bold">3. Vacunas:</p>
                                                <ul>
                                                    <li>
                                                    Prevención de enfermedades: Protegemos a tu mascota de enfermedades graves como la rabia, el moquillo y la parvovirosis mediante la vacunación.
                                                    </li>
                                                    <li>
                                                    Plan de vacunación personalizado: Creamos un plan de vacunación individualizado que se ajusta a la edad, raza y estilo de vida de tu mascota.
                                                    </li>
                                                    <li>
                                                    Asesoramiento experto: Te brindamos asesoramiento sobre las diferentes opciones de vacunas disponibles y respondemos a todas tus preguntas.  
                                                    </li>
                                                </ul>
                                            <p class="fw-bold">4. Alimentación:</p>
                                                <ul>
                                                    <li>
                                                    Nutrición adecuada: Te ayudamos a elegir la mejor dieta para tu mascota, considerando su edad, raza, actividad física y necesidades especiales.
                                                    </li>
                                                    <li>
                                                    Asesoramiento personalizado: Te brindamos asesoramiento personalizado sobre la alimentación de tu mascota y te ayudamos a resolver cualquier problema que pueda tener.  
                                                    </li>
                                                </ul>
                                            <p class="fw-bold">¡En nuestra clínica veterinaria, nos comprometemos a brindar a tu mascota la mejor atención posible. Contamos con un equipo de profesionales altamente calificados y con la tecnología más avanzada para cuidar de la salud de tu amigo peludo.!</p>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" onclick="location.href='nuestraUbicacion.php'">Contactanos!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cardServicios">
                    <img src="Recursos/Servicios/cuidadosEsteticos.jpg" class="card-img-top rounded-top cardImage" alt="Cuidados Estéticos">
                    <div class="card-body">
                        <h5 class="card-title text-decoration-underline">Cudados Estéticos</h5>
                        <p class="card-text">¡Tu mejor amigo, radiante por dentro y por fuera!</p>
                        <p class="card-text">San Antón quiere que tu mascota no solo se sienta bien, sino que también se vea fabulosa. Por eso, ofrecemos:</p>
                        <ul>
                            <li>Baños Animales</li>
                            <li>Peluquería</li>
                            <li>Limpieza de oídos</li>
                            <li>Cuidado Dental</li>
                            <li>Cepillado corporal</li>
                            <li>Corte de uñas</li>
                        </ul>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                QUIERO SABER MAS!
                        </button>
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Información</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fw-bold">1. Baños Animales</p>
                                            <ul>
                                                <li>
                                                Limpieza profunda: Eliminamos la suciedad, el polvo y los alérgenos del pelaje de tu mascota, dejándola limpia y fresca.
                                                </li>
                                                <li>
                                                Productos de alta calidad: Utilizamos champús y acondicionadores de alta calidad específicos para el tipo de pelaje de tu mascota.
                                                </li>
                                                <li>
                                                Cuidado personalizado: Brindamos un baño personalizado que se ajusta a las necesidades de tu mascota.
                                                </li>
                                            </ul>
                                        <p class="fw-bold">2. Peluquería</p>
                                            <ul>
                                                <li>Estilos modernos: Ofrecemos una amplia gama de estilos de corte de pelo para que tu mascota luzca elegante y adorable.</li>
                                                <li>Cuidado del pelaje: Te ayudamos a mantener el pelaje de tu mascota sano y libre de enredos.</li>
                                                <li>Asesoramiento experto: Te brindamos asesoramiento sobre el mejor estilo de corte de pelo para tu mascota.</li>
                                            </ul>
                                        <p class="fw-bold">3. Limpieza de oidos</p>
                                            <ul>
                                                <li>
                                                Prevención de infecciones: Eliminamos la cera y la suciedad de los oídos de tu mascota para prevenir infecciones.
                                                </li>
                                                <li>
                                                Cuidado delicado: Limpiamos los oídos de tu mascota de forma segura y delicada.
                                                </li>
                                                <li>
                                                Prevención de molestias: Ayudamos a prevenir molestias y picazón en los oídos de tu mascota.
                                                </li>
                                            </ul>
                                        <p class="fw-bold">4. Cuidado Dental</p>
                                            <ul>
                                                <li>
                                                Prevención de enfermedades: Realizamos limpieza dental profesional para eliminar el sarro y prevenir enfermedades bucales.
                                                </li>
                                                <li>
                                                Aliento fresco: Ayudamos a mantener el aliento de tu mascota fresco y saludable.
                                                </li>
                                                <li>
                                                Cuidado preventivo: Te brindamos consejos para el cuidado dental en casa de tu mascota.
                                                </li>
                                            </ul>
                                        <p class="fw-bold">5. Cepillado Corporal</p>
                                            <ul>
                                                <li>
                                                Eliminación de pelo muerto: Eliminamos el pelo muerto y la suciedad del pelaje de tu mascota.
                                                </li>
                                                <li>
                                                Mejora de la circulación: Estimulamos la circulación sanguínea y la producción de aceites naturales del pelaje.
                                                </li>
                                                <li>
                                                Prevención de enredos: Ayudamos a prevenir la formación de enredos en el pelaje de tu mascota.  
                                                </li>
                                            </ul>
                                        <p class="fw-bold">6. Corte de Uñas</p>
                                            <ul>
                                                <li>
                                                Prevención de lesiones: Cortamos las uñas de tu mascota de forma segura y cómoda para evitar que se lastime o lastime a otros. 
                                                </li>
                                                <li>
                                                Prevención de molestias: Ayudamos a prevenir molestias y dolor en las patas de tu mascota.  
                                                </li>
                                            </ul>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" onclick="location.href='nuestraUbicacion.php'">Contactanos!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cardServicios">

                    <img src="Recursos/Servicios/arriendoJaulas.jpg" class="card-img-top rounded-top cardImage" alt="Otros Servicios">
                    <div class="card-body">
                        <h5 class="card-title text-decoration-underline">Otros</h5>
                        <p class="card-text">¡Tu peludo se merece lo mejor!</p>
                        <p class="card-text">Por eso, ofrecemos una amplia gama de servicios adicionales que te facilitarán la vida y te ayudarán a cuidar de tu mejor amigo:</p>
                        <ul>
                            <li>Traslados a domicilio</li>
                            <li>Viajes largos</li>
                            <li>Hospitalización</li>
                        </ul>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                QUIERO SABER MAS!
                        </button>
                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Dejanos tus datos!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fw-bold">1. Traslados a Domicilio</p>
                                            <ul>
                                                <li>
                                                Comodidad y seguridad: Ofrecemos un servicio de transporte seguro y cómodo para tu mascota, desde su casa hasta nuestra clínica y viceversa.
                                                </li>
                                                <li>
                                                Atención personalizada: Brindamos atención personalizada a tu mascota durante el traslado.
                                                </li>
                                                <li>
                                                Profesionales capacitados: Contamos con un equipo de profesionales capacitados en el manejo y transporte de animales.
                                                </li>
                                            </ul>
                                        <p class="fw-bold">2. Viajes Largos</p>
                                            <ul>
                                                <li>
                                                Planificación y logística: Nos encargamos de la planificación y logística del viaje de tu mascota, incluyendo la obtención de los permisos necesarios y el transporte seguro.
                                                </li>
                                                <li>
                                                Cuidado durante el viaje: Brindamos atención y cuidado a tu mascota durante todo el viaje.
                                                </li>
                                                <li>
                                                Seguimiento y monitoreo: Monitoreamos el estado de tu mascota durante el viaje y te mantenemos informado. 
                                                </li>
                                            </ul>
                                        <p class="fw-bold">3. Hospitalización</p>
                                            <ul>
                                                <li>
                                                Atención médica especializada: Ofrecemos atención médica especializada para tu mascota en caso de que necesite ser hospitalizada.
                                                </li>
                                                <li>
                                                Monitoreo constante: Monitoreamos constantemente el estado de tu mascota durante su hospitalización.  
                                                </li>
                                                <li>
                                                Comunicación constante: Te mantenemos informado sobre el estado de salud de tu mascota y la evolución de su tratamiento.
                                                </li>
                                            </ul>
                                        <p class="fw-bold">En nuestra clínica veterinaria, nos comprometemos a brindar a tu mascota la mejor atención posible, tanto dentro como fuera de nuestro centro. Ofrecemos una amplia gama de servicios de transporte y alojamiento para que tu amigo peludo se sienta seguro y cómodo en todo momento.</p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" onclick="location.href='nuestraUbicacion.php'">Contactanos!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="row py-5">
            <div class="col-xs-12 col-lg-6  d-flex justify-content-center ">
                <div class="card mb-3" style="max-width: 540px; height: 420px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="Recursos/Servicios/cuidadoDeAnimales.jpg" class="img-fluid rounded-start" alt="Cuidado de animales">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-decoration-underline ">Cuidado de Animales</h5>
                                <p class="card-text">
                                    En San Antón queremos que tu mascota tenga una vida larga y saludable. Por eso, ofrecemos una amplia gama de servicios veterinarios de alta calidad, incluyendo:
                                </p>
                                <ul>
                                    <li>Examenes Fisicos Completos</li>
                                    <li>Desparasitación interna y externa</li>
                                    <li>Asesoramiento sobre alimentación</li>
                                </ul>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    QUIERO SABER MAS!
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dejanos tus datos!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Colocar form de contacto y que envie mail a la secretaria
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6 d-flex justify-content-center ">
            <div class="card mb-3" style="max-width: 540px; height: 420px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="Recursos/Servicios/cuidadosMedicinales.jpg" class="img-fluid rounded-start" alt="Cuidados Medicinales">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-decoration-underline">Cuidados Medicinales</h5>
                                <p class="card-text">¡Tu mejor amigo esta en las mejores manos!</p>
                                <p class="card-text">San Antón ofrece una atención integral con los más altos estándares de calidad médica, incluyendo:</p>
                                <ul>
                                    <li>Rayos X</li>
                                    <li>Cirugias</li>
                                    <li>Vacunas</li>
                                    <li>Alimentacion</li>
                                    <li>Farmacia</li>
                                </ul>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        QUIERO SABER MAS!
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dejanos tus datos!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Colocar form de contacto y que envie mail a la secretaria
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-lg-6 d-flex justify-content-center ">
            <div class="card mb-3" style="max-width: 540px; height: 420px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="Recursos/Servicios/cuidadosEsteticos.jpg" class="img-fluid rounded-start" alt="Cuidados Esteticos">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-decoration-underline">Cuidados Estéticos</h5>
                                <p class="card-text">¡Tu mejor amigo, radiante por dentro y por fuera!</p>
                                <p class="card-text">San Antón quiere que tu mascota no solo se sienta bien, sino que también se vea fabulosa. Por eso, ofrecemos:</p>
                                <ul>
                                    <li>Baños Animales</li>
                                    <li>Peluquería</li>
                                    <li>Limpieza de oídos</li>
                                    <li>Cuidado Dental</li>
                                    <li>Cepillado corporal</li>
                                    <li>Corte de uñas</li>
                                </ul>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        QUIERO SABER MAS!
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dejanos tus datos!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Colocar form de contacto y que envie mail a la secretaria
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6 d-flex justify-content-center ">
            <div class="card mb-3" style="max-width: 540px; height: 420px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="Recursos/Servicios/arriendoJaulas.jpg" class="img-fluid rounded-start" alt="Otros Servicios">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-decoration-underline">Otros</h5>
                                <p class="card-text">¡Tu peludo se merece lo mejor!</p>
                                <p class="card-text">Por eso, ofrecemos una amplia gama de servicios adicionales que te facilitarán la vida y te ayudarán a cuidar de tu mejor amigo:</p>
                                <ul>
                                    <li>Traslados a domicilio</li>
                                    <li>Viajes largos</li>
                                    <li>Hospitalización</li>
                                </ul>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        QUIERO SABER MAS!
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dejanos tus datos!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Colocar form de contacto y que envie mail a la secretaria
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        -->

    </div>
    <?php 
        include_once 'footer.php';
    ?> 
</body>
</html>