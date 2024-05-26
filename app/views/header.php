<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcTask</title>
    <link rel="stylesheet" href="../../public/css/styles.css" type="text/css">
</head>

<body>
    <nav>
        <ul>
            <a href="inicio.php">
                <li>AcTask</li>
            </a>
            <?php if (!isset($_SESSION['users_id'])) : ?>
                <a href="register.php">
                    <li>Registro</li>
                </a>
                <a href="login.php">
                    <li>Login</li>
                </a>
            <?php else : ?>
                <a href="../controllers/controllerSesion.php?q=logout">
                    <li>Logout</li>
                </a>
            <?php endif; ?>
        </ul>
    </nav>