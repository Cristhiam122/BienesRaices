<?php 

namespace App;

class ActiveRecord {
    
    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Validación
    protected static $errores = [];

    //Active Record
    public $id;
    public $imagen;
    // public $titulo;

    //? Metodos
    //* Constuctor


    //* Definir Conexion a la DB
    public static function setDB($database) {
        self::$db = $database;
    }

    //* CREATE AND UPDATE

    public function guardar() {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            //crear
            $this->crear();
        }
    }

    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Query
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .=" ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario una vez se agregue a la DB
            header('location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Wrap
        $valores =[];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        
        // Query
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario una vez se agregue a la DB
            header('location: /admin?resultado=2');
        }

    }

    //Eliminar
    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //  Sanitizar entradas
    public function sanitizarAtributos(){
        $atributos = $this->atributos();

        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;
    }

    // Mapeo de atributos
    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        
        return static::$errores;
    }

    // Renombrar imagenes
    public function setImage($imagen){
        //Elimina imgen previa
        if (!is_null($this->id)) {
            //Comprobar si existe el archivo
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo de imagen
    public function borrarImagen() {
        //Eliminar Archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }

    }

    //* REED
    // Listar Todas los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado =self::consultarSQL($query);

        return $resultado;
    }

    // Listar Limitado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado =self::consultarSQL($query);

        return $resultado;
    }

    // Realizar consulta a la db
    public static function consultarSQL($query) {
        //Consultar base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObj($registro); 
        }

        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    // Crear objeto con los resultados de la consulta
    protected static function crearObj($registro) {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key=$value;
            }
        }
        
        return $objeto;
    }

    // Buscar un registro por su ID
    
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    // sincronizar

    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

}