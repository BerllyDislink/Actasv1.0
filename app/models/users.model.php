<?php
require_once "../config/connection.php";
class UsersModel extends Connection
{

    public static function mostrarDatos()
    {
        try {
            $sql = "SELECT * FROM users ORDER BY users_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function login($correo, $password)
    {
        $row = $this->obtenerDato($correo);

        if ($row == false) return false;

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public static function obtenerDato($id_correo)
    {
        try {
            $sql = "SELECT * FROM users WHERE users_id = :users_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(":users_id", $id_correo);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result == null) {
                $sql = "SELECT * FROM users WHERE correo = :correo";
                $stmt = Connection::getConnection()->prepare($sql);
                $stmt->bindParam(":correo", $id_correo);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                if ($result == null) {
                    return false;
                } else {
                    return $result;
                }
            }
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function guardarDato($data)
    {
        try {
            $sql = "INSERT INTO users (correo, password, nombres, apellidos, facultad, carrera) VALUES (:correo, :password, :nombres, :apellidos, :facultad, :carrera)";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':nombres', $data['nombres']);
            $stmt->bindParam(':apellidos', $data['apellidos']);
            $stmt->bindParam(':facultad', $data['facultad']);
            $stmt->bindParam(':carrera', $data['carrera']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function actualizarDato($data)
    {
        try {
            $sql = "UPDATE users SET correo = :correo, password = :password, nombres = :nombres, apellidos = :apellidos, facultad = :facultad, carrera = :carrera WHERE users_id = :users_id";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':users_id', $data['users_id']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':nombres', $data['nombres']);
            $stmt->bindParam(':apellidos', $data['apellidos']);
            $stmt->bindParam(':facultad', $data['facultad']);
            $stmt->bindParam(':carrera', $data['carrera']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function eliminarDato($users_id)
    {
        try {
            $sql = 'DELETE FROM users WHERE users_id = :users_id';
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':users_id', $users_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function guardarDatoConfirmacion($data)
    {
        try {
            $sql = "INSERT INTO users_sin_confirmar (correo, password, nombres, apellidos, facultad, carrera, codigo_correo) VALUES (:correo, :password, :nombres, :apellidos, :facultad, :carrera, :codigo_correo)";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':nombres', $data['nombres']);
            $stmt->bindParam(':apellidos', $data['apellidos']);
            $stmt->bindParam(':facultad', $data['facultad']);
            $stmt->bindParam(':carrera', $data['carrera']);
            $stmt->bindParam(':codigo_correo', $data['codigo_correo']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function obtenerDatoConfirmacion($codigo_correo)
    {
        try {
            $sql = "SELECT * FROM users_sin_confirmar WHERE codigo_correo = :codigo_correo";
            $stmt = Connection::getConnection()->prepare($sql);
            $stmt->bindParam(":codigo_correo", $codigo_correo);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result == null) {
                $sql = "SELECT * FROM users_sin_confirmar WHERE correo = :correo";
                $stmt = Connection::getConnection()->prepare($sql);
                $stmt->bindParam(":correo", $codigo_correo);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                if ($result == null) {
                    return false;
                } else {
                    return $result;
                }
            }
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
