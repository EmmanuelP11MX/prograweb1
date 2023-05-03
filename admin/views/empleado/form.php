<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Empleado
</h1>

<form class="container-fluid" method="POST" action="empleado.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-2">
            <label for="nombre">Nombre del empleado:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="nombre" name="data[nombre]"
                value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" minlength="3"
                maxlength="200">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="primer_apellido">Primer Apellido:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="primer_apellido" name="data[primer_apellido]"
                value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="segundo_apellido">Segundo Apellido:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="segundo_apellido" name="data[segundo_apellido]"
                value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="date" class="" id="fecha_nacimiento" name="data[fecha_nacimiento]"
                value="<?php echo isset($data[0]['fecha_nacimiento']) ? $data[0]['fecha_nacimiento'] : ''; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="rfc">RFC:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="rfc" name="data[rfc]"
                value="<?php echo isset($data[0]['rfc']) ? $data[0]['rfc'] : ''; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="curp">CURP:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <input required="required" type="text" class="" id="curp" name="data[curp]"
                value="<?php echo isset($data[0]['curp']) ? $data[0]['curp'] : ''; ?>">
        </div>
    </div>

    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-2">
            <label for="id_departamento">Departamento:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <select name="data[id_departamento]" required="required">
                <?php
                $selected = " ";
                foreach ($dataDepartamentos as $key => $depto):
                    if ($depto['id_departamento'] == $data[0]['id_departamento']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $depto['id_departamento']; ?>" <?php echo $selected; ?>>
                        <?php echo $depto['departamento'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_empleado]"
            value="<?php echo isset($data[0]['id_empleado']) ? $data[0]['id_empleado'] : ''; ?>" class="" />
    <? endif; ?>
</form>