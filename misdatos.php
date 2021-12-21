

<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();


?>
<?php session_start();
?>
<?php if(isset($_SESSION['nombre'])){
  
}else{
  header("location:login.php");
exit;}
?>

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
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">

    <li class=" dropdown nav-item ml-auto">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo ($_SESSION['nombre']." ".$_SESSION['apellido']);
            ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="misdatos.php">Mi cuenta</a></li>
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>

</nav>

</header> 
<?php
if($_POST){
if($_POST['pass']=="" || $_POST['pass']!=$_POST['pass2']){
    if($_POST['pass']=="") {
        echo ('<div class="alert alert-danger" role="alert">
        Debe completar todos los campos
      </div>');}
    if($_POST['pass']!=$_POST['pass2']){
        echo('<div class="alert alert-danger" role="alert">
        Las contraseñas no coinciden
      </div>');}
}
else{
    
    $sql='UPDATE `usuario` SET `pass`='.$_POST['pass'].' WHERE id='.$_SESSION['id'].'';

$id_proyecto = $conexion->ejecutar($sql);
    echo('<div class="alert alert-success" role="alert">
    La contraseña fue modificada <br><a href="usuario.php">Volver</a>
  </div>');}
}



?>
<section class=" container-fluid alerta" id="alertaRegistro" style="display:none" >

<div class="alert alert-danger alert-dismissible fade show" id="mensajeAlerta" role="alert">

  
</div>

</section>


    <section class="container-fluid" >

<h2 class="padding-top">Modificacion Usuario</h2>
<hr>
</section>

<form class="container-fluid padding-top " id="modificacion" method="post" action="misdatos.php">
<div class="row mb-3">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control disabled"  name="nombre" id="nombre" placeholder="<?php echo($_SESSION['nombre']);?>" disabled>
    </div>
  </div>
  <div class="row mb-3">
    <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="apellido" id="apellido"placeholder="<?php echo($_SESSION['apellido']);?>" disabled>
    </div>
  </div>
  <div class="row mb-3">
    <label for="dni" class="col-sm-2 col-form-label">DNI</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="dni" id="dni" placeholder="<?php echo($_SESSION['dni']);?>" disabled>
    </div>
  </div>
  <div class="row mb-3">
    <label for="mail" class="col-sm-2 col-form-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="mail" id="mail" placeholder="<?php echo($_SESSION['mail']);?>" disabled>
    </div>
  </div>
  <hr>
  <div class="row mb-3">
    <label for="pass" class="col-sm-2 col-form-label">Ingrese la nueva constraseña</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pass" id="pass">
    </div>
  </div>
  <div class="row mb-3">
    <label for="pass2" class="col-sm-2 col-form-label">Reingrese la nueva contreseña</label>
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