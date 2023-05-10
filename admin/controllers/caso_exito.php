<?php
    require_once("sistema.php");
    class Caso_Exito extends Sistema
    {
        public function get($id = null){
            $this->db();
            if (is_null($id)) {
                $sql= "select * from caso_exito ce left join proyecto p on ce.id_proyecto = p.id_proyecto";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "select * from caso_exito ce left join proyecto p on ce.id_proyecto = p.id_proyecto where ce.id_caso_exito = :id";
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
            $nombrearchivo = str_replace(" ","_", $data['caso_exito']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
            $sql = "INSERT INTO caso_exito (caso_exito, descripcion, resumen, imagen, id_proyecto) VALUES (:caso_exito, :descripcion, :resumen, :imagen, :id_proyecto)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            $st->bindParam(":id_proyecto", $data['id_proyecto'], PDO::PARAM_STR);
            
            $imagen = "images/default-image.png";
            if ($secargo) {
                $imagen = $secargo;
            }
            $st->bindParam(":imagen", $imagen, PDO::PARAM_STR);
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
                $sql = "delete from caso_exito where id_caso_exito = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
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
            $nombrearchivo = str_replace(" ","_", $data['caso_exito']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $nombrearchivo = $this->uploadfile("imagen", 'images/caso_exito/', $nombrearchivo);
            if ($nombrearchivo) {
                $sql = "update caso_exito set caso_exito = :caso_exito, descripcion = :descripcion, resumen =  :resumen, activo = :activo, id_proyecto = :id_proyecto, imagen = :imagen where id_caso_exito = :id";
            }else {
                $sql = "update caso_exito set caso_exito = :caso_exito, descripcion = :descripcion, resumen =  :resumen, activo = :activo, id_proyecto = :id_proyecto where id_caso_exito = :id";
            }
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            $st->bindParam(":activo", $data['activo'], PDO::PARAM_BOOL);
            $st->bindParam(":id_proyecto", $data['id_proyecto'], PDO::PARAM_INT);
            
            if ($nombrearchivo) {
                $st->bindParam(":imagen", $nombrearchivo, PDO::PARAM_STR);
            }
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }
    $caso_exito = new Caso_Exito;
?>