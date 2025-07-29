<?php 

    // Validar ID
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id) {
        header('location: /admin');
    }


    // Conectar DB

    require '../../includes/config/database.php';
    $db = conectarDB();
    // var_dump($db);

    // Consultar valores de la propiedad respectiva
    $consulta_propiedad = "SELECT * FROM propiedades WHERE id = {$id}";
    $resultado_propiedad = mysqli_query($db, $consulta_propiedad);
    $propiedad = mysqli_fetch_assoc($resultado_propiedad);



    //Consultar Vendedores de la DB

    $consulta_vendedores = "SELECT * FROM vendedores";
    $vendedores_db = mysqli_query($db, $consulta_vendedores);

    //Arreglo con mensajes de errores
    $errores = [];

        $titulo = $propiedad['titulo'];
        $precio = $propiedad['precio'];
        $descripcion = $propiedad['descripcion'];
        $habitaciones = $propiedad['habitaciones'];
        $wc = $propiedad['wc'];
        $estacionamiento = $propiedad['estacionamiento'];
        $vendedores_id = $propiedad['vendedores_id'];
        $imagenPropiedad = $propiedad['imagen'];

    // Ejecutar codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        
        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');
        
        //Asignar files a una variable
        $imagen = $_FILES['imagen'];


        //Validación
        if(!$titulo) {$errores[] = "Debes añadir un titulo";}
        if(!$precio) {$errores[] = "Debes añadir un precio";}
        // if(!$titulo) {$errores[] = "Debes añadir un titulo";}
        if(strlen($descripcion) < 50) {$errores[] = "La Descripción es obligatoria y debe tener almenos 50 caracteres";}
        if(!$habitaciones) {$errores[] = "Debes añadir el numero de habitaciones";}
        if(!$wc) {$errores[] = "Debes añadir el numero de baños";}
        if(!$estacionamiento) {$errores[] = "Debes añadir la cantidad de estacionamientos";}
        if(!$vendedores_id) {$errores[] = "Debes seleccionar un vendedor";}

        //Validar Tamaño de la imagen (maximo 100Mb)
        $max_img = 1000 * 1000;

        if ($imagen['size'] > $max_img) {
            $errores[] = "La imagen es muy pesada";
        }


        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que no haya errores en el arreglo de errores

        if(empty($errores)) {
            
            // *  SUBIDA DE ARCHIVOS A LA DB
            
            
            // Crear Carpeta
            $carpetaImagenes = '../../imagenes/';
            
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            
            $nombreImagen = '';

            // Eliminar imagen anterior

            if ($imagen['name']) {
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar nombre para la imagen
    
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
                // Subir imagen
    
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else {
                $nombreImagen = $propiedad['imagen'];
            }


            // * Insertar en la Base de datos

            $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedores_id = {$vendedores_id} WHERE id = {$id}";
            

            // echo $query;


            $resultado = mysqli_query($db, $query);
            if($resultado){
                //Redireccionar al usuario una vez se agregue a la DB

                header('location: /admin?resultado=2');
            }
        }


    }


    require '../../includes/funciones.php';

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):   ?>
            <div class="alerta error">
                <?php echo $error;   ?>
            </div>
        <?php endforeach;   ?>


        <form action="" class="formulario" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small" alt="">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" id="">
                    <option value="">-- Seleccione --</option>

                    <?php while($row= mysqli_fetch_assoc($vendedores_db)): ?>
                        <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                    <?php endwhile; ?>

                </select>
            </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>