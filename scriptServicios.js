var idSeleccionado;
            
function getId(servicio)
{
    if(idSeleccionado)
        document.getElementById('servicio_id:' + idSeleccionado).classList.remove('fila-seleccionada');

    document.getElementById(servicio.id).classList.add('fila-seleccionada');
    idSeleccionado = servicio.id.replace('servicio_id:', '');
}

function mostrarModalServicio(boton)
{
    if (boton.id == "btnAnadirServ")
    {
        var modal = document.getElementById('modalServicio');

        modal.querySelector('[name=operacion').value = 'insertar';
        modal.querySelector('[name=id_modificar]').value = null;
        
        modal.querySelector('[name=nombre]').value = null;
        modal.querySelector('[name=tipo_servicio_id]').value = "";
        modal.querySelector('[name=precio]').value = null;
        document.getElementById('checkFechas').checked = false;
        
        modal.querySelector('[name=btn_enviar').classList.remove('btn-primary');
        modal.querySelector('[name=btn_enviar').classList.add('btn-success');
        modal.querySelector('[name=btn_enviar').textContent = 'Guardar';
        document.getElementById('labelModalServicio').textContent = 'Nuevo servicio';
        
        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else if (boton.id == "btnModificarServ")
    {
        if (idSeleccionado)
        {
            var servicio = document.getElementById('servicio_id:' + idSeleccionado).getElementsByTagName('td');
            var modal = document.getElementById('modalServicio');

            modal.querySelector('[name=operacion').value = 'modificar';
            modal.querySelector('[name=id_modificar]').value = idSeleccionado;
            
            modal.querySelector('[name=nombre]').value = servicio[0].textContent;
            modal.querySelector('[name=tipo_servicio_id]').value = servicio[1].getAttribute('data-tipo_id');
            modal.querySelector('[name=precio]').value = servicio[2].textContent;
            
            if (servicio[3].getAttribute('data-check_fechas') != "0")
                document.getElementById('checkFechas').checked = true;
            else
                document.getElementById('checkFechas').checked = false;

            modal.querySelector('[name=btn_enviar').classList.add('btn-primary');
            modal.querySelector('[name=btn_enviar').classList.remove('btn-success');
            modal.querySelector('[name=btn_enviar').textContent = 'Modificar';
            document.getElementById('labelModalServicio').textContent = 'Modificar servicio';
            
            var myModal = new bootstrap.Modal(modal, {});
            myModal.show();
        }
        else{
            alert("Por favor, seleccione una fila de la tabla");
        }
    }
}

function mostrarModalEliminar(boton){
    if (idSeleccionado){
        if (boton.id == "btnEliminarServ")
        {
            document.getElementById("id_eliminar").value = idSeleccionado;
            modal = document.getElementById("modalEliminar")
            myModal = new bootstrap.Modal(modal, {});
            myModal.show();
        }
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}