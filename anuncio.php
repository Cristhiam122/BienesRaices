<?php 
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta Frente al Bosque</h1>

        <picture>
            <source srcset="build/img/destacada.avif" type="image/avif">
            <source srcset="build/img/destacada.webp" type="image/webp">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la Propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p>3</p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p>3</p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Nostrud eiusmod veniam qui aute minim proident ut dolor anim ex. Nostrud nostrud aliqua officia sint reprehenderit cupidatat et cupidatat ullamco deserunt. Nulla consequat sint ea fugiat reprehenderit dolore. Dolore enim cupidatat laboris mollit eu fugiat quis. Est aute exercitation eiusmod incididunt in eiusmod ea est cupidatat quis qui. Consectetur veniam culpa qui et sunt eiusmod. Incididunt quis duis dolor nostrud sunt ex irure pariatur enim non enim. Deserunt consectetur laborum quis do aute occaecat proident quis est aliqua aute esse eiusmod cupidatat. Enim magna aliquip dolore sit duis aute. Laborum anim in officia nostrud aliqua fugiat irure dolore cillum officia do. Eu consectetur et ad cillum anim quis incididunt nostrud reprehenderit commodo eiusmod. Ex non et excepteur do ea quis eiusmod sint duis voluptate do consectetur mollit.</p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>