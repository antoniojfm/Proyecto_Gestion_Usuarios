<?php
//error_reporting(0);
date_default_timezone_set('Europe/Paris');
$fecha = date('y-m-d H:i:s');

extract($_GET);
$conn = mysqli_connect("localhost","root","","bd_usuarios",3306);
$usuarioID = "SELECT * FROM `usuarios` WHERE `id` = '$id'";
$resultID = mysqli_query($conn,$usuarioID);

while($registro = mysqli_fetch_row($resultID)) {
    $nombre = $registro[1];
    $contraseña = $registro[2];
    $email = $registro[3];
}

if(isset($_POST['modificacion'])) {
    $id = $_POST['id'];
    $nombreActualizado = $_POST['usuario'];
    $contraseñaActualizado = $_POST['contraseña'];
    $emailActualizado = $_POST['email'];

    $patron_usuario = "/^[A-Za-z\d\s]{1,60}$/";
    $patron_contraseña = "/^[A-Za-z\d]{1,16}$/";
    $patron_correo = "/^[\w]+@[a-z]{5,7}.[a-z]{2,}$/";
    
    if((preg_match($patron_usuario,$nombreActualizado)) && (preg_match($patron_contraseña,$contraseñaActualizado)) && (preg_match($patron_correo,$emailActualizado))) {
        $fechaUpdated = date($fecha);
        $actualizar = "UPDATE `usuarios` SET `nombre` = '$nombreActualizado', `contrasena` = '$contraseñaActualizado', `email` = '$emailActualizado', 
        `updated` = '$fechaUpdated' WHERE `id` = '$id'";
        $result = mysqli_query($conn,$actualizar);
        if($result == true) {
            ?> <script> alert("Usuario <?php echo $nombreActualizado ?> actualizado correctamente");</script> <?php
            header("location: ../Proyecto_Final_AntonioJesus/index.php");
        }
        $conn->close();
    }
    else {
        ?> <script> alert("El dato o los datos introducidos no son validos");</script> <?php
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Usuarios</title>
    <link rel="stylesheet" href="estilo.css" type="text/css">
</head>

<body>
    
    <form id="FormularioModificacion" action="modificar.php" method="POST">
        <h3>Formulario Modificacion Usuarios</h3>
        <input type="text" name="id" value="<?php echo $id ?>" hidden>
        <input type="text" name="usuario" size="60" maxlength="64" value="<?php echo $nombre ?>">
        <input type="text" name="contraseña" size="60" maxlength="32" value="<?php echo $contraseña ?>">
        <input type="email" name="email" size="60" maxlength="64"  value="<?php echo $email ?>">
        <input type="submit" name="modificacion" value="Modificar Usuario">
    </form>
    
</body>
</html>