<?php
require_once(__DIR__."/sistema.php");
class Proyecto extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql= "SELECT * FROM proyecto p 
            LEFT JOIN departamento d ON p.id_departamento = d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else {
            $sql = "SELECT * FROM proyecto p 
            LEFT JOIN departamento d ON p.id_departamento = d.id_departamento WHERE p.id_proyecto = :id";
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
        try {
            $this->db->beginTransaction();
            $nombrearchivo = str_replace(" ","_", $data['proyecto']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $sql = "INSERT INTO proyecto (proyecto, descripcion, fecha_inicial, fecha_final, id_departamento) VALUES (:proyecto, :descripcion, :fecha_inicial, :fecha_final, :id_departamento)";
            $sesubio = $this->uploadfile("archivo", '../uploads/proyectos', $nombrearchivo);
            if ($sesubio) {
                $sql = "INSERT INTO proyecto (proyecto, descripcion, fecha_inicial, fecha_final, id_departamento, archivo) VALUES (:proyecto, :descripcion, :fecha_inicial, :fecha_final, :id_departamento, :archivo)";
            }
            $st = $this->db->prepare($sql);
            $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":fecha_inicial", $data['fecha_inicial'], PDO::PARAM_STR);
            $st->bindParam(":fecha_final", $data['fecha_final'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
            if ($sesubio) {
                $st->bindParam(":archivo", $sesubio, PDO::PARAM_STR);
            }
            $st->execute();
            $rc = $st->rowCount();
            $this->db->commit();
        } catch (PDOException $exception) {
            $rc=0;
            $this->db->rollback();
        }
        return $rc;
    }

    public function edit($id, $data)
    {
        $archivo_fijo = "ruta/";
        $this->db();
        $nombrearchivo = str_replace(" ","_", $data['proyecto']);
        $nombrearchivo = substr($nombrearchivo, 0,20);
        $nombrearchivo = $this->uploadfile("archivo", 'uploads/proyectos/', $nombrearchivo);
        if ($nombrearchivo) {
            $sql = "UPDATE proyecto SET proyecto = :proyecto, descripcion = :descripcion, fecha_inicial =  :fecha_inicial, fecha_final = :fecha_final, id_departamento = :id_departamento, archivo = :archivo WHERE id_proyecto = :id";
        }else {
            $sql = "UPDATE proyecto SET proyecto = :proyecto, descripcion = :descripcion, fecha_inicial =  :fecha_inicial, fecha_final = :fecha_final, id_departamento = :id_departamento WHERE id_proyecto = :id";
        }
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":fecha_inicial", $data['fecha_inicial'], PDO::PARAM_STR);
        $st->bindParam(":fecha_final", $data['fecha_final'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        
        if ($nombrearchivo) {
            $st->bindParam(":archivo", $nombrearchivo, PDO::PARAM_STR);
        }
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();    

        try {
            $this->db->beginTransaction();
            $sql = "DELETE FROM tarea WHERE id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);

            $sql2 = "DELETE FROM proyecto WHERE id_proyecto = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);

            $st->execute();
            $st2->execute();
            
            $rc = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $exception) {
            $rc=0;
            $this->db->rollback();
        }
        return $rc;
    }

    public function getTask($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * FROM tarea t LEFT JOIN proyecto p ON p.id_proyecto = t.id_proyecto";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else {
            $sql = "SELECT * FROM tarea t LEFT JOIN proyecto p ON p.id_proyecto = t.id_proyecto WHERE t.id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function deleteTask($id)
    {
        $this->db();
        $sql = "DELETE FROM tarea WHERE id_tarea=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newTask ($id, $data)
    {
        $this->db();
        $sql = "INSERT INTO tarea (id_proyecto, tarea, avance) VALUES (:id_proyecto, :tarea, :avance)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
        $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
        $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getTaskOne($id){
        $data=null;
        $this->db();
        if (is_null($id)) {
            die("Ocurrio un error");
        }else {
            $sql = "SELECT * FROM tarea t LEFT JOIN proyecto p ON p.id_proyecto = t.id_proyecto WHERE t.id_tarea = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function editTask($id, $id_tarea, $data)
    {
        $this->db();
        $sql = "UPDATE tarea SET tarea = :tarea, avance = :avance WHERE id_tarea = :id_tarea AND id_proyecto = :id_proyecto";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
        $st->bindParam(":id_tarea", $id_tarea, PDO::PARAM_INT);
        $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
        $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function chartProyecto()
    {
        $this->db();
            $sql= "SELECT month(p.fecha_inicial) AS mes, count(p.id_proyecto) AS cantidad FROM proyecto p ORDER BY 1 ASC";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
$proyecto = new Proyecto;
?>