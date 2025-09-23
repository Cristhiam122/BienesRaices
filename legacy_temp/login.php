<?php 
    //Incluir Header
    require 'includes/app.php';
    //Conectar a la base de datos
    $db = conectarDB();
    
    $errores = [];

    $email = '';
    //Autenticar usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);


        if (!$email) {
            $errores [] = "El Email es obligatorio o no es valido";
        }
        if (!$password) {
            $errores [] = "El password es obligatorio";
        }

        if (empty($errores)) {
            
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}' ";
            $resultado = mysqli_query($db, $query);

            if ($resultado -> num_rows) {
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    // Password Correcto
                    session_start();

                    // Session
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";
                    header('location: /admin');

                } else {
                    //Password incorrecto
                    $errores []= "El Password es incorrecto";

                    // 
                }

            } else {
                $errores [] = "El Usuario no Existe";
            }

        }
    }
    
    


    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach ($errores as $error):?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

            <form method="POST" action="" class="formulario">
                <fieldset>
                    <legend>Email y Password</legend>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Tu Email" id="email" value="<?php echo $email; ?>" required>
                
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu Password" id="password" required>
                
                    <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
                </fieldset>
            </form>
    </main>

<?php 
    incluirTemplate('footer');
?>