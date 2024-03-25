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
        if (boton.id == "btnEliminarServ"){
            document.getElementById("idEliminar").value = idSeleccionado.replace('idServicio:', '');
            myModal = new bootstrap.Modal(document.getElementById("modalEliminarServ"), {});
        }
        else //btnModificarServ
        {
            var fila = document.getElementById(idSeleccionado);            
            var contenedor = document.getElementById("modalModificarServ");

            document.getElementById('idModificar').value = idSeleccionado.replace('idServicio:', '');
            
            contenedor.querySelector('[name=nombre]').value = fila.getElementsByTagName('td')[0].textContent;
            contenedor.querySelector('[name=tipo_servicio_id]').value = fila.getElementsByTagName('td')[1].id.replace('idTipo:', '');
            contenedor.querySelector('[name=precio]').value = fila.getElementsByTagName('td')[2].textContent;
            
            myModal = new bootstrap.Modal(contenedor, {});
        }
        
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}