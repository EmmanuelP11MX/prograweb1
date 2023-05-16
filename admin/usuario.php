<?php
require_once(__DIR__."/controllers/usuario.php");
require_once(__DIR__."/controllers/rol.php");
include_once("views/header.php");
include_once("views/menu.php");

$usuario -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $usuario -> validatePrivilegio('Usuario Crear');
        $dataroles = $rol->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $usuario->new($data);
            if ($cantidad) {
                $usuario->flash('success', 'Usuario dado de alta con éxito');
                $data = $usuario->get(null);
                include('views/usuario/index.php');
            } else {
                $usuario->flash('danger', 'Algo fallo');
                include('views/usuario/form.php');
            }
        } else {
            include('views/usuario/form.php');
        }
        break;

    case 'edit':
        $usuario -> validatePrivilegio('Usuario Actualizar');
        $dataroles = $rol->get(null);
        if(isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_usuario'];
            $cantidad = $usuario->edit($id, $data);
            if($cantidad){
                $usuario->flash('success', "Registro actualizado con éxito");
                $data = $usuario->get(null);
                include('views/usuario/index.php');
            } else {
                $usuario->flash('danger', "Algo fallo o no hubo cambios");
                $data = $usuario->get(null);
                include('views/usuario/index.php');
            }
        } else {
            $data = $usuario->get($id);
            include('views/usuario/form.php');
        }
        break;

    case 'delete':
        $usuario -> validatePrivilegio('Usuario Eliminar');
        $cantidad = $usuario->delete($id);
        if ($cantidad) {
            $usuario->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $usuario->get(null);
            include('views/usuario/index.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->get(null);
            include('views/usuario/index.php');
        }
        break;

    case 'rol':
        $data = $usuario->get($id);
        $data_rol = $usuario->getPriv($id);
        include('views/usuario/rol.php');
        break;

    case 'newrol':
        $proyecto -> validatePrivilegio('Proyecto Crear');
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $proyecto->newTask($id, $data2);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro dado de alta con éxito');
    
            } else {
                $proyecto->flash('danger', 'Algo fallo');
            }
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        } else {
            include('views/proyecto/tarea_form.php');
        }
        //$data_tarea = $proyecto->getTask($id);
        break;

    case 'editrol':
        $proyecto -> validatePrivilegio('Proyecto Actualizar');
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $id_tarea = $_POST['data']['id_tarea'];
            $cantidad = $proyecto->editTask($id,$id_tarea, $data2);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro dado de alta con éxito');
            } else {
                $proyecto->flash('danger', 'Algo fallo');
            } 
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');

        } else {
            $data_tarea = $proyecto->getTaskOne($id_tarea);
            include('views/proyecto/tarea_form.php');
        }
        break;

    case 'deleterol':
        $proyecto -> validatePrivilegio('Proyecto Eliminar');
        $cantidad = $proyecto->deleteTask($id_tarea);
        if ($cantidad) {
            $proyecto->flash('success', 'Registro con el id= ' . $id_tarea . ' eliminado con éxito');
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        } else {
            $proyecto->flash('danger', 'Algo fallo');
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        }
        break;

    case 'getAll':
        default:
            $usuario -> validatePrivilegio('Usuario Leer');
            $data = $usuario->get($id);
            include('views/usuario/index.php');
}
include_once('views/footer.php');
?>