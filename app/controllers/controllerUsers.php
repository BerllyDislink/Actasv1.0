<?php
require_once "../models/users.model.php";

$method = $_GET["method"];
switch ($method) {
    case "listadoUsers":
        listadoUsers();
        break;
    case "guardarUsers":
        guardarUsers();
        break;
    case "actualizarUsers":
        actualizarUsers();
        break;
    case "editarUsers":
        editarUsers();
        break;
    case "eliminarUsers":
        eliminarUsers();
        break;
    case 'guardarConfir':
        guardarConfir();
        break;
    case 'obtenerUserConfir':
        obtenerUserConfir();
        break;
}

//listado
function listadoUsers()
{
    $users_data = UsersModel::mostrarDatos();
    echo json_encode($users_data);
}


//guardar
function guardarUsers()
{
    $arrayName = array(
        'correo' => $_POST['correo'],
        'password' => $_POST['password'],
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'facultad' => $_POST['facultad'],
        'carrera' => $_POST['carrera'],
    );

    echo json_encode(UsersModel::guardarDato($arrayName));
}


//actualizar
function actualizarUsers()
{
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $arrayUsers = array(
        'users_id' => $_POST['users_id'],
        'correo' => $_POST['correo'],
        'password' => $_POST['password'],
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'facultad' => $_POST['facultad'],
        'carrera' => $_POST['carrera'],
    );

    echo json_encode(UsersModel::actualizarDato($arrayUsers));
}

//editar
function editarUsers()
{
    echo json_encode(UsersModel::obtenerDato($_POST['users_id']));
}


//eliminar
function eliminarUsers()
{
    echo json_encode(UsersModel::eliminarDato($_POST['id']));
}

function guardarConfir()
{
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $arrayName = array(
        'correo' => $_POST['correo'],
        'password' => $_POST['password'],
    );

    echo json_encode(UsersModel::guardarDatoConfirmacion($arrayName));
}

function obtenerUserConfir()
{
    echo json_encode(UsersModel::obtenerDatoConfirmacion($_POST['codigo_correo']));
}
