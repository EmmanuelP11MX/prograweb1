<h1 class="text-center">Roles</h1>
<a href="rol.php?action=new" class="btn btn-success">Nuevo Rol</a>
<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Rol</th>
            <th scope="col">Privilegio</th>
        </tr>
    </thead>
    <tbody>
        <?php $nReg = 0; $last_id = ''; $last_rol = ''; foreach ($data as $key => $rol):?>
            <tr>
                <?php if ($last_id != $rol["id_rol"] and $last_rol != $rol["rol"]): ?>          
                <th scope="row">
                    <?php echo $rol["id_rol"] ?>
                </th>
                <th scope="row">
                    <?php $nReg++; echo $rol["rol"] ?>
                </th>
                <?php else: ?>
                <td></td> <td></td>
                <?php endif; ?>
                <th scope="row">
                    <?php echo $rol["privilegio"] ?>
                </th>
                <th>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="rol.php?action=edit&id=<?php echo $rol["id_rol"] ?>"
                            type="button" class="btn btn-primary">Modificar</a>
                        <a href="rol.php?action=delete&id=<?php echo $rol["id_rol"] ?>"
                            type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                </th>
            </tr>
            <?php $last_id = $rol["id_rol"]; ?>
        <?php endforeach; ?>
        <tr>
            <th>
                Se encontraron
                <?php echo $nReg ?> roles.
            </th>
        </tr>
    </tbody>
</table>