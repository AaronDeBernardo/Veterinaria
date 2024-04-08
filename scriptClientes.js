var idSeleccionado = "";
var nombre, apellido;
var bandera = false;
            
function getId(fila)
{
    var aux = fila.id.replace('idCliente:', '');
    idSeleccionado = aux.substring(0, aux.indexOf('nom:'));
    aux = aux.substring(aux.indexOf('nom:') + 4);
    nombre = aux.substring(0, aux.indexOf('ape:'))
    aux = aux.substring(aux.indexOf('ape:') + 4);
    apellido = aux;

    if (!bandera)
    {
        bandera = true;
        document.getElementById("btnVerMascotas").classList.remove("d-none");
        document.getElementById("btnModificarClave").classList.remove("d-none");
    }
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
        else if (boton.id == "btnModificarClave")
        {
            document.getElementById("idModificarClave").value = idSeleccionado;
            myModal = new bootstrap.Modal(document.getElementById("modalModificarClave"), {});           
        }
        
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la lista");
    }
}

function verMascotas(){
    if (idSeleccionado != ""){
        window.location.href = 'abmcMascotas.php?idCliente=' + idSeleccionado;
    }
}

function handler(input){
    if (input.value == '')
        window.location.href= 'abmcClientes.php';
}