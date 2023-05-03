<?php
require_once("controllers/empleado.php");
require_once("controllers/departamento.php");
include_once("views/header.php");
include_once("views/menu.php");

$empleado = new empleado;
$empleado -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        $dataDepartamentos = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $empleado->new($data);
            if ($cantidad) {
                $empleado->flash('success', 'Empleado dado de alta con éxito');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                include('views/empleado/form.php');
            }
        } else {
            include('views/empleado/form.php');
        }
        break;
    case 'edit':
        $dataDepartamentos = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_empleado'];
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad) {
                $empleado->flash('success', 'Empleado actualizado con éxito');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            }
        } else {
            $data = $empleado->get($id);
            include('views/empleado/form.php');
        }
        break;
    case 'delete':
        $cantidad = $empleado->delete($id);
        if ($cantidad) {
            $empleado->flash('success', 'Empleado con el id= ' . $id . ' eliminado con éxito');
            $data = $empleado->get(null);
            include('views/empleado/index.php');
        } else {
            $empleado->flash('danger', 'Algo fallo');
            $data = $empleado->get(null);
            include('views/empleado/index.php');
        }
        break;
    case 'getAll':
    default:
        $data = $empleado->get(null);
        include("views/empleado/index.php");
}
include("views/footer.php");
?>