function validarClave()
{    
    if (claveRepetida.value) {
        if (claveRepetida.value != claveNueva.value) {
            
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Las claves nuevas no coinciden!",     
                confirmButtonColor: "#f0ad4e",           
            });
            return false
        }
    }
}
