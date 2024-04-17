var idSeleccionado;

function mostrarFoto(mascota)
{
    if (idSeleccionado){
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('show');
        document.getElementById('list-mascota:' + idSeleccionado).classList.remove('active');
        document.getElementById('mascota_id:' + idSeleccionado).classList.remove("table-secondary");
    }

    document.getElementById(mascota.id).classList.add("table-secondary");
    idSeleccionado = mascota.id.replace('mascota_id:', '');
    document.getElementById('list-mascota:' + idSeleccionado).classList.add('show');
    document.getElementById('list-mascota:' + idSeleccionado).classList.add('active');
}

function posicionarDiv() {
    var div = document.getElementById('div-filtro');
    var alto = div.offsetHeight;
    var div2 = document.getElementById('div-separacion');
    div2.style.height = alto + 'px';
}

window.onload = posicionarDiv;