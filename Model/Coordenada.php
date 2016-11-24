<?php

class Coordenada {
    public static function getCoordenadas() {
    $connection = ConnectionDB::connectCoordsDB();
    $query = "SELECT codigo, latitud, longitud, fecha, hora FROM coordenadas";
    $data = $connection->query($query);
    
    $package = [];
    
    while ($list = $data->fetchObject()) {
      $package[] = new Coord($list->codigo, $list->latitud, $list->longitud, $list->fecha, $list->hora);
    }
   
    return $package;    
  }
}
