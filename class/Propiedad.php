<?php

namespace App;

class Propiedad extends ActiveRecord {

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];
    protected static $tabla = 'propiedades';

    // public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

        public function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->titulo = $arg['titulo'] ?? '';
        $this->precio = $arg['precio'] ?? '';
        $this->imagen = $arg['imagen'] ?? '';
        $this->descripcion = $arg['descripcion'] ?? '';
        $this->habitaciones = $arg['habitaciones'] ?? '';
        $this->wc = $arg['wc'] ?? '';
        $this->estacionamiento = $arg['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $arg['vendedores_id'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {self::$errores[] = "Debes añadir un titulo";}
        if(!$this->precio) {self::$errores[] = "Debes añadir un precio";}
        if(strlen($this->descripcion) < 50) {self::$errores[] = "La Descripción es obligatoria y debe tener almenos 50 caracteres";}
        if(!$this->habitaciones) {self::$errores[] = "Debes añadir el numero de habitaciones";}
        if(!$this->wc) {self::$errores[] = "Debes añadir el numero de baños";}
        if(!$this->estacionamiento) {self::$errores[] = "Debes añadir la cantidad de estacionamientos";}
        if(!$this->vendedores_id) {self::$errores[] = "Debes seleccionar un vendedor";}
        if(!$this->imagen){self::$errores[] = "la Fotografia de la propiedad es obligatoria";}
    
        return self::$errores;
    }
}