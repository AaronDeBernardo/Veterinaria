<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'cliente' || $_SESSION['rol'] == 'visita'){
        header('Location: index.php');
        die();
    }
    include_once 'consultasdb/connection.php';
    $filtro = '';
    if (isset($_GET['filtro']))
        $filtro = "HAVING apeynom LIKE '%$_GET[filtro]%'";

    $query = "SELECT id, CONCAT(apellido, ' ', nombre) AS apeynom, nombre, apellido, email, ciudad, direccion, telefono FROM clientes WHERE baja = 0 $filtro ORDER BY apellido";
    $clientes = consultaSQL($query);

    $query = "SELECT cliente_id, nombre FROM mascotas WHERE ISNULL(fecha_muerte) AND baja = 0";
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
    <link rel="stylesheet" href="styles/stylesClientes.css" type="text/css">
    <link rel="icon" href="recursos/logoVeterinaria.png">
</head>
<body>
    <?php include_once 'snippets/menuSuperior.php' ?>    

    <div class="container-fluid p-0">
        <div class="row">
            <?php  $_SESSION['item'] = 'clientes'; include_once 'snippets/menuLateral.php'; ?>
        
            <div class="col-12 col-md-4 col-lg-5 col-xl-4 mt-3">
                <form action="#" method="GET">
                    <div class="form-group" id="div-filtro">
                        <label for="filtro">Buscar cliente</label>
                        <input type="search" id="filtro" name="filtro" class="form-control" <?php echo !empty($_GET['filtro']) ? "value=$_GET[filtro]" : "";?>>
                        <small class="form-text text-muted">Presione enter para filtrar los clientes.</small>
                    </div>
                </form>


                <div class="list-group" id="list-clientes" role="tablist" >
<?php
                foreach ($clientes as $c)
                    echo "<a id=cliente_id:$c[id] data-nombre='$c[nombre]' data-apellido='$c[apellido]' class='list-group-item list-group-item-action' data-bs-toggle=list 
                        href=#list-cliente:$c[id] role=tab aria-controls=list-cliente:$c[id] onclick='getId(this)'>$c[apeynom]</a>";
                if (mysqli_num_rows($clientes) == 0)
                    echo "<a class='list-group-item list-group-item-action'>No se encontró ningún cliente</a>";
?>
                </div>
                <div class="colBotones" style="margin-top:16px;">
                    <button type="button" class="btn btn-outline-success" id="btnAnadirCliente" onclick="mostrarModalCliente(this)">Nuevo cliente</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModificarCliente" onclick="mostrarModalCliente(this)">Modificar</button>
                    <button type="button" class="btn btn-outline-danger" id="btnEliminarCliente" onclick="mostrarModalEliminar(this)">Baja</button>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 col-xl-5 mt-3">
                <div id="div-separacion">&nbsp;</div>
                <div class="tab-content" id="nav-tabContent">
<?php
                foreach ($clientes as $c)
                {
                    echo "<div id=list-cliente:$c[id] class='tab-pane fade' role=tabpanel>";
                        echo "<div class=card>";
                            echo "<div class=card-body>";
                                echo "<p data-email='$c[email]' class=card-text>Correo electrónico: $c[email]</p>";
                                echo "<p data-ciudad='$c[ciudad]' class=card-text>Ciudad: $c[ciudad]</p>"; //opcional
                                echo "<p data-direccion='$c[direccion]' class=card-text>Dirección: $c[direccion]</p>"; //opcional
                                echo "<p data-telefono='$c[telefono]' class=card-text>Teléfono: $c[telefono]</p>";

                                
                                $stringMascotas = '';
                                foreach ($mascotas as $m)
                                {
                                    if ($m['cliente_id'] == $c['id']){
                                        if ($stringMascotas)
                                            $stringMascotas = $stringMascotas . ', ';
                                        $stringMascotas = $stringMascotas . $m['nombre'];
                                    }
                                }
                                
                                if ($stringMascotas)
                                    echo "<p data-tiene_mascotas=1>Mascotas: " . $stringMascotas . "</p>";
                                else
                                    echo "<p data-tiene_mascotas=0>Mascotas: el cliente no tiene ninguna mascota</p>";
                                
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                ?>
                        </div>
                    
                        <button type="button" class="btn btn-info d-none mt-2 me-2" id="btnVerMascotas" onclick="verMascotas()">Ver mascotas</button>
                        <button type="button" class="btn btn-warning d-none mt-2" id="btnModificarClave" onclick="mostrarModalClave(this)">Cambiar contraseña</button>
                    </div>
                </div>
            </div>


    <!-- Modals -->
    <div class="modal fade" id="modalCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalCliente" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="labelModalCliente" class="modal-title fs-5">Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="consultasdb/cliente.php" method="POST">
                    <input type="hidden" name="operacion">
                    <input type="hidden" name="id_modificar">    
                    <div class="modal-body">
                        
                        <div class="form-group">    
                            <label for="nombreCliente">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombreCliente" required>
                        </div>
                        <div class="form-group">    
                            <label for="apellidoCliente">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="apellidoCliente" required>
                        </div>
                        <div class="form-group">    
                            <label for="correoCliente">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" id="correoCliente" required>
                        </div>
                        <div class="form-group cont_clave">
                            <label for="claveCliente">Contraseña</label>
                            <input type="password" name="clave" class="form-control" id="claveCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="telCliente">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" id="telCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="ciudadCliente">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" id="ciudadCliente">
                        </div>
                        <div class="form-group">
                            <label for="dirCliente">Dirección</label>
                            <input type="text" name="direccion" class="form-control" id="dirCliente">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" name="btn_enviar">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalEliminar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="labelModalEliminar" class="modal-title fs-5">Eliminar cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="consultasdb/cliente.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="operacion" value="eliminar">
                        <input type="hidden" id="id_eliminar" name="id_eliminar">
                        <div class="form-group">
                            <p>¿Está seguro que desea eliminar el cliente seleccionado?<br>También se eliminarán sus mascotas.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar cliente y mascotas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalModificarClave" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelModalClave" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="labelModalClave" class="modal-title fs-5">Modificar contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="consultasdb/cliente.php" method="POST">
                    <input type="hidden" name="operacion" value="modificar_clave">
                    <input type="hidden" id="id_modificar_clave" name="id_modificar">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cambioClave">Nueva contraseña</label>
                            <input type="password" name="clave" class="form-control" id="cambioClave" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="scripts/scriptClientes.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include_once 'snippets/mostrarAlerta.php'?>
</body>
</html>