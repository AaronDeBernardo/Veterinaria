<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styles/stylesNuestraEmpresa.css" type="text/css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
</head>
<body>
    <?php 
        include_once 'snippets/menuSuperior.php';
    ?>
    <div class="container-fluid px-0">
        <div class="row" id="row1">
            <div class="col-12">
                <h1 class="titulos">Nosotros</h1>
            </div>
        </div>
        <div class="row row2" >
            <div class="col-12" >
                <h1 class= "titulos" style="font-size: 50px; filter: brightness(0.95);">¿Quienes Somos?</h1><br>
                <p class="textoEmpresa fs-4" >San Antón es una clínica veterinaria dedicada a brindar atención médica integral de la más alta calidad para sus mascotas.
                Nuestro equipo de profesionales altamente calificados y experimentados está comprometido a ofrecer un servicio personalizado y compasivo a cada uno de nuestros clientes.</p>
            </div>
        </div>

        
        <div class="row" id="row3">
            <div class="col-12">
                <h1 class="titulos">Misión y Visión</h1>
            </div>  
        </div>
        <div class="row row2" >
            <div class="col-12">
                <p class="textoEmpresa">
                En San Antón, nuestra misión es simple pero fundamental: proporcionar atención médica integral y de la más alta calidad para sus queridas mascotas. Nos impulsa un profundo respeto por el vínculo entre las personas y sus animales, y nos esforzamos por ser una extensión compasiva y confiable de ese vínculo.
                Creemos que todas las mascotas merecen una vida saludable y feliz. Por eso, nuestro equipo altamente calificado se dedica a ofrecer un servicio personalizado y preventivo, atendiendo tanto las necesidades físicas como emocionales de sus compañeros peludos.
                Nos comprometemos a estar a la vanguardia de la medicina veterinaria, invirtiendo en formación continua y en la implementación de las últimas tecnologías. De esta manera, podemos garantizar diagnósticos precisos, tratamientos eficaces y opciones para el cuidado preventivo que mantengan a sus mascotas sanas y llenas de vida.
                Junto a ustedes, queremos construir un mundo mejor para los animales. Un mundo donde la atención médica de calidad, el amor y el respeto sean parte esencial de la vida de cada mascota.
                </p>       
                <p class="textoEmpresa">En San Antón, nuestra visión es ser la clínica veterinaria líder en la región, 
                reconocida por la excelencia en la atención médica que brindamos a las mascotas y por nuestro compromiso con el bienestar animal.</p>
                <p class="textoEmpresa">Aspiramos a:</p>
                    <ul class="textoEmpresa">
                        <li>Ser la primera opción para los propietarios de mascotas que buscan atención médica de alta calidad y un servicio compasivo.</li>
                        <li>Convertirnos en un centro de referencia para la medicina veterinaria especializada y de vanguardia.</li>
                        <li>Ser un empleador de primer nivel que atraiga y retenga a los mejores profesionales veterinarios.</li>
                    </ul>    
                <p class="textoEmpresa">Para alcanzar nuestra visión, nos comprometemos a:</p>
                    <ul class="textoEmpresa">
                        <li>Invertir en la formación continua de nuestro equipo de profesionales.</li>
                        <li>Implementar las últimas tecnologías y avances en medicina veterinaria.</li>
                        <li>Ofrecer un ambiente de trabajo positivo y colaborativo para nuestro equipo.</li>
                        <li>Brindar un servicio excepcional a nuestros clientes y sus mascotas.</li>
                        <li>Ser un actor responsable en la comunidad, promoviendo el bienestar animal y la tenencia responsable de mascotas.</li>
                    </ul>
                <p class="textoEmpresa">"Estamos seguros de que, con el trabajo duro y la dedicación de nuestro equipo, 
                    lograremos alcanzar nuestra visión y convertirnos en la clínica veterinaria de referencia en la región".</p>
            </div>
        </div>  
    </div>

<?php include_once 'snippets/footer.php';?> 
</body>
</html>