<h1 class="text-center">Casos de Exito</h1>
<a href="caso_exito.php?action=new" class="btn btn-success">Nuevo Caso</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="col-md-1">Id</th>
            <th scope="col" class="col-md-2">Proyecto</th>
            <th scope="col" class="col-md-2">Caso de Exito</th>
            <th scope="col" class="col-md-2">Descripción</th>
            <th scope="col" class="col-md-2">Resumen</th>
            <th scope="col" class="col-md-1">Imagen</th>
            <th scope="col" class="col-md-1">Activo</th>
            <th scope="col" class="col-md-2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $caso_exito): ?>
        <tr>
            <th scope="row"><?php echo $caso_exito['id_caso_exito']; ?></th>
            <th scope="row"><?php echo $caso_exito['proyecto']; ?></th>
            <td><?php echo $caso_exito['caso_exito']; ?></td>
            <td><?php echo $caso_exito['descripcion']; ?></td>
            <td><?php echo $caso_exito['resumen']; ?></td>
            <td><?php echo $caso_exito['imagen']; ?></td>
            <td><?php echo $caso_exito['activo']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Menu Renglon">
                    <a class="btn btn-primary" href="caso_exito.php?action=edit&id=<?php echo $caso_exito['id_caso_exito']?>">Modificar</a>
                    <a class="btn btn-danger" href="caso_exito.php?action=delete&id=<?php echo $caso_exito['id_caso_exito']?>">Eliminar</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
</table>