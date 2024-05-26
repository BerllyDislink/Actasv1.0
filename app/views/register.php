<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../public/css/register.css">

</head>

<?php
include_once "../../app/helpers/sesion_helper.php";
?>

<body>
<a href="inicio.php">
<img id="imagenlogo" src="../../public/images/Logo.png" alt="No sirve esta vaina">
</a>
    <div class="container">
     
        <?php flash('register'); ?>
        <form id="register_form" method="post" action="../controllers/ControllerSesion.php">
            <input type="hidden" name="type" value="register">
            <h1>Comencemos</h1>
            <div class="button-grid">
            <input type="text" id="correo" name="correo" placeholder="Ingrese su correo" autocomplete="email" required>

          
            <select class = "correo-select" name="emailInst" id="emailInst" required>
                <option disabled selected value> @Selecciona tu correo institucional </option>
                <option value="@correo.unicordoba.edu.co">@correo.unicordoba.edu.co</option>
            </select>
            
           
            <input type="password"  id="password" name="password" placeholder="Ingrese su contraseña "
                autocomplete="new-password" required>

            
            <input type="password" id="repeatPassword" name="repeatPassword"
                placeholder="Ingrese su contraseña nuevamente" autocomplete="new-password" required>

            <!-- <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" placeholder="Nombres" autofocus/>

            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" autofocus/>

            <label for="facultad">Facultad</label>
            <input type="text" id="facultad" name="facultad" placeholder="Facultad" autofocus/>

            <label for="carrera">Carrera</label>
            <input type="text" id="carrera" name="carrera" placeholder="Carrera" autofocus/> -->
            
            <button type="submit" class ="registrar-button">Registrarse</button>
            <a href="./login.php"><button type="button" class="Yatengo-cuenta-button">Ya tengo una cuenta</button></a>
        </div>
        </div>
        
        </form>
    </div>
    <script src="../assets/fStorage.js"></script>
</body>

</html>