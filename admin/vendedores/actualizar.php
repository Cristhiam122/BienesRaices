<?php 
    require '../../includes/app.php';

    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager;

    // Confirmar autenticado
    Autenticado();

    // Validar ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('location: /admin');
    }

    // Obtener arreglo de vendedor desde la db
    $vendedor = Vendedor::find($id);

    // Arreglo para errores
    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        //Asignar los valores
        $args = $_POST['vendedor'];

        //Sincronizar objeto en memoria
        $vendedor->sincronizar($args);
        
        //Generar nombre de imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Aubida de archivos
        if ($_FILES['vendedor']['tmp_name']['imagen']) {
            $manager = new ImageManager(Driver::class);
            $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
            $vendedor->setImage($nombreImagen);
        }

        //Validar aunque no haya imagen previa
        $errores = $vendedor->validar();

        if (empty($errores)) {

            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $vendedor->guardar();
        }

    }

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):   ?>
            <div class="alerta error">
                <?php echo $error;   ?>
            </div>
        <?php endforeach;   ?>


        <form action="" class="formulario" method="POST" action="/admin/vendedores/actualizar.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_vendedores.php' ?>    

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>