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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Listado</title>
</head>
<body>
    <section class="container-fuid">
        <?php
if ($_GET){
if ($_GET['view']=="oradores"){

    $conexion = new conexion();

  $sentencia= $conexion->consultar("SELECT orador.id as id,estado,usuario.nombre as nombre, usuario.apellido as apellido, usuario.dni as dni, usuario.mail as mail, comentario FROM `orador`,`usuario` WHERE usuario.id=orador.id_usuario;");
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
$conexion = new conexion();

$sentencia= $conexion->consultar("SELECT COUNT(*) AS resultado FROM `orador`,`usuario` WHERE orador.id_usuario=usuario.id");
echo('
<tr>
<th class="table-dark" scope="row">Total</th>
<td class="table-dark" colspan="5"> <b>'.$sentencia[0]['resultado'].' solicitudes</td>

</tr>');

echo('  </tbody>
</table>');

    echo('<button type="button" class="btn btn-dark " onclick="window.print();">Imprimir</button>');
}



//para ver entradaS
 if($_GET['view']=="entradas"){
    $sentencia= $conexion->consultar("SELECT entradas.id as id, entradas.apellido as apellido, entradas.nombre as nombre, entradas.dni as dni FROM `entradas`,`usuario` WHERE entradas.comprador=usuario.id;");
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
    $conexion = new conexion();
    $sentencia= $conexion->consultar("SELECT COUNT(*) as resultado FROM `entradas`,`usuario` WHERE entradas.comprador=usuario.id;");
echo('
<tr>
<th class="table-dark" scope="row">Total</th>
<td class="table-dark" colspan="5"> <b>'.$sentencia[0]['resultado'].' entradas</td>

</tr>');
    echo('  </tbody>
    </table>');
    echo('<button type="button" class="btn btn-dark " onclick="window.print();">Imprimir</button>');
}} 

    ?>


    </section>


    <script src="dom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>