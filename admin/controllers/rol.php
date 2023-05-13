<?php
require_once(__DIR__."/sistema.php");
class Rol extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * FROM rol r 
            LEFT JOIN rol_privilegio rp ON r.id_rol = rp.id_rol 
            LEFT JOIN privilegio p ON rp.id_privilegio = p.id_privilegio";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "SELECT * FROM rol r 
            LEFT JOIN rol_privilegio rp ON r.id_rol = rp.id_rol 
            LEFT JOIN privilegio p ON rp.id_privilegio = p.id_privilegio where r.id_rol=:id";
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
        $sql = "INSERT INTO rol (rol) VALUES (:rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();

        $id_newr = $this->db->lastInsertId();

        $sql2 = "INSERT INTO rol_privilegio (id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id_rol", $id_newr, PDO::PARAM_INT);
        $st2->bindValue(":id_privilegio", $data['id_privilegio'], PDO::PARAM_INT);
        $st2->execute();
        
        $rc = $st2->rowCount();
        return $rc;
    }
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE rol SET rol = :rol where id_rol= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();
        
        $sql2 = "UPDATE rol_privilegio SET id_rol = :id, id_privilegio = :id_privilegio WHERE id_rol = :id";
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(":id", $id, PDO::PARAM_INT);
        $st2->bindParam(":id_privilegio", $data['id_privilegio'], PDO::PARAM_INT);
        $st2->execute();

        $rc = $st2->rowCount();
        return $rc;
    }
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM rol WHERE id_rol=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $sql = "DELETE FROM rol_privilegio WHERE id_rol = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$rol = new Rol;
?>

