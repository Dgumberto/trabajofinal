document.getElementById("formEntradas1").addEventListener("submit",validacionEntrada);
function validacionEntrada(){

    let nombre1=document.getElementById("nombreEnt").value;
    let apellido1=document.getElementById("apellidoEnt").value;
    let dni1=document.getElementById("dniEnt").value;
    let cadena1="";
    if(nombre1==""||apellido1==""||dni1==""){
        if(nombre1==""){cadena1=cadena1+"Debe completar el nombre<br>";}
        if(apellido1==""){cadena1=cadena1+"Debe completar el apellido<br>";}
        if(dni1==""){cadena1=cadena1+"Debe completar el dni <br>";}
        document.getElementById("mensajeAlertaEntradas").innerHTML=cadena1;
        document.getElementById("alertaEntradas").style.display="block";
        event.preventDefault();


    }
}