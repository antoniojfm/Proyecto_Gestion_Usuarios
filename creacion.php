<?php

error_reporting(0);
date_default_timezone_set('Europe/Paris');
$fecha = date('y-m-d H:i:s');

if(isset($_POST['creacion'])) {
    $nombre = $_POST['usuario'];
    $contrasena = $_POST['contraseña'];
    $email = $_POST['email'];
    
    $patron_usuario = "/^[A-Za-z\d\s]{1,60}$/";
    $patron_contraseña = "/^[A-Za-z\d]{1,16}$/";
    $patron_correo = "/^[\w]+@[a-z]{5,7}.[a-z]{2,}$/";

    if((preg_match($patron_usuario,$nombre)) && (preg_match($patron_contraseña,$contrasena)) && (preg_match($patron_correo,$email))) {
        $conn = mysqli_connect("localhost", "root", "", "bd_usuarios", 3306);
        $conn->set_charset("utf8");
        $usuario_creado = date($fecha);
        $insertUsuario = "INSERT INTO `usuarios` (`nombre`, `contrasena`, `email`, `created`, `updated`, `lastlogin`) 
        VALUES ('$nombre', '$contrasena', '$email', '$usuario_creado', '$usuario_creado', '$usuario_creado')";
        $ok = mysqli_query($conn,$insertUsuario);
        if($ok) {
            ?> <script> alert("Usuario <?php echo $nombre ?> creado correctamente");</script> <?php
            header("location: ../Proyecto_Final_AntonioJesus/index.php");
        }
        $conn->close();
    }
    else {
        ?> <script> alert("El dato o los datos introducidos no son validos");</script> <?php
        $usuario_incorrecto = preg_replace($patron_usuario,"",$nombre);
        $password_incorrecto = preg_replace($patron_contraseña,"",$contrasena);
        $correo_incorrecto = preg_replace($patron_correo,"",$email);
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
    
    <form id="FormularioCreacion" action="creacion.php" method="POST">
        <h3>Formulario Creacion Usuarios</h3>
        <input type="text" name="usuario" size="60" maxlength="64" placeholder="Usuario*" value="<?php echo $usuario_incorrecto ?>" required>
        <input type="text" name="contraseña" size="60" maxlength="32" placeholder="Contraseña*" value="<?php echo $password_incorrecto ?>" required>
        <input type="email" name="email" size="60" maxlength="64" placeholder="Correo Electronico*" value="<?php echo $correo_incorrecto ?>" required>
        <input type="submit" name="creacion" value="Crear Usuario">
    </form>
    
</body>
</html>