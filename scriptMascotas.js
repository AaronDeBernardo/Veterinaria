var idSeleccionado = "";
            
function getId(fila)
{
    if (idSeleccionado != ""){
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('show');
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('active');
        document.getElementById('idMascota:' + idSeleccionado).classList.remove("table-secondary");
    }
    
    document.getElementById(fila.id).classList.add("table-secondary");

    idSeleccionado = fila.id.replace('idMascota:', '');

    document.getElementById('list-mascota:' + idSeleccionado).classList.add('show');
    document.getElementById('list-mascota:' + idSeleccionado).classList.add('active');
}

function mostrarModal(boton){
    if (idSeleccionado != ""){
        var myModal;
        if (boton.id == "btnEliminarMascota")
        {
            document.getElementById("idEliminar").value = idSeleccionado;
            myModal = new bootstrap.Modal(document.getElementById("modalEliminarMascota"), {});
        }
        else if (boton.id == "btnModificarMascota")
        {
            var contenedor = document.getElementById("modalModificarMascota");
            
            
            
            
            var fila = document.getElementById("idMascota:" + idSeleccionado);

            document.getElementById('idModificar').value = idSeleccionado;

            contenedor.querySelector('[name=cliente_id]').value = fila.getElementsByTagName('td')[0].id.replace('idCliente:', '');
            contenedor.querySelector('[name=nombre]').value = fila.getElementsByTagName('td')[1].textContent;
            contenedor.querySelector('[name=raza]').value = fila.getElementsByTagName('td')[2].textContent;
            contenedor.querySelector('[name=color]').value = fila.getElementsByTagName('td')[3].textContent;
            
            var tarjeta = document.getElementById('list-mascota:' + idSeleccionado);
            contenedor.querySelector('[name=fecha_de_nac]').value = tarjeta.querySelector("p[name='fecha_de_nac']").textContent.replace('Fecha de nacimiento: ', '');
            
            try{
                contenedor.querySelector('[name=fecha_muerte]').value = tarjeta.querySelector("p[name='fecha_muerte']").textContent.replace('Fecha de muerte: ', '');
            }
            catch{
                contenedor.querySelector('[name=fecha_muerte]').value = null;
            }
            



            /*try{
                contenedor.querySelector('[name=foto_existente]').src = tarjeta.getElementsByTagName('img')[0].src;    
            }
            catch{
                document.getElementById('foto_existente').classList.add('')
            }*/





            myModal = new bootstrap.Modal(contenedor, {});
        }
        
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}

function borrarFiltros()
{
    window.location.replace(location.pathname);
}