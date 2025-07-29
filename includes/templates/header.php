<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BienesRaices</title>

    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">

        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="LogoTipo Bienes Raices">
                </a>


                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menu Responsive">
                </div>

                <div class="derecha">

                    <img src="/build/img/dark-mode.svg" alt="Dark Mode button" class="dark-mode-btn">

                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>

            </div>

            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujos</h1>" : ''; ?>

        </div>

        
    </header>