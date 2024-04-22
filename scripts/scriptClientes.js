var idSeleccionado;
            
function getId(cliente)
{
    idSeleccionado = cliente.id.replace('cliente_id:', '');
    document.getElementById("btnModificarClave").classList.remove("d-none");

    var tieneMascotas = document.getElementById("list-cliente:" + idSeleccionado).getElementsByTagName('p')[4].getAttribute('data-tiene_mascotas');
    if (tieneMascotas == 1)
        document.getElementById("btnVerMascotas").classList.remove("d-none");
    else
        document.getElementById("btnVerMascotas").classList.add("d-none");
}

function mostrarModalCliente(boton){
    if (boton.id == "btnAnadirCliente")
    {
        var modal = document.getElementById('modalCliente');
        
        modal.querySelector('[name=operacion').value = 'insertar';
        modal.querySelector('[name=id_modificar]').value = null;

        modal.querySelector('[name=nombre]').value = null;
        modal.querySelector('[name=apellido]').value = null;

        modal.querySelector('[name=email]').value = null;
        modal.querySelector('[name=ciudad]').value = null;
        modal.querySelector('[name=direccion]').value = null;
        modal.querySelector('[name=telefono]').value = null;

        modal.getElementsByClassName('cont_clave')[0].style.display = 'block';
        modal.querySelector('[name=clave]').value = null;
        modal.querySelector('[name=clave]').required = true;

        modal.querySelector('[name=btn_enviar').classList.remove('btn-primary');
        modal.querySelector('[name=btn_enviar').classList.add('btn-success');
        modal.querySelector('[name=btn_enviar').textContent = 'Guardar';
        document.getElementById('labelModalCliente').textContent = 'Nuevo cliente';

        var myModal = new bootstrap.Modal(modal, {});
        myModal.show();
    }
    else if (boton.id == "btnModificarCliente")
    {
        if (idSeleccionado)
        {
            var cliente = document.getElementById('cliente_id:' + idSeleccionado);
            var tarjeta = document.getElementById('list-cliente:' + idSeleccionado).getElementsByTagName('p');
            var modal = document.getElementById('modalCliente');
            
            modal.querySelector('[name=operacion').value = 'modificar';
            modal.querySelector('[name=id_modificar]').value = idSeleccionado;

            modal.querySelector('[name=nombre]').value = cliente.getAttribute('data-nombre');
            modal.querySelector('[name=apellido]').value = cliente.getAttribute('data-apellido');

            modal.querySelector('[name=email]').value = tarjeta[0].getAttribute('data-email');
            modal.querySelector('[name=ciudad]').value = tarjeta[1].getAttribute('data-ciudad');
            modal.querySelector('[name=direccion]').value = tarjeta[2].getAttribute('data-direccion');
            modal.querySelector('[name=telefono]').value = tarjeta[3].getAttribute('data-telefono');

            modal.getElementsByClassName('cont_clave')[0].style.display = 'none';
            modal.querySelector('[name=clave]').value = null;
            modal.querySelector('[name=clave]').required = false;

            modal.querySelector('[name=btn_enviar').classList.add('btn-primary');
            modal.querySelector('[name=btn_enviar').classList.remove('btn-success');
            modal.querySelector('[name=btn_enviar').textContent = 'Modificar';
            document.getElementById('labelModalCliente').textContent = 'Modificar cliente';

            myModal = new bootstrap.Modal(modal, {});
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
}

function mostrarModalEliminar(boton)
{
    if (idSeleccionado)
    {
        if (boton.id == "btnEliminarCliente")
        {
            document.getElementById("id_eliminar").value = idSeleccionado;
            modal = document.getElementById("modalEliminar");
            myModal = new bootstrap.Modal(modal, {});
            myModal.show();
        }
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

function mostrarModalClave(boton)
{
    if (idSeleccionado)
    {
        if (boton.id == "btnModificarClave")
        {
            document.getElementById("id_modificar_clave").value = idSeleccionado;
            modal = document.getElementById("modalModificarClave");
            myModal = new bootstrap.Modal(modal, {});
            myModal.show();
        }
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

function verMascotas(){
    if (idSeleccionado != ""){
        window.location.href = 'abmcMascotas.php?cliente_id=' + idSeleccionado;
    }
}

function posicionarDiv() {
    var div = document.getElementById('div-filtro');
    var alto = div.offsetHeight + 20;
    var div2 = document.getElementById('div-separacion');
    div2.style.height = alto + 'px';
}

window.onload = posicionarDiv;