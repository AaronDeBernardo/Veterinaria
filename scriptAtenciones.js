function filtrarDuenios(input) {
    var filter, a, i;
    filter = input.value.toUpperCase();
    div = document.getElementById("dropdownClientes");
    a = div.getElementsByTagName("a");

    for (i = 0; i < a.length; i++) {
        txtValue = a[i].text;

        if (txtValue.toUpperCase().indexOf(filter) > -1)
            a[i].style.display = "";
        else
            a[i].style.display = "none";
    }
    document.getElementById("dropdownClientes").classList.toggle("show");
}

function clickCliente(a){
    input = document.getElementById('idCliente');
    input.value = a.getAttribute('value');;
    input.text = a.textContent;
}