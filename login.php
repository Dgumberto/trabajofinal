<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();
$sentencia= $conexion->consultar("SELECT * FROM `usuario`");
if($_POST){


$usuario=$_POST['email'];
$pass=$_POST['pass'];
$_SESSION['correo']=$pass;
$sentencia= $conexion->consultar("SELECT pass FROM `usuario` where mail='".$usuario."'");
if($sentencia==null)
{echo('<div class="alert alert-warning alert-danger fade show" role="alert"> El correo electronico enviado no existe, por favor verifiquelo y vuelva a ingresar </div>');

}
else{
if ($sentencia[0]['pass']==$pass){
session_start();
$sentencia= $conexion->consultar("SELECT * FROM `usuario` where mail='".$usuario."'");
$_SESSION['nombre']=$sentencia[0]['nombre'];
$_SESSION['apellido']=$sentencia[0]['apellido'];
$_SESSION['adm']=$sentencia[0]['adm'];
$_SESSION['dni']=$sentencia[0]['dni'];
$_SESSION['mail']=$sentencia[0]['mail'];
$_SESSION['id']=$sentencia[0]['id'];
header("location: usuario.php");
}
else{
    echo('<div class="alert alert-warning alert-danger fade show" role="alert"> Contraseña Incorrecta, por favor verifiquelo y vuelva a ingresar </div>');
}
 }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Log In</title>
</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 ">
                <div class="login-form bg-light shadow-lg mt-4 p-4">
                    <form action="login.php" method="post" class="row g-3">
                        <h4>Bienvenido</h4>
                        <div class="col-12">
                            <label>E-Mail</label>
                            <input type="text" class="form-control" name="email"placeholder="Ingrese su E-Mail">
                        </div>
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Password">
                        </div>

                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-end">Ingresar</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">¿Aún no tienes cuenta? <a href="registro.php">Registrate!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>    
</body>
</html>