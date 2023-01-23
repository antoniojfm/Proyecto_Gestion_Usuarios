<?php

extract($_GET);
$conn = mysqli_connect("localhost","root","","bd_usuarios",3306);
$usuarioID = "SELECT * FROM `usuarios` WHERE `id` = '$id'";
$resultID = mysqli_query($conn,$usuarioID);

$borrar = "DELETE FROM `usuarios` WHERE `id` = '$id'";
$result = mysqli_query($conn,$borrar);

if($result == true) {
    ?> <script> alert("Usuario <?php echo $nombreActualizado ?> borrado correctamente");</script> <?php
    header("location: ../Proyecto_Final_AntonioJesus/index.php");
}
else {
    ?> <script> alert("Error al borrar el usuario");</script> <?php
}

?>