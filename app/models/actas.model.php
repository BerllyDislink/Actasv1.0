<?php
require_once "../config/connection.php";
class ActasModel extends Connection
{
    public static function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM actas ORDER BY actas_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function obtenerDatoId($actas_id)
    {
        try {
            $sql = "SELECT * FROM actas WHERE actas_id = :actas_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(":actas_id", $actas_id);
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
            $sql = "INSERT INTO actas (nombre, descripcion, fecha_de_creacion) VALUES (:nombre, :descripcion, :fecha_de_creacion)";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':fecha_de_creacion', $data['fecha_de_creacion']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function actualizarDato($data)
    {
        try {
            $sql = 'UPDATE actas SET nombre = :nombre, descripcion = :descripcion, fecha_de_creacion = :fecha_de_creacion WHERE actas_id = :actas_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':actas_id', $data['actas_id']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':fecha_de_creacion', $data['fecha_de_creacion']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function eliminarDato($actas_id)
    {
        try {
            $sql = 'DELETE FROM actas WHERE actas_id = :actas_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':actas_id', $actas_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
