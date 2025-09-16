<?php 
    require 'includes/app.php';

    incluirTemplate('header');
?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la Decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.avif" type="image/avif">
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la Propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
        
        <div class="resumen-propiedad">


            <p>Nostrud eiusmod veniam qui aute minim proident ut dolor anim ex. Nostrud nostrud aliqua officia sint reprehenderit cupidatat et cupidatat ullamco deserunt. Nulla consequat sint ea fugiat reprehenderit dolore. Dolore enim cupidatat laboris mollit eu fugiat quis. Est aute exercitation eiusmod incididunt in eiusmod ea est cupidatat quis qui. Consectetur veniam culpa qui et sunt eiusmod. Incididunt quis duis dolor nostrud sunt ex irure pariatur enim non enim. Deserunt consectetur laborum quis do aute occaecat proident quis est aliqua aute esse eiusmod cupidatat. Enim magna aliquip dolore sit duis aute. Laborum anim in officia nostrud aliqua fugiat irure dolore cillum officia do. Eu consectetur et ad cillum anim quis incididunt nostrud reprehenderit commodo eiusmod. Ex non et excepteur do ea quis eiusmod sint duis voluptate do consectetur mollit.</p>
        </div>
    </main>



<?php 
    incluirTemplate('footer');
?>