<?php 
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

    Autenticado();

    //Crear objeto para propiedades
    $propiedad = new Propiedad();

    //Consultar Vendedores de la DB
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();


    // Ejecutar codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {


        $propiedad = new Propiedad($_POST['propiedad']);
        // debug($propiedad->precio);

        // Generar nombre para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Subir archivos
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new ImageManager(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImage($nombreImagen);
        }

        $errores = $propiedad->validar();
        


        // Revisar que no haya errores en el arreglo de errores
        
        if(empty($errores)) {



            // *  SUBIDA DE ARCHIVOS A LA DB
            
            // Crear Carpeta

            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            //Guardar la propiedad en el servidor
            $resultado = $propiedad->guardar();
            // echo $query;

        }


    }


        // debug();


    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear Nueva Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):   ?>
            <div class="alerta error">
                <?php echo $error;   ?>
            </div>
        <?php endforeach;   ?>


        <form action="" class="formulario" method="POST" action="/admin/propiedad/crear.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_propiedades.php' ?>    

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');

?>