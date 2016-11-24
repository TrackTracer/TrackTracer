<?php
    session_start();
    
    require_once '../Model/Usuario.php';

    require_once 'Twig/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
    $twig = new Twig_Environment($loader);

    if (isset($_SESSION['logueado'])) {
        $usuario = unserialize($_SESSION['logueado']);
        if ($_REQUEST['accion'] == 'cerrarSesion') {
            session_destroy();
            header("Location: index.php");
        }
        if ($usuario->getTipoUsuario() == "usuario") {
            header("Location: pruebaGMAPS.php");
//            echo $twig->render('usuarioLogeado.html.twig', []);     // Seccion de Usuarios
        } else if ($usuario->getTipoUsuario() == "administrador") {
            header("Location: gestionAdministradores.php");
        }
    } else {
        if ($_REQUEST['accion'] == 'logear') {
            echo $twig->render('login.html.twig', []);
        } else if ($_REQUEST['accion'] == 'errorLogin400') {
            echo $twig->render('login.html.twig', ["error"=> 400]);
        } else if ($_REQUEST['accion'] == 'errorLogin101') {
            echo $twig->render('login.html.twig', ["error"=> 101]);
        } else if ($_REQUEST['accion'] == 'registrarse') {
            echo $twig->render('registro.html.twig', []);
        } else { 
            echo $twig->render('home.html.twig', []);
        }
    }