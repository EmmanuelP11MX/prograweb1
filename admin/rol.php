<?php
require_once(__DIR__."/controllers/rol.php");
require_once(__DIR__."/controllers/privilegio.php");
include_once("views/header.php");
include_once("views/menu.php");

$rol -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $dataprivilegios = $privilegio->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $rol->new($data);
            if ($cantidad) {
                $rol->flash('success', 'Rol dado de alta con éxito');
                $data = $rol->get(null);
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                include('views/rol/form.php');
            }
        } else {
            include('views/rol/form.php');
        }
        break;
    case 'edit':
        $dataprivilegios = $privilegio->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_rol'];
            $cantidad = $rol->edit($id, $data);
            if ($cantidad) {
                $rol->flash('success', 'Rol actualizado con éxito');
                $data = $rol->get(null);
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                $data = $privilegio->get(null);
                include('views/rol/index.php');
            }
        } else {
            $data = $rol->get($id);
            include('views/rol/form.php');
        }
        break;
    case 'delete':
        $cantidad = $rol->delete($id);
        if ($cantidad) {
            $rol->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $rol->get(null);
            include('views/rol/index.php');
        } else {
            $rol->flash('danger', 'Algo fallo');
            $data = $rol->get(null);
            include('views/rol/index.php');
        }
        break;
    case 'getAll':
    default:
        $data = $rol->get(null);
        include("views/rol/index.php");
}
include("views/footer.php");
?>