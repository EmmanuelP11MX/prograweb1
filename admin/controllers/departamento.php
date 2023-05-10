<?php
    require_once("sistema.php");

    class Departamento extends Sistema
    {
        public function get($id = null)
        {
            $this->db();
            if (is_null($id)) {
                $sql = "SELECT * FROM departamento";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM departamento WHERE id_departamento = :id";
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
            $sql = "INSERT INTO departamento (departamento) VALUES (:departamento)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function edit($id, $data)
        {
            $this->db();
            $sql = "update departamento set departamento = :departamento where id_departamento = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
        
        public function delete($id)
        {
            $this->db();
            $sql = "delete from departamento where id_departamento = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

    }
    $departamento = new Departamento;
?>