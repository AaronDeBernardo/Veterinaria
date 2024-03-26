var idSeleccionado = "";
            
function getId(fila)
{
    if (idSeleccionado != ""){
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('show');
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('active');
    }
    
    idSeleccionado = fila.id.replace('idMascota:', '');

    document.getElementById('list-mascota:' + idSeleccionado).classList.add('show');
    document.getElementById('list-mascota:' + idSeleccionado).classList.add('active');
}

function mostrarModal(boton){
    if (idSeleccionado != ""){
        var myModal;
        if (boton.id == "btnEliminarCliente")
        {
            document.getElementById("idEliminar").value = idSeleccionado;
            myModal = new bootstrap.Modal(document.getElementById("modalEliminarCliente"), {});
        }
        else if (boton.id == "btnModificarCliente")
        {
            var contenedor = document.getElementById("modalModificarCliente");
            var fila = document.getElementById("list-cliente:" + idSeleccionado);

            document.getElementById('idModificar').value = idSeleccionado;

            contenedor.querySelector('[name=nombre]').value = nombre;
            contenedor.querySelector('[name=apellido]').value = apellido;
            contenedor.querySelector('[name=email]').value = fila.getElementsByTagName('p')[0].textContent.replace('Correo electrónico: ', '');
            contenedor.querySelector('[name=ciudad]').value = fila.getElementsByTagName('p')[1].textContent.replace('Ciudad: ', '');
            contenedor.querySelector('[name=direccion]').value = fila.getElementsByTagName('p')[2].textContent.replace('Dirección: ', '');
            contenedor.querySelector('[name=telefono]').value = fila.getElementsByTagName('p')[3].textContent.replace('Teléfono: ', '');
            
            myModal = new bootstrap.Modal(contenedor, {});
        }
        
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la lista");
    }
}

function verMascotas(){
    if (idSeleccionado != ""){
        window.location.href= 'abmcClientes.php?id_cliente=' + idSeleccionado;
    }
}

function handler(input){
    if (input.value == '')
        window.location.href= 'abmcClientes.php';
}