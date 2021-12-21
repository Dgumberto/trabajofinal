

<?php include 'conexion.php'; ?>

<?php
$conexion = new conexion();


?>
<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Imprimir</title>
</head>
<body>
</div>
<section class="container-fluid">

    <h2 class="padding-top">  Conferencia Codo a Codo 4.0 2021</h2>
    <h3 class="padding-top">  Entradas:</h3>
    <table class=" padding_top table table-striped">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">DNI</th>
     

    </tr>
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
    <td>'.$entradas['dni'].'</td>');}
  
}
?>
</tbody>

</thead>
</table>

<button type="button" class="btn btn-dark " onclick="window.print();">Imprimir</button>



<script src="dom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>