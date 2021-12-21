

<?php include 'conexion.php'; ?>
<?php session_start();?>
<?php
$conexion = new conexion();


if($_POST){
$estado=$_POST['boton'];
$comentario=$_POST['comentario'];
$id=  $_SESSION['id_orador'];
$sql="UPDATE `orador` SET `estado`=$estado,`comentario`='$comentario' WHERE id=$id";

$id_proyecto = $conexion->ejecutar($sql);

}
header("location:administrador.php");
exit;
?>