<?php
require_once "../config/connection.php";
class ComproModel extends Connection
{
    public static function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM compromisos ORDER BY compromisos_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function obtenerDatoId($compromisos_id)
    {
        try {
            $sql = "SELECT * FROM compromisos WHERE compromisos_id = :compromisos_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(":compromisos_id", $compromisos_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function guardarDato($data)
    {
        try {
            $sql = "INSERT INTO compromisos (nombre, descripcion, estado, fk_actas_id, responsable_users_id) VALUES (:nombre, :descripcion, :estado, :fk_actas_id, :responsable_users_id)";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':fk_actas_id', $data['fk_actas_id']);
            $stmt->bindParam(':responsable_users_id', $data['responsable_users_id']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function actualizarDato($data)
    {
        try {
            $sql = 'UPDATE compromisos SET nombre = :nombre, descripcion = :descripcion, estado = :estado, fk_actas_id = :fk_actas_id, responsable_users_id = :responsable_users_id WHERE compromisos_id = :compromisos_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':compromisos_id', $data['compromisos_id']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':fk_actas_id', $data['fk_actas_id']);
            $stmt->bindParam(':responsable_users_id', $data['responsable_users_id']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function eliminarDato($compromisos_id)
    {
        try {
            $sql = 'DELETE FROM compromisos WHERE compromisos_id = :compromisos_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':compromisos_id', $compromisos_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}