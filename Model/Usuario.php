<?php
require_once 'ConectarDB.php';

class Usuario {
    
    private $codigo;
    private $nombre;
    private $apellidos;
    private $codigoPostal;
    private $usuario;
    private $contrasenia;
    private $fechaNacimiento;
    private $fechaAlta;
    private $tipoUsuario;
    private $acceso;
    
    function __construct($codigo, $usuario, $contrasenia, $tipoUsuario, $acceso, $nombre, $apellidos, $codigoPostal, $fechaNacimiento, $fechaAlta) {
        /* SOBRECARGA DE CONSTRUCTOR - Si se pasa el codigo se pasarán el resto de valores pues procede de 
        una consulta * a la base de datos */
        if (!empty($fechaAlta)) { 
            $this->codigo = $codigo;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->codigoPostal = $codigoPostal;
            $this->usuario = $usuario;
            $this->contrasenia = $contrasenia;
            $this->fechaNacimiento = $fechaNacimiento;
            $this->fechaAlta = $fechaAlta;
            $this->tipoUsuario = $tipoUsuario;
            $this->acceso = $acceso; 

        } else {
            $this->codigo = $codigo;
            $this->usuario = $usuario;
            $this->contrasenia = $contrasenia;
            $this->tipoUsuario = $tipoUsuario;
            $this->acceso = $acceso;
        }
    }
    
    public static function getUsuarios() { 
        $conexion = ConectarDB::conexion();
        $select = "SELECT * FROM usuario";
        $consulta = $conexion->query($select);
        
        $usuarios = [];
        
        while ($usuario = $consulta->fetchObject()) {
            $usuarios[] = new Usuario ($usuario->codigo, $usuario->usuario, $usuario->contrasenia, $usuario->tipo, $usuario->acceso, $usuario->nombre, $usuario->apellidos, $usuario->codigoPostal, $usuario->fechaNacimiento, $usuario->fechaAlta);
        }
        
        return $usuarios;
    }    
  
    public static function getUsuarioByID($usuario) { 
        $conexion = ConectarDB::conexion();
        $select = "SELECT * FROM usuario WHERE usuario='$usuario'";
        $consulta = $conexion->query($select);
        $listado = $consulta->fetchObject();
        
        $usuario = new Usuario ($listado->codigo, $listado->usuario, $listado->contrasenia, $listado->tipo, $listado->acceso);
                
        return $usuario;    
    }
    
    public static function getUsuarioCompletoById($usuario) { 
        $conexion = ConectarDB::conexion();
        $select = "SELECT * FROM usuario WHERE codigo='$usuario'";
        $consulta = $conexion->query($select);
        $listado = $consulta->fetchObject();
        
        $usuario = new Usuario ($listado->codigo, $listado->usuario, $listado->contrasenia, $listado->tipo, $listado->acceso, $listado->nombre, $listado->apellidos, $listado->codigoPostal, $listado->fechaNacimiento, $listado->fechaAlta);
                
        return $usuario;    
    }
    
    public static function actualizaUsuario($datos) { 
        $conexion = ConectarDB::conexion();
        $update = "UPDATE usuario SET nombre='$datos[nombre]', apellidos='$datos[apellidos]', codigoPostal='$datos[codigoPostal]', "
                . "usuario='$datos[usuario]', contrasenia='$datos[contrasenia]', fechaNacimiento='$datos[fechaNacimiento]', "
                . "fechaAlta='$datos[fechaAlta]', tipo='$datos[tipoUsuario]', acceso=$datos[acceso] WHERE codigo='$datos[codigo]'";
        $conexion->exec($update);
    }
    
    public static function borraUsuarioById($codigo) {
        $conexion = ConectarDB::conexion();
        $conexion->exec("DELETE FROM usuario WHERE codigo='$codigo'");
    }
    
    public static function insertaUsuario($datos) { 
        $conexion = ConectarDB::conexion();
        $insert = "INSERT INTO usuario (nombre, apellidos, codigoPostal, usuario, contrasenia, fechaNacimiento, fechaAlta, tipo, acceso, codigo) "
                . "VALUES ('$datos[nombre]', '$datos[apellidos]', '$datos[codigoPostal]', "
                . "'$datos[usuario]', '$datos[contrasenia]', '$datos[fechaNacimiento]', "
                . "'$datos[fechaAlta]', '$datos[tipoUsuario]', $datos[acceso], '$datos[codigo]')";
        $conexion->exec($insert);
    }    
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getCodigoPostal() {
        return $this->codigoPostal;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getContrasenia() {
        return $this->contrasenia;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function getAcceso() {
        return $this->acceso;
    }
}
