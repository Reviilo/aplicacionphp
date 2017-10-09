<?php

  class Conexion {
    static public function conectar () {

      # Crear un nuevo objeto PDO
      # tiene tres parametros

      $link = new PDO('mysql:host=localhost;dbname=aplicacionphp','root','');
      # var_dump($link);

      return $link;

    }
  }

  # $a = new Conexion();
  # $a -> conectar();


?>
