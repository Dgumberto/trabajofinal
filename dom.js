document.getElementById("registro").addEventListener("submit", validacionRegistro);
document.getElementById("mail").addEventListener("change",validarMail);





function validacionRegistro(){
    let pass1=document.getElementById("pass").value;
    let pass2=document.getElementById("pass2").value;
    let nombre=document.getElementById("nombre").value;
    let apellido= document.getElementById("apellido").value;
    let dni=document.getElementById("dni").value;
    let mail=document.getElementById("mail").value;
    let cadena="";

    if(pass1!==pass2||pass1==""||nombre==""||apellido==""||dni==""||mail=="" ){
        if(pass1!==pass2){cadena=cadena+"Las contraseñas no coinciden <br>"
        document.getElementById("pass").value="";
        document.getElementById("pass2").value="";
    }
        if(nombre==""){cadena=cadena+"Debe completar el nombre <br>"}
        if(apellido==""){cadena=cadena+"Debe completar el apellido <br>"}
        if(dni==""){cadena=cadena+"Debe completar el dni <br>"}
        if(mail==""){cadena=cadena+"Debe completar el E-Mail <br>"}
        if(pass1==""){cadena=cadena+"Debe completar la contraseña <br>"}
        document.getElementById("mensajeAlerta").innerHTML=cadena;
        document.getElementById("alertaRegistro").style.display="block";
        event.preventDefault();
    }
    
 


}


function validarMail(){
    let emailIngresado=document.getElementById("mail").value;
    let regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let esValido=regex.test(emailIngresado);
    
    if (esValido==false){
        document.getElementById("mensajeAlerta").innerHTML='El E-Mail no parece ser correcto ';
        document.getElementById("alertaRegistro").style.display="block";

        document.getElementById("mail").value="";
    }
}

