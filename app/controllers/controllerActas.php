<?php
require_once '../models/actas.model.php';

$method = $_GET["method"];
switch ($method) {
    case "listadoActas":
        listadoActas();
        break;
    case "guardarActas":
        guardarActas();
        break;
    case "actualizarActas":
        actualizarActas();
        break;
    case "editarActas":
        editarActas();
        break;
    case "eliminarActas":
        eliminarActas();
        break;
}

//listado
function listadoActas()
{
    $actas_data = ActasModel::mostrarDatos();
    echo json_encode($actas_data);
}


//guardar
function guardarActas()
{
    $arrayName = array(
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'fecha_de_creacion' => $_POST['fecha_de_creacion'],
    );

    echo json_encode(ActasModel::guardarDato($arrayName));
}

//actualizar
function actualizarActas()
{
    $arrayName = array(
        'actas_id' => $_POST['actas_id'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'fecha_de_creacion' => $_POST['fecha_de_creacion'],
    );

    echo json_encode(ActasModel::actualizarDato($arrayName));
}

//editar
function editarActas()
{
    echo json_encode(ActasModel::obtenerDatoId($_POST['actas_id']));
}


//eliminar
function eliminarActas()
{
    echo json_encode(ActasModel::eliminarDato($_POST['id']));
}
