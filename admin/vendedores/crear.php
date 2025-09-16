<?php 
    require '../../includes/app.php';

    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager;

    // Confirmar autenticado
    Autenticado();

    // Crear objeto de vendedor
    $vendedor = new Vendedor;


    // Arreglo para errores
    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Crear nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        // Generar nombre para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Subir archivos
        if ($_FILES['vendedor']['tmp_name']['imagen']) {
            $manager = new ImageManager(Driver::class);
            $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
            $vendedor->setImage($nombreImagen);
        }

        // Validar datos
        $errores = $vendedor->validar();

        // 
        if (empty($errores)) {

            // Crear Carpeta

            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            $vendedor->guardar();
        }
    }

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):   ?>
            <div class="alerta error">
                <?php echo $error;   ?>
            </div>
        <?php endforeach;   ?>


        <form action="" class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_vendedores.php' ?>    

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
    
?>