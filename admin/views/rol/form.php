<h1><?php echo ($action == 'edit')?'Modificar':'Nuevo' ;?> Rol </h1>
<form method="POST" action="Rol.php?action=<?php echo $action; ?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Rol</label>
        <input type="text" name="data[rol]" class="form-control" placeholder="Rol"
            value="<?php echo isset($data[0]['rol']) ? $data[0]['rol'] : ''; ?>" />
    </div>
    <div class="mb-3">
        <label class="form-label">Privilegios</label>
        <select name="data[id_privilegio]" class="form-control" required>
            <?php foreach ($dataprivilegios as $key => $privilegio): 
                $selected = " ";
                if ($privilegio['id_privilegio']==$data[0]['id_privilegio']):
                    $selected = " selected";
                endif;?>
            <option value="<?php echo $privilegio['id_privilegio']; ?>" <?php echo $selected; ?>><?php echo $privilegio['privilegio']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_rol]"
                value="<?php echo isset($data[0]['id_rol']) ? $data[0]['id_rol'] : ''; ?>" class="form-control" />
        <? endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary mb-3" />

    </div>

</form>