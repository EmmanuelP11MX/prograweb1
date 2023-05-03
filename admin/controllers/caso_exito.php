<?php
require_once("sistema.php");
class CasoExito extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from caso_exito e left join proyecto 
                    d on e.id_proyecto = d.id_proyecto";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "select * from caso_exito e left join proyecto d on 
                    e.id_proyecto = d.id_proyecto where e.id_caso_exito;";
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
            $sql = "INSERT INTO caso_exito(caso_exito, descripcion, resumen, imagen, activo, id_proyecto) 
            VALUES (:caso_exito, :descripcion, :resumen, :imagen, :activo, :id_proyecto)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            $st->bindParam(":imagen", $data['imagen'], PDO::PARAM_STR);
            $st->bindParam(":activo", $data['activo'], PDO::PARAM_STR);
            $st->bindParam(":id_proyecto", $data['id_proyecto'], PDO::PARAM_STR);           
            $st->execute();
            $rc = $st->rowCount();
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }
        return $rc;
    }
    /*
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
    }*/
}
$caso_exito = new CasoExito;
?>