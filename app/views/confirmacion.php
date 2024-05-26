<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar correo</title>
    <link rel="stylesheet" href="../../public/css/confirmacion.css">
</head>

<?php
include_once "../../app/helpers/sesion_helper.php";
?>

<body>
    <div class="container">
        <div class="content-area">
        <h1>Se ha enviado un código de confirmación a<br> tu correo electrónico</h1>
        <form method="post" action="../controllers/ControllerSesion.php">
            <?php flash('confirmar'); ?>
            <input type="hidden" name="type" value="confirmar">
            <input type="text" class="form-control form-input" id="codigo" name="codigo" placeholder="Ingresar codigo de verificación">
            <button type="submit">Ingresar</buform>
        </form>
    </div>
    </div>
    <script></script>
</body>

</html>