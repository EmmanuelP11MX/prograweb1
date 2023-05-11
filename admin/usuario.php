<?php
require_once(__DIR__."/controllers/usuario.php");
require_once(__DIR__."/controllers/rol.php");
include_once("views/header.php");
include_once("views/menu.php");

$usuario -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
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
        $cantidad = $usuario->delete($id);
        if ($cantidad) {
            $usuario->flash('success', "Registro eliminado con éxito");
            $data = $usuario->get(null);
            include('views/usuario/index.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->get(null);
            include('views/usuario/index.php');
        }
        break;

    case 'get':
        default:
            $data = $usuario->get($id);
            include('views/usuario/index.php');
}
include_once('views/footer.php');
?>