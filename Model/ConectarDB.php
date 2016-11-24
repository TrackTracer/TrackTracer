<?php

abstract class ConectarDB {
  private static $server = 'mysql.hostinger.es';
  private static $db = 'u600939665_bd';
  private static $user = 'u600939665_user';
  private static $password = 'DKCe72M1MO';

  public static function conexion() {
    try {
      $connection = new PDO("mysql:host=".self::$server.";dbname=".self::$db.";charset=utf8", self::$user, self::$password);
    } catch (PDOException $e) {
      echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
    }
 
    return $connection;
  }
}