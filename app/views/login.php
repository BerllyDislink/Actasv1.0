<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/login.css">

 
</head>

<?php
include_once "../../app/helpers/sesion_helper.php";
?>

<body class="log">
<a href="inicio.php">
<img id="imagenlogo" src="../../public/images/Logo.png" alt="No sirve esta vaina">
</a>
    <div class="container">
    <div class="content-area">
        <h1>Iniciar sesión</h1>
        <form method="post" action="../controllers/controllerSesion.php">
            <?php flash('login');?>
            <input type="hidden" name="type" value="login">

            <div class="button-grid">
            <input type="text" id="correo" name="correo" placeholder="Ingrese su correo" autocomplete="email" required>
            <select class="correo-select" name="emailInst" id="emailInst" required>
                <option disabled selected value class ="color-select"> @correo.institución </option>
                <option value="@correo.unicordoba.edu.co">@correo.unicordoba.edu.co</option>
            </select>
          
            <input type="password" class = "paswor" id="password" name="password" placeholder="Ingrese su contraseña"
                autocomplete="current-password" required>
                
            <button type="submit" class="continuar-button">Continuar</button>
            <a href="./register.php"><button type="button" class="crear-cuenta-button">Crear una cuenta</button></a>
            </div>
            </div>
        </form>
    </div>
    <script></script>
</body>

</html>