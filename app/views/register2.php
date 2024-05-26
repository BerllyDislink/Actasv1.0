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
    <div class="container">
        <?php flash('register'); ?>
        <form id="register2_form" method="post" action="../controllers/ControllerSesion.php">
            <input type="hidden" name="type" value="register2">
            <h1>Completa la información</h1>
            <div class="button-grid">
                <input type="hidden" id="correo" name="correo" value="no">
                <input type="hidden" id="password" name="password" value="no">
                <input type="text" id="nombres" name="nombres" placeholder="Nombres" required autofocus />
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required autofocus />

                <select class="facultad-select" name="facultad" id="facultad" required>
                    <option disabled selected value>Selecciona tu facultad</option>
                    <option value="Facultad de Ingenierías">Facultad de Ingenierías</option>
                    <option value="Facultad de Medicina Veterinaria y Zootecnia">Facultad de Medicina Veterinaria y
                        Zootecnia</option>
                    <option value="Facultad de Ciencias Agrícolas">Facultad de Ciencias Agrícolas</option>
                    <option value="Facultad de Ciencias Básicas">Facultad de Ciencias Básicas</option>
                    <option value="Facultad de Educación y Ciencias Humanas">Facultad de Educación y Ciencias Humanas
                    </option>
                    <option value="Facultad de Ciencias Económicas, Jurídicas y Administrativas">Facultad de Ciencias
                        Económicas, Jurídicas y Administrativas</option>
                    <option value="Facultad de Ciencias de la Salud">Facultad de Ciencias de la Salud</option>
                </select>

                <select class="departamento-select" name="departamento" id="departamento" required disabled>
                    <option disabled selected value>Selecciona tu departamento</option>
                </select>
            </div>
            <button type="submit" class="registrar-button1">Continuar</button>
        </form>
    </div>

    <script src="../assets/fStorage.js"></script>
    <script src="../assets/fInfoCarreras.js"></script>
</body>

</html>