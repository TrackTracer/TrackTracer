<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trazador</title>
    </head>
    <body>
        <?php 
            require_once '../Model/Usuario.php';
            require_once '../Model/ConectarDB.php';
        
            $archivo = $_FILES["traza"]["name"];
            
            move_uploaded_file($_FILES["traza"]["tmp_name"], "../Model/Trazas/" . $archivo);
            

                $conexion = ConectarDB::conexion();

                if (file_exists("../Model/Trazas/" . $archivo)) {
                    $xmlstr = simplexml_load_file("../Model/Trazas/" . $archivo);
//                    echo "<h3>Leyendo archivo...</h3>";
    //                var_dump($xmlstr);
                } else {
                    exit("Error abriendo $archivo");
                }

                $codigoUsuario = unserialize($_SESSION['logueado']);
//                var_dump($codigoUsuario);
//                echo "asdfas: ".$codigoUsuario->getCodigo();
                foreach ($xmlstr->trk->trkseg->trkpt as $coordena) {
//                   echo 'LONGITUD:'.$coordena['lon'].'LATITUD: '.$coordena['lat'].'<br>';
                        
//                   echo 'TIME:'.$coordena->time.'<br>';
                   $fechaHora = preg_split("/[TZ]/", $coordena->time, null, PREG_SPLIT_NO_EMPTY);
                   $hora = substr($fechaHora[1], 0, 8);
//                   echo 'FECHA: '.$fechaHora[0].' HORA: '.$hora;
                   $insercion = "INSERT INTO coordenada (codigoUsuario, longitud, latitud, fecha, hora)"
                       
                    . " VALUES ('".$codigoUsuario->getCodigo()."', '$coordena[lon]', '$coordena[lat]', '$fechaHora[0]', '$hora')";

//                    echo $insercion;
                    $conexion->exec($insercion);

                    $codigo++;
                }
                header("Location: pruebaGMAPS.php");
        ?>
    </body>
</html>


