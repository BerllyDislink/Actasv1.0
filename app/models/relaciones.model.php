<?php
require_once "../config/connection.php";
class RelaModel extends Connection
{
    public static function listaIdActas()
    {
        try {
            $sql = "SELECT actas_id FROM actas ORDER BY actas_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function listaResponsables($actas_id)
    {
        try {
            $sql = "SELECT fk_users_id FROM users_actas WHERE fk_actas_id = :fk_actas_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(":fk_actas_id", $actas_id);
            $stmt->execute();
            $users_ids = $stmt->fetchAll();
            return $users_ids;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkDuploAsist($data)
    {
        try {
            $sql = "SELECT * FROM users_actas WHERE fk_actas_id = :fk_actas_id AND fk_users_id = :fk_users_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':fk_actas_id', $data['fk_actas_id']);
            $stmt->bindParam(':fk_users_id', $data['fk_users_id']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function guardarAsist($data)
    {
        try {
            $sql = "INSERT INTO users_actas (fk_actas_id, fk_users_id) VALUES (:fk_actas_id, :fk_users_id)";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':fk_actas_id', $data['fk_actas_id']);
            $stmt->bindParam(':fk_users_id', $data['fk_users_id']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function eliminarAsist($data)
    {
        try {
            $sql = 'DELETE FROM users_actas WHERE fk_actas_id = :fk_actas_id AND fk_users_id = :fk_users_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':fk_actas_id', $data['fk_actas_id']);
            $stmt->bindParam(':fk_users_id', $data['fk_users_id']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM users_actas ORDER BY fk_actas_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /*
    

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
    }*/
}