<!DOCTYPE html>

    <script src="/path/or/uri/to/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
        </script>
    </head>

    <body>
    <h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>CASO EXITO
    </h1>
    <form class="container-fluid" method="POST" action="caso_exito.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
        <div class="mb-3">
        <label class="form-label">Nombre del caso de exito</label>
        <input type="text" name="data[caso_exito]" class="form-control" placeholder="Caso Exito" value="<?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?>"  required minlength="3" maxlength="200" />
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="data[descripcion]" class="form-control" placeholder="Descripción del caso" value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>"> DESCRIPCI´´ON USANDO TINYMCE</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Resumen</label>
        <textarea  name="data[resumen]" class="form-control"  value="<?php echo isset($data[0]['resumen']) ? $data[0]['resumen'] : ''; ?>" > RESUMEN USANDO TINYMCE</textarea >
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen</label>
        <input type="file" class="form-control" name="imagen" />
    </div>
    
    <div class="mb-3">
        <label class="form-label">Activo</label>
        <input type="checkbox"  name="data[activo]" class="form-check-input" id="conditions" name="conditions" value="1" />
    </div>

    <div class="mb-3">
        <label class="form-label">Proyecto</label>
        <select name="data[id_proyecto]" class="form-control" required>
        <?php
            foreach ($dataproyectos as $key => $proy): 
            $selected = " ";
            if ($proy['id_proyecto']==$data[0]['id_proyecto']):
                $selected = " selected";
            endif;?>
        <option value="<?php echo $proy['id_proyecto']; ?>" <?php echo $selected; ?>><?php echo $proy['proyecto']; ?></option>
        <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <?php if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_caso_exito]"
            value="<?php echo isset($data[0]['id_caso_exito']) ? $data[0]['id_caso_exito'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
    </body>
</html>
</form>