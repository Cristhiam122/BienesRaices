<?php 
    require '../includes/app.php';
    Autenticado();

    use App\Propiedad;
    use App\Vendedor;

    // Implementar un método para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // Muestra Mensaje condicional al crear una nueva propiedad
    $resultado = $_GET['resultado'] ?? null;

    // ? Eliminar Propiedad

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Validar ID
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            $tipo = $_POST['tipo'];

            // Valida que el tipo de id sea valido
            if (validarContenido($tipo)) {
                // Eliminar Propiedad o vendedor
                if ($tipo === 'vendedor') {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else if($tipo === 'propiedad'){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
            }
            }


        }
    }

    // Inluir templates
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php $mensaje = mostrarNotificacion(intval($resultado)); ?>
        
        <?php if($mensaje): ?>
            <p class="alerta exito"><?php echo sanitizar($mensaje); ?></p>
        <?php endif ?>


        <a href="/admin/propiedad/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/Vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <body> <!-- Mostrar los Resultados -->

                <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojoB" value="Eliminar">
                        </form>
                        <a href="admin/propiedad/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarilloB">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach ?>

            </body>
        </table>

    <h2>Vendedores</h2>

        <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <body> <!-- Mostrar los Resultados -->

            <?php foreach($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td><img src="/imagenes/<?php echo $vendedor->imagen; ?>" class="imagen-tabla" alt=""></td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojoB" value="Eliminar">
                    </form>
                    <a href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarilloB">Actualizar</a>
                </td>
            </tr>
            <?php endforeach ?>

        </body>
    </table>

    </main>

<?php 

    // Cerrar Conexión DB
    mysqli_close($db);


    incluirTemplate('footer');
?>