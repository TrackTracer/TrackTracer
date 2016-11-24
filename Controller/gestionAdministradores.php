<?php
    session_start();

        require_once '../Model/Usuario.php';

        require_once 'Twig/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
        $twig = new Twig_Environment($loader);

        if (isset($_SESSION['logueado'])) {
            $usuario = unserialize($_SESSION['logueado']);
            
            if (!empty($_REQUEST['baja'])) {
                $datos['baja'] = $_REQUEST['baja'];
            } else if (!empty($_REQUEST['bajaConfirmada'])) {
                Usuario::borraUsuarioById($_REQUEST['bajaConfirmada']);
            } else if (!empty($_REQUEST['modificacion'])) {
                // SOLICITUD DE MODIFICACION ACCEPTADA E INICIO DE ENVIO DE FORMULARIO
                $datos['usuarioModificado'] = Usuario::getUsuarioCompletoById($_REQUEST['modificacion']);
            } else if (!empty($_REQUEST['confirmarModificacion'])) {
                $usuarioReferencia = Usuario::getUsuarioCompletoById($_REQUEST['confirmarModificacion']);
                
                $usuarioModificado = [];
                $usuarioModificado['codigo'] = $_REQUEST['confirmarModificacion'];
                
                if (empty($_REQUEST['nombre'])) {
                    $usuarioModificado['nombre'] = $usuarioReferencia->getNombre();
                } else {
                    $usuarioModificado['nombre'] = $_REQUEST['nombre'];
                }
                if (empty($_REQUEST['apellidos'])) {
                    $usuarioModificado['apellidos'] = $usuarioReferencia->getApellidos();
                } else {
                    $usuarioModificado['apellidos'] = $_REQUEST['apellidos'];
                }
                if (empty($_REQUEST['codigoPostal'])) {
                    $usuarioModificado['codigoPostal'] = $usuarioReferencia->getCodigoPostal();
                } else {
                    $usuarioModificado['codigoPostal'] = $_REQUEST['codigoPostal'];
                }
                if (empty($_REQUEST['usuario'])) {
                    $usuarioModificado['usuario'] = $usuarioReferencia->getUsuario();
                } else {
                    $usuarioModificado['usuario'] = $_REQUEST['usuario'];
                }
                if (empty($_REQUEST['contrasenia'])) {
                    $usuarioModificado['contrasenia'] = $usuarioReferencia->getContrasenia();
                } else {
                    $usuarioModificado['contrasenia'] = $_REQUEST['contrasenia'];
                }
                if (empty($_REQUEST['fechaNacimiento'])) {
                    $usuarioModificado['fechaNacimiento'] = $usuarioReferencia->getFechaNacimiento();
                } else {
                    $usuarioModificado['fechaNacimiento'] = $_REQUEST['fechaNacimiento'];
                }
                if (empty($_REQUEST['fechaAlta'])) {
                    $usuarioModificado['fechaAlta'] = $usuarioReferencia->getFechaAlta();
                } else {
                    $usuarioModificado['fechaAlta'] = $_REQUEST['fechaAlta'];
                }
                if (empty($_REQUEST['tipoUsuario'])) {
                    $usuarioModificado['tipoUsuario'] = $usuarioReferencia->getTipoUsuario();
                } else {
                    $usuarioModificado['tipoUsuario'] = $_REQUEST['tipoUsuario'];
                }
                if (empty($_REQUEST['acceso'])) {
                    $usuarioModificado['acceso'] = $usuarioReferencia->getAcceso();
                } else {
                    $usuarioModificado['acceso'] = $_REQUEST['acceso'];
                }
                
                Usuario::actualizaUsuario($usuarioModificado);
            } else if ($_REQUEST['confirmarInsercion']) {
                $usuarioModificado = [];
                
                $usuarioModificado['codigo'] = $_REQUEST['codigo'];
                $usuarioModificado['nombre'] = $_REQUEST['nombre'];
                $usuarioModificado['apellidos'] = $_REQUEST['apellidos'];
                $usuarioModificado['codigoPostal'] = $_REQUEST['codigoPostal'];
                $usuarioModificado['usuario'] = $_REQUEST['usuario'];
                $usuarioModificado['contrasenia'] = $_REQUEST['contrasenia'];
                $usuarioModificado['fechaNacimiento'] = $_REQUEST['fechaNacimiento'];
                $usuarioModificado['fechaAlta'] = $_REQUEST['fechaAlta'];
                $usuarioModificado['tipoUsuario'] = $_REQUEST['tipoUsuario'];
                $usuarioModificado['acceso'] = $_REQUEST['acceso'];
                
//                var_dump($usuarioModificado);
                echo Usuario::insertaUsuario($usuarioModificado);
            }
            
            $datos['usuarios'] = Usuario::getUsuarios();
            echo $twig->render('gestionAdministradores.html.twig', $datos);
            
        } else {
            echo $twig->render('home.html.twig', []); // Invalidación del usuario No Autorizado
        }