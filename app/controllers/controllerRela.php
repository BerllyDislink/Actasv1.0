<?php
require_once '../models/relaciones.model.php';

$method = $_GET["method"];
switch ($method) {
    case "listaIdActas":
        listaIdActas();
        break;
    case "listaIdsResponsables":
        listaIdsResponsables();
        break;
    case "guardarAsist":
        guardarAsist();
        break;
    case "actualizarAsist":
        actualizarAsist();
        break;
    case "eliminarAsist":
        eliminarAsist();
        break;
    case "listadoAsist":
        listadoAsist();
        break;
}

//listado
function listaIdActas()
{
    $actas_data = RelaModel::listaIdActas();
    echo json_encode($actas_data);
}

function listaIdsResponsables()
{
    $ids_respo = RelaModel::listaResponsables($_POST['actas_id']);
    echo json_encode($ids_respo);
}

function guardarAsist()
{
    $arrayName = array(
        'fk_actas_id' => $_POST['r_id_acta'],
        'fk_users_id' => $_POST['r_id_user'],
    );

    echo json_encode(RelaModel::guardarAsist($arrayName));
}

//actualizar
function actualizarAsist()
{
    $respaldo = array(
        'fk_actas_id' => $_POST['respaldoActa'],
        'fk_users_id' => $_POST['respaldoUser'],
    );
    $data = array(
        'fk_actas_id' => $_POST['r_id_acta'],
        'fk_users_id' => $_POST['r_id_user'],
    );
    $error[0] = "El usuario ya se encuentra en el acta";
    if (RelaModel::checkDuploAsist($respaldo)) {
        //RelaModel::eliminarAsist($respaldo);
        echo json_encode(RelaModel::guardarAsist($data));
    } else {
        echo json_encode($error);
    }
}

//eliminar
function eliminarAsist()
{
    $data = array(
        'fk_actas_id' => $_POST['actas_id'],
        'fk_users_id' => $_POST['users_id'],
    );
    echo json_encode(RelaModel::eliminarAsist($data));
}

function listadoAsist()
{
    $data = RelaModel::mostrarDatos();
    echo json_encode($data);
}