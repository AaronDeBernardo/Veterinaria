<?php
    include_once('snippets/cabeceraHtml.php');
    mostrarCabecera("<link rel='stylesheet' href='styles/stylesFAQ.css' type='text/css'>", "Preguntas Frecuentes", false);
?>

<body>
    <?php include_once 'snippets/menuSuperior.php';?>
    <div class="container-fluid p-0 m-0">
        <div class="row" id="row1">
            <div class="col-12">
                <h1 class="titulos">Preguntas</h1>
            </div>
        </div>
        <div class="row my-5 py-3" id="row2">
            <div class="col-md-2 d-none d-md-block"></div>
            <div class="col-12 col-md-2 my-2 d-flex justify-content-center btnSeccion">
                <form style="display: inline" action="#cuidadoGeneral" method="get">
                    <button class="btn btn-warning fs-4 fst-italic fw-bold">CUIDADOS GENERALES</button>
                </form>
            </div>
            <div class="col-md-1 d-none d-md-block"></div>
            <div class="col-12 col-md-2 my-2 d-flex justify-content-center btnSeccion">
                <form style="display: inline" action="#salud" method="get">
                    <button class="btn btn-warning fs-4 fst-italic fw-bold">SALUD</button>
                </form>
            </div>
            <div class="col-md-1 d-none d-md-block"></div>
            <div class="col-12 col-md-2 my-2 d-flex justify-content-center btnSeccion">
                <form style="display: inline" action="#veterinaria" method="get">
                    <button class="btn btn-warning fs-4 fst-italic fw-bold">VETERINARIA</button>
                </form>
            </div>
            <div class="col-md-2 d-none d-md-block"></div>
        </div>
        <div class="row" id="row3">
            <h1 class= "titulos mb-3 mx-0 " id="cuidadoGeneral">Cuidado General</h1><br>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Con qué frecuencia debo llevar a mi mascota a chequeos regulares?</div>
                    <div class="card-body">
                            <ul>
                                <li>En general, un chequeo anual es recomendado para todas las mascotas.</li>
                                <li>Cachorros, animales mayores y aquellos con enfermedades crónicas pueden necesitar chequeos más frecuentes.</li>
                                <li>Los chequeos regulares son importantes para prevenir problemas de salud y mantener a tu mascota sana.</li>
                            </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Cómo puedo prevenir las pulgas, garrapatas y parásitos intestinales en mi mascota?</div>
                    <div class="card-body">
                            <ul>
                                <li>Baña a tu mascota con la frecuencia adecuada utilizando un champú antiparasitario específico para perros o gatos.</li>
                                <li>Utiliza productos antiparasitarios como collares, pipetas o comprimidos, siguiendo estrictamente las instrucciones del veterinario.</li>
                                <li>Desparasita internamente a tu mascota según el plan recomendado por el veterinario, utilizando medicamentos específicos.</li>
                            </ul>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Con qué frecuencia debo bañar a mi mascota?</div>
                    <div class="card-body">
                        
                        <p class="card-text">La frecuencia con la que debes bañar a tu mascota depende de varios factores, como su raza, tipo de pelo,
                             estilo de vida y nivel de actividad. Sin embargo, en general, no se recomienda bañarlos más de una vez al mes, e incluso en algunos casos,
                              con dos baños al año sería suficiente. Bañar a tu mascota con demasiada frecuencia puede eliminar los aceites naturales de su piel y pelaje,
                               lo que puede provocar sequedad, irritación, picazón y problemas en la piel.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Cuando puedo esterilizar o castrar a mi mascota?</div>
                    <div class="card-body">
                        
                        <p class="card-text">La esterilización o castración es una cirugía común y segura que se realiza en perros y gatos para eliminar sus órganos reproductivos</p>
                        <ul>
                            <li>
                            Perros: Se recomienda entre los 6 y 8 meses de edad, aunque en algunas razas se puede realizar antes o después.
                            </li>
                            <li>
                            Gatos: Se recomienda entre los 4 y 6 meses de edad, aunque en algunas razas se puede realizar antes o después.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="row4">
            <h1 class= "titulos mb-3 mx-0" id="salud">Salud</h1><br>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Cuáles son los signos de una enfermedad grave en mi mascota?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Detectar a tiempo los signos de una enfermedad grave en tu mascota puede ser crucial para brindarle el tratamiento adecuado y aumentar sus posibilidades de recuperación.
                        Prestar atención a los cambios en el comportamiento y la salud física de tu mascota te permitirá identificar posibles problemas de salud y buscar ayuda veterinaria de manera oportuna.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Qué debo hacer si mi mascota tiene una lesión en la piel?</div>
                    <div class="card-body">
                        <ul>
                            <li>Limpiar la lesión: límpiar suavemente con agua tibia y jabón antibacteriano.</li>
                            <li>Seca la zona con una gasa limpia o una toalla suave.</li>
                        </ul>
                        <p>Sin embargo, si la lesión es grande, profunda, presenta signos de infección (pus, enrojecimiento, hinchazón, calor) o tu mascota muestra signos de dolor o incomodidad, debes llevarla al veterinario de inmediato.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Qué debo hacer si mi mascota cojea o tiene dolor en las articulaciones?</div>
                    <div class="card-body">
                        
                        <p class="card-text">La cojera o el dolor articular son problemas comunes en mascotas, especialmente en perros y gatos de edad avanzada.
                                            Si notas que tu mascota cojea, tiene dificultad para moverse o muestra signos de dolor en las articulaciones, es importante que la lleves al veterinario para determinar la causa y recibir el tratamiento adecuado.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Qué debo hacer si mi mascota parece estar deprimida o letárgica?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Si observas que tu mascota se encuentra desanimada, apática o letárgica, es importante prestar atención y tomar medidas para identificar la causa y brindarle el cuidado adecuado.
                                        La depresión o letargo en mascotas puede deberse a diversos factores, algunos de ellos relacionados con la salud física y otros con el estado emocional o conductual. 
                                        Lo recomendable es visitar al veterinario que te recomiende medicamentos o algún tratamiento</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="row5">
            <h1 class= "titulos mb-3 mx-0 " id="veterinaria">Veterinaria</h1><br>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Cuánto cuesta una visita al veterinario?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Para eso debes contactarnos a través del formulario que se encuentra en UBICACIÓN o bien clickear el siguiente link!</p>
                        <a href="nuestraUbicacion.php">Enviar Consulta</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Qué debo hacer si tengo una emergencia con mi mascota?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Al momento que sufras una emergencia con tu mascota comunicate con nosotros al numero de emergencia que se encuentra al final de la página</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Cómo obtengo un turno con un especialista en San Antón?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Para eso debes contactarnos a través del formulario que se encuentra en UBICACIÓN solicitando turno para lo que estes necesitando</p>
                        <a href="nuestraUbicacion.php">Obtener Turno</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card rounded-5 border-warning border-4 mb-3 mx-0">
                    <div class="card-header rounded-top-5 preguntas">¿Qué horarios trabajan?</div>
                    <div class="card-body">
                        
                        <p class="card-text">Nuestros horarios son de 08:00hs a 19:00hs todos los dias, en caso de necesitar un veterinario fuera de ese horario por favor comuniquese con el numero de emergencias que se encuentra al pie de página</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include_once 'snippets/footer.php';?> 
</body>
</html>