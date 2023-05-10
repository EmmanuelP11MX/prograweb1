<h1 class="text-center">Empleados</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <p><a class="btn btn-success" href="empleado.php?action=new" role="button">Nuevo Empleado</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nombre del empleado</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <th scope="col">fecha de nacimiento</th>
                        <th scope="col">RFC</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Departamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $empleado):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $empleado["nombre"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["primer_apellido"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["segundo_apellido"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["fecha_nacimiento"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["rfc"] ?>
                            </td>
                            <td>
                                <?php echo $empleado["curp"] ?>
                            </td>
                            <td>
                                <img height="75px" src="<?php echo $empleado["foto"]; ?>" alt="Imagen del Empleado">
                                
                            </td>
                            <td>
                                <?php echo $empleado["id_departamento"] ?>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="empleado.php?action=edit&id=<?php echo $empleado["id_empleado"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="empleado.php?action=delete&id=<?php echo $empleado["id_empleado"] ?>"
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