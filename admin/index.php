<?php 


    //importar conexión DB

    require '../includes/config/database.php';
    $db = conectarDB();

    //Escribir el Query

    $query = 'SELECT * FROM propiedades';

    // Consultar DB

    $consultaDB = mysqli_query($db, $query);

    // Muestra Mensaje condicional al crear una nueva propiedad
    $resultado = $_GET['resultado'] ?? null;

    // ? Eliminar Propiedad

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            //Eliminar Archivo

            $query = "SELECT imagen FROM propiedades WHERE id = {$id}";

            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            
            unlink('../imagenes/' . $propiedad['imagen']);
            

            // Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = {$id}";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('location: /admin?resultado=3');
            }
        }


    }

    // Inluir templates
    require '../includes/funciones.php';

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if ( intval($resultado) === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        
        <?php elseif (intval($resultado) === 2): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>

        <?php elseif (intval($resultado) === 3): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>

        <?php endif ?>

        <a href="/admin/propiedad/crear.php" class="boton boton-verde">Nueva Propiedad</a>

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

            <tbody> <!-- Mostrar los Resultados -->

                <?php while( $propiedad = mysqli_fetch_assoc($consultaDB)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojoB" value="Eliminar">
                        </form>
                        <a href="admin/propiedad/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarilloB">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile ?>

            </tbody>
        </table>
    </main>

<?php 

    // Cerrar Conexión DB
    mysqli_close($db);


    incluirTemplate('footer');
?>