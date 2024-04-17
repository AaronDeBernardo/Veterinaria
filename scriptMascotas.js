var idSeleccionado;
            
function getId(fila)
{
    if (idSeleccionado){
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('show');
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('active');
        document.getElementById('idMascota:' + idSeleccionado).classList.remove('fila-seleccionada');
    }
    
    document.getElementById(fila.id).classList.add('fila-seleccionada');

    idSeleccionado = fila.id.replace('idMascota:', '');

    document.getElementById('list-mascota:' + idSeleccionado).classList.add('show');
    document.getElementById('list-mascota:' + idSeleccionado).classList.add('active');
}

function mostrarModalEliminar(boton){
    if (boton.id == "btnEliminarMascota" && idSeleccionado){
        document.getElementById("id_eliminar").value = idSeleccionado;

        var myModal = new bootstrap.Modal(document.getElementById("modalEliminarMascota"), {});
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}

function mostrarModalMascota(boton)
{
    if (boton.id == 'btnAnadirMascota')
    {
        var modal = document.getElementById('modalMascota');
        modal.querySelector('[name=operacion').value = 'insertar';
        modal.querySelector('[name=id_modificar]').value = null;
        modal.querySelector('[name=cliente_id]').value = "";
        modal.querySelector('[name=nombre]').value = null;
        modal.querySelector('[name=raza]').value = null;
        modal.querySelector('[name=color]').value = null;
        modal.querySelector('[name=fecha_de_nac]').value = null;
        modal.querySelector('[name=foto]').value = null;
        modal.querySelector('[name=fecha_muerte]').value = null;
        document.getElementById('label_foto_modal').textContent = 'Foto';
        document.getElementById('div_fecha_muerte').style.display = 'none';

        modal.querySelector('[name=btn_enviar').classList.remove('btn-primary');
        modal.querySelector('[name=btn_enviar').classList.add('btn-success');
        modal.querySelector('[name=btn_enviar').textContent = 'Guardar';
        document.getElementById('labelModalMascota').textContent = 'Nueva mascota';

        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else if (boton.id == 'btnModificarMascota' && idSeleccionado)
    {
        var modal = document.getElementById('modalMascota');
        var mascota = document.getElementById("idMascota:" + idSeleccionado).getElementsByTagName('td');
        var tarjeta = document.getElementById('list-mascota:' + idSeleccionado);

        modal.querySelector('[name=operacion').value = 'modificar';
        modal.querySelector('[name=id_modificar]').value = idSeleccionado;
        modal.querySelector('[name=cliente_id]').value = mascota[0].getAttribute('data-cliente_id');
        modal.querySelector('[name=nombre]').value = mascota[1].textContent;
        modal.querySelector('[name=raza]').value = mascota[2].textContent;
        modal.querySelector('[name=color]').value = mascota[3].textContent;
      
        modal.querySelector('[name=fecha_de_nac]').value = tarjeta.getAttribute('data-fecha_de_nac');
        document.getElementById('div_fecha_muerte').style.display = 'block';

        if (tarjeta.getAttribute('data-fecha_muerte'))
            modal.querySelector('[name=fecha_muerte]').value = tarjeta.getAttribute('data-fecha_muerte');
        else
            modal.querySelector('[name=fecha_muerte]').value = null;

        
        if (tarjeta.getElementsByTagName('img').length)
            document.getElementById('label_foto_modal').textContent = 'La mascota ya tiene una foto';
        else
            document.getElementById('label_foto_modal').textContent = 'Foto';

        modal.querySelector('[name=btn_enviar').classList.add('btn-primary');
        modal.querySelector('[name=btn_enviar').classList.remove('btn-success');
        modal.querySelector('[name=btn_enviar').textContent = 'Modificar';
        document.getElementById('labelModalMascota').textContent = 'Modificar mascota';

        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else
    {
        alert("Por favor, seleccione una fila de la tabla");
    }
}

function borrarFiltros(){
    window.location.replace(location.pathname);
}

$('#formFiltro').on('shown.bs.collapse', function(e){
    $('.chosen-select', this).chosen();
});


$('#modalMascota').on('shown.bs.modal', function(e){
    $('.chosen-select').trigger("chosen:updated");
    $('.chosen-select', this).chosen();
});

function posicionarDiv() {
    var div = document.getElementById('div-filtro');
    var alto = div.offsetHeight;
    var div2 = document.getElementById('div-separacion');
    div2.style.height = alto + 'px';
}

window.onload = posicionarDiv;