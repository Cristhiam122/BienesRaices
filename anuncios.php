<?php 
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    
    <main class="contenedor seccion">
        <section class="seccion contenedor">
            <h2>Casas y Depas en Venta</h2>
    
            <?php
        
            $limiteAnuncios = 10;
            include 'includes/templates/anuncios.php';
        
            ?>
    
        </section>
    </main>


<?php 
    incluirTemplate('footer');
?>