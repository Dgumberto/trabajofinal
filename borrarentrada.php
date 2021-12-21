<?php include 'conexion.php'; ?>
<?php
session_start();
$conexion = new conexion();

// formulario para solicitar ser orador
if ($_GET){
$idEntrada=$_GET['borrar'];




$conexion = new conexion();
$sql=("DELETE FROM `entradas` WHERE id=$idEntrada");
$id_proyecto = $conexion->ejecutar($sql);



}
header("location:usuario.php");
exit;
?>