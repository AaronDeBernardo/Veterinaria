function validarClave()
{    
    if (claveRepetida.value) {
        if (claveRepetida.value != claveNueva.value) {
            alert("Las contraseñas son distintas")
            //matchingTxt.style.display = 'block'
            //matchingTxt.style.color = 'red'
            //matchingTxt.innerHTML = 'Not Matching'
            return false
            //e.preventDefault()
        }
        else {
            matchingTxt.style.display = 'block'
            matchingTxt.style.color = 'green'
            matchingTxt.innerHTML = 'Matching'
        }
    }
}
