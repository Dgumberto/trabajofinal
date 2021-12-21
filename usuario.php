
<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();


?>
<?php session_start();?>
<?php
if ($_POST){
  $id=$_SESSION['id'];
  $nombre=$_POST['nombre'];
  $apellido=$_POST['apellido'];
  $dni=$_POST['dni'];

$conexion = new conexion();
$sql="INSERT INTO `entradas` (`comprador`, `apellido`, `nombre`, `dni`) VALUES ($id, '$apellido' , '$nombre', $dni)";
$id_proyecto = $conexion->ejecutar($sql);
//INSERT INTO `entradas`(`comprador`, `apellido`, `nombre`, `dni`) VALUES (28692609,"Ned","Flanders",55555747)
}
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
    <title>Usuarios</title>
</head>
<body >
<header class="container-fluid">

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
<div class="padding-top container-fluid">
  <?php if($_SESSION['adm']==1){
    echo('
    <div class="botonadm">
    <a  href="administrador.php"><button class="btn btn-primary " type="button">Panel de Administrador</button></a> 
 </div>
    ');
  }

  ?>
</div>
<section class="container-fluid">
    <h2 class="padding-top">  Entradas</h2>
    <table class="table table-striped">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">DNI</th>
      <th scope="col">Acción</th>

    </tr>
    <tbody>
      <?php
$conexion = new conexion();

$sentencia= $conexion->consultar("SELECT * FROM `entradas` where comprador='".$_SESSION['id']."'");

if($sentencia==null){
  echo("No hay entradas para mostrar");
}else{
  $entradas="";
  foreach ($sentencia as $entradas)
  {    echo('    <tr>
    <th scope="row">'.$entradas['id'].'</th>
    <td>'.$entradas['nombre'].'</td>
    <td>'.$entradas['apellido'].'</td>
    <td>'.$entradas['dni'].'</td>
    <td> <a href="borrarentrada.php?borrar='.$entradas['id'].'"> <button type="button" class="btn btn-danger">Borrar</button> </td></a>

  </tr>');
  
  }
}


      ?>
</tbody>

  </thead>
</table>
<a href="imprimir.php" target="_blank">
<button type="button" class="btn btn-primary" >Imprimir Entrada</button></a>
<hr>

<h2 class="padding-top">Comprar entradas</h2>
<section class="container-fluid" id="alertaEntradas" style="display:none">

<div class="alert alert-danger alert-dismissible fade show" id="mensajeAlertaEntradas" role="alert">

  
</div>

</section>

<form class ="paddinng-top" id="formEntradas1" method="post" action="usuario.php">

<div class="row g-3">
  <div class="col">
    <input type="text" class="form-control" id="nombreEnt" name="nombre" placeholder="Nombre" aria-label="Nombre">
  </div>
  <div class="col">
    <input type="text" class="form-control" id="apellidoEnt" name="apellido" placeholder="Apellido" aria-label="Apellido">
  </div>
  <div class="col">
    <input type="number" class="form-control" id="dniEnt" name="dni" placeholder="DNI" aria-label="DNI">
  </div>
</div>
<button  type="submit" class="btn btn-success">Aceptar</button>
<button  type="reset" class="btn btn-danger">Borrar</button>
</form>
<hr>

</section>
<section class="container-fluid padding-top">
<h2 class="padding-top">Ser Orador</h2>



<form class ="paddinng-top" id="formOrador" method="post" action="orador.php">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Ingrese la descripcion del tema a exponer</label>
  <textarea name="tema" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-primary">Ingresar Solicitud</button>
</form>


<h5 class="padding-top">Solicitudes a ser orador</h5>

<?php

$conexion = new conexion();

$sentencia= $conexion->consultar("SELECT * FROM `orador` where id_usuario='".$_SESSION['id']."'");

if($sentencia==null){
  echo("<p>Ud. no tiene solicitudes para ser orador</p>");
}else{
  $solicitud="";
  foreach ($sentencia as $solicitud)
  {
    //estados 1 pendiente, 2 aceptado, 3 rechazado
    if ($solicitud['estado']==1){
    echo('
    <div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">Id: #'.$solicitud['id'].' <br> Estado: Pendiente</h4>
    
    <hr>
    <p class="mb-0">'.$solicitud['comentario'].'</p>
  </div>');}
  if ($solicitud['estado']==2){
    echo('
    <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Id: #'.$solicitud['id'].' <br> Estado: Aceptado</h4>
    
    <hr>
    <p class="mb-0">'.$solicitud['comentario'].'</p>
  </div>');}
  if ($solicitud['estado']==3){
    echo('
    <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Id: #'.$solicitud['id'].' <br> Estado: Rechazado</h4>
    
    <hr>
    <p class="mb-0">'.$solicitud['comentario'].'</p>
  </div>');}

  }
}
?>



</section>






<script src="dom2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>