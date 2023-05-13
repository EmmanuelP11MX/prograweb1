<h1>
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Usuario
</h1>

<form class="container-fluid" method="POST" action="usuario.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
    <label class="form-label">Correo Electronico</label>
    <input type="text" name="data[correo]" class="form-control" placeholder="Correo" value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>"  required minlength="3" maxlength="200" />
</div>
<div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input type="password" name="data[contrasena]" class="form-control" placeholder="Contraseña" value="<?php echo isset($data[0]['contrasena']) ? $data[0]['contrasena'] : ''; ?>"  required minlength="3" maxlength="200" />
</div>
<div class="mb-3">
    <label class="form-label">Rol</label>
    <select name="data[id_rol]" class="form-control" required>
    <?php
        foreach ($dataroles as $key => $rol): 
        $selected = " ";
        if ($rol['id_rol']==$data[0]['id_rol']):
            $selected = " selected";
        endif;?>
    <option value="<?php echo $rol['id_rol']; ?>" <?php echo $selected; ?>><?php echo $rol['rol']; ?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="row">
    <div class="col-12">
        <?php if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_usuario]"
            value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
    </div>
</div>
</form>