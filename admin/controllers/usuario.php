<?php
require_once("sistema.php");
class Usuario extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * FROM usuario u 
            LEFT JOIN rol_usuario ru ON u.id_usuario = ru.id_usuario 
            LEFT JOIN rol r ON ru.id_rol = r.id_rol;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM usuario u 
            LEFT JOIN rol_usuario ru ON u.id_usuario = ru.id_usuario 
            LEFT JOIN rol r ON ru.id_rol = r.id_rol WHERE u.id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function new ($data)
    {
        $this->db();
        $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $contrasena = md5($data['contrasena']);
        $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $st->execute();
        
        $id_new = $this->db->lastInsertId();

        $sql2 = "INSERT INTO rol_usuario (id_usuario, id_rol) VALUES (:id_usuario, :id_rol)";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id_usuario", $id_new, PDO::PARAM_INT);
        $st2->bindValue(":id_rol", $data['id_rol'], PDO::PARAM_INT);
        $st2->execute();

        $rc = $st2->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE usuario SET correo = :correo, contrasena = :contrasena WHERE id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $contrasena = md5($data['contrasena']);
        $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $st->execute();

        $sql2 = "UPDATE rol_usuario SET id_usuario = :id, id_rol = :id_rol WHERE id_usuario = :id";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id", $id, PDO::PARAM_INT);
        $st2->bindValue(":id_rol", $data['id_rol'], PDO::PARAM_INT);
        $st2->execute();

        $rc = $st2->rowCount();
        return $rc;
    }
    
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM usuario WHERE id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $sql = "DELETE FROM rol_usuario WHERE id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function getPriv($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * FROM rol r 
            LEFT JOIN rol_privilegio rp ON r.id_rol = rp.id_rol 
            LEFT JOIN privilegio p ON rp.id_privilegio = p.id_privilegio";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else {
            $sql = "SELECT * FROM rol r 
            LEFT JOIN rol_privilegio rp ON r.id_rol = rp.id_rol 
            LEFT JOIN privilegio p ON rp.id_privilegio = p.id_privilegio where r.id_rol = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function deletePriv($id)
    {
        $this->db();
        $sql = "DELETE FROM privilegio WHERE id_privilegio=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newPriv ($id, $data)
    {
        $this->db();
        $sql = "INSERT INTO privilegio (id_rol, privilegio) values (:id_rol, :privilegio)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_rol", $id, PDO::PARAM_INT);
        $st->bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function editPriv($id, $id_rol, $id_privilgio)
    {
        $this->db();
        $sql = "UPDATE privilegio SET tarea = :tarea, avance = :avance where id_tarea = :id_tarea and id_proyecto = :id_proyecto";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $st->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $st->bindParam(":id_privilegio", $id_privilgio, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$usuario = new Usuario;
?>