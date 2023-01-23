<?php
require_once("sesion.php");
require_once("roles.php");

$conn = mysqli_connect("localhost","root","","bd_usuarios",3306);
$queryUsuarios = "SELECT * FROM `usuarios`";
$ok = mysqli_query($conn,$queryUsuarios);
$num_usuarios = mysqli_num_rows($ok);
$conn->close();

$usuarioIniciado = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicacion Gestion Usuarios</title>
    <link rel="stylesheet" href="estilo.css" type="text/css">
</head>

<body>

    <header>

    <?php
        include("menu.html")
    ?>

    <div id="UsuarioIniciado">
        <h4>Sesion Iniciada: <?php echo $usuarioIniciado ?></h4>
    </div>

    </header>
   
    <h2 class="tituloAplicacion">Gestion de Usuarios</h2>
    <table class="aplicacion">
        <tr><td>id</td><td>Nombre</td><td>Contraseña</td><td>Correo Electronico</td><td>Fecha Creacion</td><td>Fecha Modificacion</td><td>Ultima Sesion</td><td>Modificar Usuario</td><td>Borrar Usuario</td></tr>
        <?php if($num_usuarios == 0) {
            ?> <script> alert("No hay ningun usuario en la base de datos");</script> <?php
            }
            else {
                for($i=0; $i < $num_usuarios; $i++) { 
                    $usuario = mysqli_fetch_row($ok);
                    echo "<tr>";
                    echo "<td>" . $usuario[0] . "</td>";
                    echo "<td>" . $usuario[1] . "</td>";
                    echo "<td>" . $usuario[2] . "</td>";
                    echo "<td>" . $usuario[3] . "</td>";
                    echo "<td>" . $usuario[4] . "</td>";
                    echo "<td>" . $usuario[5] . "</td>";
                    echo "<td>" . $usuario[6] . "</td>";
                    echo "<td><a href='modificar.php?id=$usuario[0]'><img src='img/editar.png' width='40px' height='40px'></a></td>";
                    echo "<td><a href='borrar.php?id=$usuario[0]'><img src='img/borrar.png' width='40px' height='40px'></a></td>";
                    echo "</tr>";
                }
            }


        ?>
    </table>

</body>
</html>