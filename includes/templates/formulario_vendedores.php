<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor(a)" value="<?php echo sanitizar($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del Vendedor(a)" value="<?php echo sanitizar($vendedor->apellido); ?>">

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono del Vendedor(a)" value="<?php echo sanitizar($vendedor->telefono); ?>">

</fieldset>

<fieldset>
    <legend>Información Adicional</legend>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="vendedor[email]" placeholder="E-mail del Vendedor(a)" value="<?php echo sanitizar($vendedor->email); ?>">

    <div class="grupoId">

        <div>
            <label for="tipoId">Tipo de ID:</label>
            <select name="vendedor[tipoId]" id="tipoId">
                <option value="">--Selecciones--</option>
                <option <?php echo $vendedor->tipoId === 'cc' ? 'selected' : ''; ?> value="cc">Cedula de Ciudadania</option>
                <option <?php echo $vendedor->tipoId === 'ce' ? 'selected' : ''; ?> value="ce">Cedula de Extranjeria</option>
            </select>
        </div>

        <div>
            <label for="identificacion">Numero de Identificación:</label>
            <input type="text" id="identificacion" name="vendedor[identificacion]" placeholder="Numero de identificación del Vendedor(a)" value="<?php echo sanitizar($vendedor->identificacion); ?>">
        </div>
    
    </div>

    <label for="imagen">Foto Vendedor:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

    <?php if($vendedor->imagen): ?>
        <img src="/imagenes/<?php echo $vendedor->imagen; ?>" alt="Fotografia Vendedor" class="imagen-small">
    <?php endif ?>
</fieldset>