var idSeleccionado;
            
function getId(personal)
{
    if(idSeleccionado)
        document.getElementById('personal_id:' + idSeleccionado).classList.remove('fila-seleccionada');

    document.getElementById(personal.id).classList.add('fila-seleccionada');
    idSeleccionado = personal.id.replace('personal_id:', '');
}

function mostrarModalPersonal(boton)
{
    if (boton.id == "btnAnadirPers")
    {
        var modal = document.getElementById('modalPersonal');

        modal.querySelector('[name=operacion').value = 'insertar';
        modal.querySelector('[name=id_modificar]').value = null;

        modal.querySelector('[name=nombre]').value = null;
        modal.querySelector('[name=apellido]').value = null;
        modal.querySelector('[name=email]').value = null;
        modal.getElementsByClassName('div_clave')[0].style.display = 'block';
        modal.querySelector('[name=clave]').value = null;
        modal.querySelector('[name=clave]').required = true;
        modal.querySelector('[name=rol_id]').value = "";
        
        modal.querySelector('[name=btn_enviar').classList.remove('btn-primary');
        modal.querySelector('[name=btn_enviar').classList.add('btn-success');
        modal.querySelector('[name=btn_enviar').textContent = 'Guardar';
        document.getElementById('labelModalPersonal').textContent = 'Nuevo personal';
        
        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else if (boton.id == "btnModificarPers")
    {
        if (idSeleccionado)
        {
            var personal = document.getElementById('personal_id:' + idSeleccionado).getElementsByTagName('td');
            var modal = document.getElementById('modalPersonal');
            
            modal.querySelector('[name=operacion').value = 'modificar';
            modal.querySelector('[name=id_modificar]').value = idSeleccionado;

            modal.querySelector('[name=nombre]').value = personal[0].textContent;
            modal.querySelector('[name=apellido]').value = personal[1].textContent;
            modal.querySelector('[name=email]').value = personal[2].textContent;
            modal.querySelector('[name=rol_id]').value = personal[3].getAttribute('data-rol_id');
            modal.getElementsByClassName('div_clave')[0].style.display = 'none';
            modal.querySelector('[name=clave]').value = null;
            modal.querySelector('[name=clave]').required = false;

            modal.querySelector('[name=btn_enviar').classList.add('btn-primary');
            modal.querySelector('[name=btn_enviar').classList.remove('btn-success');
            modal.querySelector('[name=btn_enviar').textContent = 'Modificar';
            document.getElementById('labelModalPersonal').textContent = 'Modificar personal';

            myModal = new bootstrap.Modal(modal, {});
            myModal.show();
        }
        else{
            alert("Por favor, seleccione una fila de la tabla");
        }
    }
}

function mostrarModalEliminar(boton){
    if (idSeleccionado)
    {
        if (boton.id == "btnEliminarPers")
        {
            document.getElementById("id_eliminar").value = idSeleccionado;
            myModal = new bootstrap.Modal(document.getElementById("modalEliminar"), {});
            myModal.show();
        }
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}