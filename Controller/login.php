<?php
    session_start();
    
    require_once '../Model/Usuario.php';
    

    $usuario = $_REQUEST['usuario'];
    $contrasenia = $_REQUEST['contrasenia'];
    
    $usuarioIdentificado = Usuario::getUsuarioByID($usuario);
    
    
    if ($usuarioIdentificado->getUsuario() == $usuario && $usuarioIdentificado->getContrasenia() == $contrasenia && $usuarioIdentificado->getAcceso()) {
        $_SESSION['logueado'] = serialize($usuarioIdentificado);
        header("Location: index.php"); 
    } else {
        if (!$usuarioIdentificado->getAcceso() && $usuarioIdentificado->getAcceso() != null) {
//            var_dump($usuarioIdentificado);
            header("Location: index.php?accion=errorLogin101");
        } else {
            header("Location: index.php?accion=errorLogin400");
        }
    }
    
    