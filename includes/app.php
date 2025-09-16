<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la Base de datos
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);