<h1 class="text-center">Proyectos</h1>
<a href="proyecto.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
<div class="row">
        <div class="col-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-1">Id</th>
                        <th scope="col" class="col-md-2">Departamento</th>
                        <th scope="col" class="col-md-2">Proyecto</th>
                        <th scope="col" class="col-md-2">Descripción</th>
                        <th scope="col" class="col-md-1">Fecha inicial</th>
                        <th scope="col" class="col-md-1">Fecha final</th>
                        <th scope="col" class="col-md-1">Archivo</th>
                        <th scope="col" class="col-md-2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $proyecto):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $proyecto["id_proyecto"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["departamento"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["proyecto"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["descripcion"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["fecha_inicial"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["fecha_final"] ?>
                            </td>
                            <td>
                                <?php echo $proyecto["archivo"] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="proyecto.php?action=task&id=<?php echo $proyecto['id_proyecto']?>"
                                        type="button" class="btn btn-dark" >Tareas</a>
                                    <a href="empleado.php?action=edit&id=<?php echo $proyecto["id_proyecto"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="empleado.php?action=delete&id=<?php echo $proyecto["id_proyecto"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                    <a href="reporte.php?action=proyecto&id=<?php echo $proyecto['id_proyecto']?>" 
                                        type="button" class="btn btn-light" target="_blank">Imprimir</a>
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
</table>