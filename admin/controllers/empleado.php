<?php
require_once("sistema.php");
class Empleado extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * FROM empleado e LEFT JOIN departamento d ON e.id_departamento = d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM empleado e LEFT JOIN departamento d ON 
                    e.id_departamento = d.id_departamento WHERE e.id_empleado = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function new($data)
    {
        $this->db();
            $nombrearchivo = str_replace(" ","_", $data['nombre']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $sesubio = $this->uploadfile("foto", '../images/empleado', $nombrearchivo);
            $sql = "INSERT INTO empleado(nombre, primer_apellido, segundo_apellido, fecha_nacimiento, rfc, curp, foto, id_departamento) VALUES (:nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :rfc, :curp, :foto, :id_departamento)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
            $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
            $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);            
            
            $foto = "../images/empleado/default-foto.png";
            if ($sesubio) {
                $foto = $sesubio;
            }
            $st->bindParam(":foto", $foto, PDO::PARAM_STR);
            $st->execute();
            try {
                $rc = $st->rowCount();
                return $rc;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    }
    
    public function delete($id){
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "DELETE FROM empleado where id_empleado=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
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
        $archivo_fijo = "ruta/";
        $this->db();
        $nombrearchivo = str_replace(" ","_", $data['nombre']);
        $nombrearchivo = substr($nombrearchivo, 0,20);
        $nombrearchivo = $this->uploadfile("foto", 'images/empleado/', $nombrearchivo);
        if ($nombrearchivo) {
            $sql = "UPDATE empleado SET nombre =:nombre, primer_apellido =:primer_apellido, segundo_apellido =:segundo_apellido, fecha_nacimiento =:fecha_nacimiento, rfc =:rfc, curp =:curp, foto =:foto, id_departamento =:id_departamento WHERE id_empleado = :id";
        }else {
            $sql = "UPDATE empleado SET nombre =:nombre, primer_apellido =:primer_apellido, segundo_apellido =:segundo_apellido, fecha_nacimiento =:fecha_nacimiento, rfc =:rfc, curp =:curp, id_departamento =:id_departamento WHERE id_empleado = :id";
        }
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        
        if ($nombrearchivo) {
            $st->bindParam(":foto", $nombrearchivo, PDO::PARAM_STR);
        }
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$empleado = new Empleado;
?>