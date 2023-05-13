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
        <?php $nReg = 0;
        foreach ($data as $key => $rol):
            $nReg++; ?>
            <tr>
                <th scope="row">
                    <?php echo $rol["id_rol"] ?>
                </th>
                <th scope="row">
                    <?php echo $rol["rol"] ?>
                </th>
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
        <?php endforeach; ?>
        <tr>
            <th>
                Se encontraron
                <?php echo $nReg ?> roles.
            </th>
        </tr>
    </tbody>
</table>