var idSeleccionado = "";
            
function getId(fila){
    if(idSeleccionado != "")
        document.getElementById(idSeleccionado).classList.remove("table-secondary");

    document.getElementById(fila.id).classList.add("table-secondary");
    idSeleccionado = fila.id;
}

function mostrarModal(boton){
    if (idSeleccionado != ""){
        var myModal;
        if (boton.id == "btnEliminarPers"){
            document.getElementById("idEliminar").value = idSeleccionado.replace('idPersonal:', '');
            myModal = new bootstrap.Modal(document.getElementById("modalEliminarPers"), {});
        }
        else //btnModificarPers
        {
            var fila = document.getElementById(idSeleccionado);
            var contenedor = document.getElementById("modalModificarPers");

            document.getElementById('idModificar').value = idSeleccionado.replace('idPersonal:', '');
            
            contenedor.querySelector('[name=nombre]').value = fila.getElementsByTagName('td')[0].textContent;
            contenedor.querySelector('[name=apellido]').value = fila.getElementsByTagName('td')[1].textContent;
            contenedor.querySelector('[name=email]').value = fila.getElementsByTagName('td')[2].textContent;
            contenedor.querySelector('[name=rol_id]').value = fila.getElementsByTagName('td')[3].id.replace('idRol:', '');
            
            myModal = new bootstrap.Modal(contenedor, {});
        }
        
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}