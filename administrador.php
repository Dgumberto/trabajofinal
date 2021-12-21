<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();


?>
<?php session_start();
?>
  <?php if($_SESSION['adm']!=1){
  header("location:usuario.php");
  exit;
  }
  ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Panel de Administrador</title>
</head>
<body>
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
            <li><a class="dropdown-item" href="#">Mi cuenta</a></li>
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>

</nav>
</header> 

<section class="container-fluid padding-top">
    <h2>Solicitudes pendientes para ser orador</h2>
    <form id="formEntradas" method="post" action="administrador.php">
    <select name="opcion" id="listadoSolicitudes" class="form-select" aria-label="Default select example">'

    <?php
$conexion = new conexion();




$sentencia= $conexion->consultar("SELECT dni,nombre,apellido,orador.id,id_usuario,estado,comentario FROM `orador`,`usuario` WHERE id_usuario=usuario.id AND estado=1");
if($sentencia==null){
    echo("<p>Ud. no tiene solicitudes para ser orador</p>");
  }else{
    
    $orador="";
    foreach ($sentencia as $orador){
echo('<option  value="'.$orador['id'].'"> Solicitud # '.$orador['id'].' '.$orador['dni'].' '.$orador['nombre'].' '.$orador['apellido'].'</option>');
    }
  }
    
?>
</select>

<button type="submit" class="btn btn-primary">Buscar</button>

<form id="formEstado" method="post" action="confirmacion.php">
  <?php
if ($_POST){
  $id=$_POST['opcion'];
 

  $conexion = new conexion();

  $sentencia= $conexion->consultar("SELECT dni,nombre,apellido,orador.id,id_usuario,estado,comentario FROM `orador`,`usuario` WHERE id_usuario=usuario.id AND orador.id=$id AND estado=1;");

  
echo('<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Nombre</th>
    <th scope="col">Apellido</th>
    <th scope="col">DNI</th>
    <th scope="col">Comentario</th>
  </tr>
</thead>');
echo('   <tbody>
<tr>
  <th scope="row">'.$sentencia[0]['id'].'</th>
  <td>'.$sentencia[0]['nombre'].'</td>
  <td>'.$sentencia[0]['apellido'].'</td>
  <td>'.$sentencia[0]['dni'].'</td>
  <td>'.$sentencia[0]['comentario'].'</td>
</tr>
');
echo('  </tbody>
</table>');
  }
  if( isset($sentencia[0]['id'])){
  $_SESSION['id_orador']=$sentencia[0]['id'];}
  ?>



</form>


</form>

<?php
if ($_POST){
echo('<div class="container-fluid padding-top">
<h3>Responder Solicitud</h3>
<form action="conforador.php" method="post">

<label for="exampleFormControlTextarea1" class="form-label">Ingrese la respuesta</label>
  <textarea class="form-control" name="comentario" id="exampleFormControlTextarea1" rows="3"></textarea>
  <button type="submit" name="boton" value="2"class="btn btn-success">Aceptar</button>
  <button type="submit" name="boton" value="3" class="btn btn-danger">Rechazar</button>

</form>

</div>');
}
?>

</section>

<hr>
<section class="container-fluid padding-top">
<h2>Solicitudes para ser orador</h2>
<?php
// Aca es la consulta de todos los oradores
$conexion = new conexion();

  $sentencia= $conexion->consultar("SELECT orador.id as id,estado,usuario.nombre as nombre, usuario.apellido as apellido, usuario.dni as dni, usuario.mail as mail, comentario FROM `orador`,`usuario` WHERE usuario.id=orador.id_usuario LIMIT 10;");
echo('<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Nombre</th>
    <th scope="col">Apellido</th>
    <th scope="col">DNI</th>
    <th scope="col">Comentario</th>
    <th scope="col">Estado</th>
  </tr>
</thead>
');
$oradores="";
foreach ($sentencia as $oradores)
{    
  $estadoOrador="";
  if($oradores['estado']==1){
$estadoOrador="Pendiente";
  }
  if($oradores['estado']==2){
    $estadoOrador="Aceptado";
      }
      if($oradores['estado']==3){
        $estadoOrador="Rechazado";
          }
  echo('    <tr>
  <th scope="row">'.$oradores['id'].'</th>
  <td>'.$oradores['nombre'].'</td>
  <td>'.$oradores['apellido'].'</td>
  <td>'.$oradores['dni'].'</td>
  <td>'.$oradores['comentario'].'</td>
  <td>'.$estadoOrador.'</td>

</tr>');

}


echo('  </tbody>
</table>');


?>
<p>Se visualizan las 10 primeras, <a href="ver.php?view=oradores" target="_blank">Mostrar todas</a></p>
</section>

<hr>
<section class="container-fluid padding-top">
<h2>Listado de entradas compradas</h2>
<?php
//Aca se muestran las entradas compradas
$conexion = new conexion();

$sentencia= $conexion->consultar("SELECT entradas.id as id, entradas.apellido as apellido, entradas.nombre as nombre, entradas.dni as dni FROM `entradas`,`usuario` WHERE entradas.comprador=usuario.id LIMIT 10;");
echo('<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Nombre</th>
    <th scope="col">Apellido</th>
    <th scope="col">DNI</th>
  </tr>
</thead>
');
$listEntradas="";
foreach ($sentencia as $listEntradas)
{    

  echo('    <tr>
  <th scope="row">'.$listEntradas['id'].'</th>
  <td>'.$listEntradas['nombre'].'</td>
  <td>'.$listEntradas['apellido'].'</td>
  <td>'.$listEntradas['dni'].'</td>

</tr>');

}

echo('  </tbody>
</table>');


?>
<p>Se visualizan las 10 primeras, <a href="ver.php?view=entradas" target="_blank">Mostrar todas</a></p>
</section>





<script src="dom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
