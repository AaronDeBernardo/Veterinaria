var idSeleccionado;
            
function getId(fila)
{
    if(idSeleccionado != null)
        document.getElementById('idAtencion:' + idSeleccionado).classList.remove("table-secondary");

    document.getElementById(fila.id).classList.add("table-secondary");
    idSeleccionado = fila.id.replace('idAtencion:', '');
}


function mostrarModal(boton)
{
    if (idSeleccionado != null)
    {
        var myModal;
        if (boton.id == 'btnEliminarAtencion')
        {
            document.getElementById("id_eliminar").value = idSeleccionado;
            myModal = new bootstrap.Modal(document.getElementById("modalEliminarAtencion"), {});
        }
        else if (boton.id == 'btnModificarAtencion')
        {

        }
        myModal.show();
    }
    else{
        alert("Por favor, seleccione una fila de la tabla");
    }
}


$('#modalAnadirAtencion').on('shown.bs.modal', function () {
    $('.chosen-select', this).chosen();
});


$('#select_cliente').on('change', function(e) {
    cliente_id = document.getElementById('select_cliente').value;
    option = document.getElementById('select_mascota').getElementsByTagName('option');
    valor_seleccionado = document.getElementById('select_mascota').value;

    for (i = 0; i < option.length; i++)
    {
        if (option[i].value == valor_seleccionado && option[i].id.replace('cliente_id:', '') != cliente_id){
            document.getElementById('select_mascota').value = "";
        }

        if (option[i].id.replace('cliente_id:', '') != cliente_id)
            option[i].style.display = "none";
        else
            option[i].style.display = "";
    }

    $('#select_mascota').trigger("chosen:updated");
});


$('#select_mascota').on('change', function(e) {
    mascota_id = document.getElementById('select_mascota').value;
    option = document.getElementById('select_mascota').getElementsByTagName('option');
    
    for (i = 0; i < option.length; i++)
    {    
        if (option[i].value == mascota_id){
            cliente_id = option[i].id.replace('cliente_id:', '');
            document.getElementById('select_cliente').value = cliente_id;
            break;
        }
    }
    $('#select_cliente').trigger("chosen:updated");
});


$('#select_servicio').on('change', function(e) {
    servicio_id = document.getElementById('select_servicio').value;
    option = document.getElementById('select_servicio').getElementsByTagName('option');
    
    for (i = 0; i < option.length; i++)
    {
        if (option[i].value == servicio_id)
        {
            if (option[i].id.replace('fec_salida:', '') == true)
            {
                document.getElementById('cont_dt_agregar').style.display = "block";
                document.getElementById('dt_agregar').required = true;
                document.getElementById('dt_agregar').value = '';
            }
            else
            {
                document.getElementById('cont_dt_agregar').style.display = "none";
                document.getElementById('dt_agregar').required = false;
                document.getElementById('dt_agregar').value = '';
            }

        }
    }
});