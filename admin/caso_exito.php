<?php
    require_once(__DIR__."/controllers/caso_exito.php");
    require_once(__DIR__."/controllers/proyecto.php");
    include_once('views/header.php');
    include_once('views/menu.php');

    $caso_exito->validateRol('Lider');

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
   // $id_tarea = (isset($_GET['id_tarea'])) ? $_GET['id_tarea'] : null;

    switch ($action) {
        case 'new':
            $caso_exito->validatePrivilegio('Proyecto Crear');
            $dataproyectos = $proyecto->get(null);
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $caso_exito->new($data);
                if ($cantidad) {
                    $caso_exito->flash('success', "Registro dado de alta con  éxito");
                    $data = $caso_exito->get(null);
                    include('views/caso_exito/index.php');
                }else {
                    $caso_exito->flash('danger', "Algo fallo");
                    include('views/caso_exito/form.php');
                }
            }else {
                include('views/caso_exito/form.php');
            }
        break;
        case 'delete':
            $caso_exito->validatePrivilegio('Proyecto Eliminar');
            $cantidad = $caso_exito->delete($id);
            if ($cantidad) {
                $caso_exito->flash('success', "Registro eliminado con éxito");
                $data = $caso_exito->get(null);
                include('views/caso_exito/index.php');
            }else {
                $caso_exito->flash('danger', "Algo fallo");
                $data = $caso_exito->get(null);
                include('views/caso_exito/index.php');
            }
        break;
        case 'edit':
            $caso_exito->validatePrivilegio('Proyecto Actualizar');
            $dataproyectos = $proyecto->get(null);
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_caso_exito'];
                $cantidad = $caso_exito->edit($id, $data);
                if ($cantidad) {
                    $caso_exito->flash('success', "Registro actualizado con  éxito");
                    $data = $caso_exito->get(null);
                    include('views/caso_exito/index.php');
                }else {
                    $caso_exito->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $caso_exito->get(null);
                    include('views/caso_exito/index.php');
                }
            }else {
                $data = $caso_exito->get($id);
                include('views/caso_exito/form.php');
            }
        break;

        case 'get':
        default:
            $caso_exito->validatePrivilegio('Proyecto Leer');
            $data = $caso_exito->get(null);
            include("views/caso_exito/index.php");
    }
    include_once('views/footer.php');
?>
