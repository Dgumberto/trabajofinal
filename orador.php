<?php include 'conexion.php'; ?>
<?php
session_start();
$conexion = new conexion();

// formulario para solicitar ser orador
if ($_POST){
$tema=$_POST['tema'];
$idOrador=$_SESSION['id'];

$conexion = new conexion();
$sql="INSERT INTO `orador`(`id_usuario`, `estado`, `comentario`) VALUES ($idOrador,1,'$tema')";
//$sql="INSERT INTO `entradas` (`comprador`, `apellido`, `nombre`, `dni`) VALUES ($id, '$apellido' , '$nombre', $dni)";
$id_proyecto = $conexion->ejecutar($sql);
//INSERT INTO `entradas`(`comprador`, `apellido`, `nombre`, `dni`) VALUES (28692609,"Ned","Flanders",55555747)
}
header("location:usuario.php");
exit;
?>