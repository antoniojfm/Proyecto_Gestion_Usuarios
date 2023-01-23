<?php

error_reporting(0);
date_default_timezone_set('Europe/Paris');
$fecha = date('y-m-d H:i:s');

$conn = mysqli_connect("localhost","root","","bd_usuarios",3306);
$consulta = "SELECT u.nombre, u.contrasena, r.nombre as rol  FROM usuarios u LEFT JOIN roles r ON u.type = r.id";
$result = mysqli_query($conn,$consulta);
$tuplas = mysqli_num_rows($result);
$tupla = $result->fetch_assoc();

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

if($tuplas > 0) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['rol'] = $tupla['rol'];
}
else {
    header("location: ../Proyecto_Final_AntonioJesus/login.php");
}

if(isset($_POST['login'])) {
    $patron_usuario = "/^[A-Za-z\d\s]{1,60}$/";
    $patron_contraseña = "/^[A-Za-z\d]{1,16}$/";

    if(preg_match($patron_usuario,$usuario) && preg_match($patron_contraseña,$contraseña)){
        $ultimo_login = date($fecha);
        $actualizarLastLogin = "UPDATE `usuarios` SET `lastlogin` = '$ultimo_login' WHERE `id` = " .$_SESSION['usuario'];
        ?> <script> alert("Usuario <?php echo $usuario; ?> logueado correctamente");</script> <?php
        header("location: ../Proyecto_Final_AntonioJesus/index.php");
    }
    else {
        ?> <script> alert("Usuario o contraseña incorrectos");</script> <?php
        $usuario_incorrecto = preg_replace($patron_usuario,"",$usuario);
        $password_incorrecto = preg_replace($patron_contraseña,"",$contraseña);
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
    
    <form id="FormularioInicioSesion" action="login.php" method="post">
        <h3>Formulario Login</h3>
        <input type="text" name="usuario" size="60" maxlength="64" placeholder="Usuario" value="<?php echo $usuario_incorrecto ?>">
        <input type="text" name="contraseña" size="60" maxlength="32" placeholder="Contraseña" value="<?php echo $password_incorrecto ?>">
        <input type="submit" name="login" value="Login">
    </form>
    
</body>
</html>