<?php

function conectarDB(): mysqli {
    $db = mysqli_connect('localhost', 'Tu_Usuario', 'Tu-Contraseña', 'BienesRaices_crud');

    if(!$db) {
        echo "Error al conectar a la base de datos";
        exit;
    }

    return $db;
}