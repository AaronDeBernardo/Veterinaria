var idSeleccionado;
            
function getId(fila)
{
    if(idSeleccionado != null)
        document.getElementById('idAtencion:' + idSeleccionado).classList.remove('fila-seleccionada');

    document.getElementById(fila.id).classList.add('fila-seleccionada');
    idSeleccionado = fila.id.replace('idAtencion:', '');
}

function borrarFiltros(){
    window.location.replace(location.pathname);
}

function mostrarAtencion()
{
    if (idSeleccionado)
    {
        var atencion = document.getElementById('idAtencion:' + idSeleccionado).getElementsByTagName('td');
        var modal = document.getElementById('modalDatos');
    
        modal.querySelector('[name=fecha_hora]').value = atencion[0].textContent;
        modal.querySelector('[name=mascota]').value = atencion[1].textContent;
        modal.querySelector('[name=servicio]').value = atencion[2].textContent;
        modal.querySelector('[name=personal]').value = atencion[3].textContent;
        modal.querySelector('[name=titulo]').value = atencion[4].textContent;
        modal.querySelector('[name=descripcion]').value = atencion[5].textContent;
        modal.querySelector('[name=precio]').value = atencion[7].textContent;

        fec_hora_salida = atencion[6].textContent;
        
        if (fec_hora_salida)
        {
            modal.getElementsByClassName('contenedor_dt')[0].style.display = 'block';
            modal.querySelector('[name=fecha_hora_salida]').value = fec_hora_salida;
        }
        else
        {
            modal.getElementsByClassName('contenedor_dt')[0].style.display = 'none';
            modal.querySelector('[name=fecha_hora_salida]').value = '';
        }

        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else{
        Swal.fire({
            icon: "error",
            title: "Ups...",
            text: "Seleccione una fila de la tabla",     
            confirmButtonColor: "#f0ad4e",           
        });
    }
}