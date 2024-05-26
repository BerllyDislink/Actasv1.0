<?php
require_once '../models/compro.model.php';
require_once '../models/users.model.php';
require_once '../models/actas.model.php';

$method = $_GET["method"];
switch ($method) {
    case "listadoCompro":
        listadoCompro();
        break;
    case "guardarCompro":
        guardarCompro();
        break;
    case "actualizarCompro":
        actualizarCompro();
        break;
    case "editarCompro":
        editarCompro();
        break;
    case "eliminarCompro":
        eliminarCompro();
        break;
}

//listado
function listadoCompro()
{
    $Compro_data = ComproModel::mostrarDatos();
    echo json_encode($Compro_data);
}




//guardar
function guardarCompro()
{
    $arrayName = array(
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'estado' => $_POST['estado'],
        'fk_actas_id' => $_POST['acta_compro'],
        'responsable_users_id' => $_POST['responsable'],
    );

    file_put_contents("../../log.json", json_encode($arrayName, JSON_PRETTY_PRINT));
    echo json_encode(ComproModel::guardarDato($arrayName));
}

//actualizar
function actualizarCompro()
{
    $arrayName = array(
        'compromisos_id' => $_POST['compromisos_id'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'estado' => $_POST['estado'],
        'fk_actas_id' => $_POST['acta_compro'],
        'responsable_users_id' => $_POST['responsable'],
    );

    echo json_encode(ComproModel::actualizarDato($arrayName));
}

//editar
function editarCompro()
{
    echo json_encode(ComproModel::obtenerDatoId($_POST['compromisos_id']));
}


//eliminar
function eliminarCompro()
{
    echo json_encode(ComproModel::eliminarDato($_POST['id']));
}