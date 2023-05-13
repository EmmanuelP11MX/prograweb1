<h1 class="text-center">Usuarios</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="usuario.php?action=new" role="button">Nuevo Usuario</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Correo</th>
                        <th scope="col">ID Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $usuario):
                        $nReg++; ?>
                        <tr>
                            <td scope="row">
                                <?php echo $usuario["id_usuario"] ?>
                            </td>
                            <td scope="row">
                                <?php echo $usuario["correo"] ?>
                            </td>
                            <td scope="row">
                                <?php echo $usuario["rol"] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="usuario.php?action=edit&id=<?php echo $usuario["id_usuario"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="usuario.php?action=delete&id=<?php echo $usuario["id_usuario"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <th>
                            Se encontraron
                            <?php echo $nReg ?> registros.
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>