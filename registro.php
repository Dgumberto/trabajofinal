

<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();


?>
<?php session_start();
session_destroy();?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registrarse</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="" width="100"  class="d-inline-block align-text-center">
      Conferencia Codo a Codo 4.0
    </a>

    

</nav>
</header> 
<?php
if($_POST){
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $dni=$_POST['dni'];
    $mail=$_POST['mail'];
    $pass=$_POST['pass'];
    $conexion = new conexion();
    $sentencia= $conexion->consultar("SELECT mail FROM `usuario` where mail='".$mail."'");
    if($sentencia==null){
      $sql=("INSERT INTO `usuario`(`nombre`, `apellido`, `dni`, `adm`, `mail`, `pass`) VALUES ('$nombre','$apellido',$dni,0,'$mail','$pass');");
$id_proyecto = $conexion->ejecutar($sql);
echo('<div class="alert alert-success" role="alert">
Su registro fue creado exitosamente! <br>
<a href="login.php">Volver al LogIn</a>
</div>');

    }else{
      echo('<div class="alert alert-danger" role="alert">
      El mail '.$mail.' ya se encuentra registrado
      </div>');

}}
?>
<section class=" container-fluid alerta" id="alertaRegistro" style="display:none" >

<div class="alert alert-danger alert-dismissible fade show" id="mensajeAlerta" role="alert">

  
</div>

</section>


    <section class="container-fluid" >

<h2 class="padding-top">Registro de Usuario</h2>
<hr>
</section>

<form class="container-fluid padding-top " id="registro" method="post" action="registro.php">
<div class="row mb-3">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" id="nombre">
    </div>
  </div>
  <div class="row mb-3">
    <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="apellido" id="apellido">
    </div>
  </div>
  <div class="row mb-3">
    <label for="dni" class="col-sm-2 col-form-label">DNI</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="dni" id="dni">
    </div>
  </div>
  <div class="row mb-3">
    <label for="mail" class="col-sm-2 col-form-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="mail" id="mail">
    </div>
  </div>
  <hr>
  <div class="row mb-3">
    <label for="pass" class="col-sm-2 col-form-label">Constraseña</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pass" id="pass">
    </div>
  </div>
  <div class="row mb-3">
    <label for="pass2" class="col-sm-2 col-form-label">Repita la Constraseña</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pass2" id="pass2">
    </div>
  </div>
  <button type="submit" class="btn btn-success">Aceptar</button>
  <button type="clear" class="btn btn-danger">Limnpiar</button>
</form>

</section>


<script src="dom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>