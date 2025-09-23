<?php

namespace App;

class Vendedor extends ActiveRecord {
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'tipoId', 'identificacion', 'imagen'];
    protected static $tabla = 'vendedores';

    // public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $tipoId;
    public $identificacion;
    public $imagen;

    public function __construct($arg = []) {
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? '';
        $this->apellido = $arg['apellido'] ?? '';
        $this->telefono = $arg['telefono'] ?? '';
        $this->email = $arg['email'] ?? '';
        $this->tipoId = $arg['tipoId'] ?? '';
        $this->identificacion = $arg['identificacion'] ?? '';
        $this->imagen = $arg['imagen'] ?? '';

    }

    public function validar() {
        if(!$this->nombre) {self::$errores[] = "El nombre es obligatorio";}
        if(!$this->apellido) {self::$errores[] = "el apellido es obligatorio";}
        if(!$this->telefono) {self::$errores[] = "el Telefono es obligatorio";}
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {self::$errores[] = "Formato de Telefono NO valido";}
        if(!$this->email) {self::$errores[] = "el e-mail es obligatorio";}
        if(!$this->tipoId) {self::$errores[] = "debe seleccionar un tipo de identificación";}
        if(!$this->identificacion) {self::$errores[] = "el numero de identificación es obligatorio";}
        if(!$this->imagen) {self::$errores[] = "Debe ingresar una foto del vendedor";}
        
        return self::$errores;
    }
}