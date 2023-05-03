<?php
require_once("sistema.php");
class Empleado extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from empleado e left join departamento 
                    d on e.id_departamento = d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "select * from empleado e left join departamento d on 
                    e.id_departamento = d.id_departamento where e.id_empleado;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function new($data){
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO empleado(nombre, primer_apellido, segundo_apellido, fecha_nacimiento, rfc, curp, id_departamento) 
            VALUES (:nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :rfc, :curp, :id_departamento)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
            $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
            $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);            
            $st->execute();
            $rc = $st->rowCount();
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }
        return $rc;
    }
    
    public function delete($id){
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "DELETE FROM empleado where id_empleado=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st->execute();
            $rc = $st->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }
        return $rc;
    }
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE empleado 
        SET nombre =:nombre, primer_apellido =:primer_apellido,, segundo_apellido =:segundo:apellido,
        fecha_nacimiento =:fecha_nacimiento, rfc =:rfc, curp =:curp, id_empleado =:id_empleado
        where id_empleado =:id";
        $st = $this->db->prepare($sql);
        //$st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":id_empleado", $data['id_empleado'], PDO::PARAM_INT);
        $st->bindParam(":foto", $data['foto'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$empleado = new Empleado;
?>