<?php 
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    
    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Dolore aute laborum laboris est. Ex deserunt cillum ea consectetur irure occaecat amet labore nulla sint minim culpa eiusmod. Magna pariatur excepteur eu in duis dolore voluptate aute fugiat. Quis eu nostrud dolor incididunt non. Fugiat velit culpa cillum cupidatat fugiat cillum ea amet ut occaecat eiusmod fugiat incididunt cillum. Tempor sint minim commodo eiusmod irure est. Cupidatat incididunt tempor velit ea commodo minim elit et adipisicing laborum reprehenderit fugiat. Dolore esse do magna enim ullamco do duis eu qui. Aliquip dolor do occaecat ea irure laborum reprehenderit sint. Nostrud tempor irure culpa elit. Qui irure cillum sunt ad pariatur duis cillum consequat ullamco. Culpa anim qui non anim sint magna ad ea consequat. Fugiat adipisicing esse ea amet nostrud exercitation.</p>

                <p>Dolore excepteur est laborum cillum laborum labore magna magna amet Lorem duis. Velit veniam mollit tempor reprehenderit cillum sint qui ex amet esse excepteur non non cillum. Do eu irure incididunt mollit magna reprehenderit nostrud.</p>
            </div>

        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Elit reprehenderit cillum laborum quis ullamco id do amet tempor est quis consectetur. Ex ipsum tempor elit exercitation duis. Enim aliqua pariatur pariatur ullamco proident ea qui voluptate.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Pariatur enim nulla mollit duis minim nisi. Occaecat dolor officia adipisicing laborum qui magna. Occaecat cillum exercitation ut qui est commodo aliquip elit ullamco sint aliquip voluptate id sint. Deserunt pariatur mollit veniam velit laboris reprehenderit eu anim nisi.</p>
            </div>
            
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Officia occaecat sunt incididunt laborum elit ipsum minim. Ex sint voluptate laboris sit excepteur excepteur in. Ad qui aliqua velit proident elit reprehenderit ipsum minim excepteur laborum pariatur ex.</p>
            </div>
        </div>
    <section/>


<?php 
    incluirTemplate('footer');
?>