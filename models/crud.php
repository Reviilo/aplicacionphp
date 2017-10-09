<?php
  // include 'Conexion.php';
  require_once 'Conexion.php';

  class Datos extends Conexion {

    # REGISTRO DE USUARIO
    #--------------------------------------
    static public function registroUsuarioModel ($datos, $tabla) {
      // Operador de resolucion de ambito ::
      // para llegar a una funcion de una clase heredada

      // stmt  =  statment
      // Para el sql las comillas tienen que ser dobles
      $stmt = Conexion::conectar()->prepare(
        "INSERT INTO $tabla (user, password, email) VALUES (:user, :password, :email)"
      );

      $stmt -> bindParam(':user', $datos['user'], PDO::PARAM_STR);
      $stmt -> bindParam(':password', $datos['password'], PDO::PARAM_STR);
      $stmt -> bindParam(':email', $datos['email'], PDO::PARAM_STR);


      // if ($stmt -> execute()) {
      //   return 'success';
      // } else {
      //   return 'error';
      // }

      return $stmt -> execute();
    }

    # INGRESO DE USUARIO
    #--------------------------------------
    static public function ingresoUsuarioModel ($datos, $tabla) {

      $stmt = Conexion::conectar()->prepare(
        "SELECT user, password FROM $tabla WHERE user = :user"
      );

      $stmt -> bindParam(':user', $datos['user'], PDO::PARAM_STR);

      $stmt -> execute();

      // Obitiene la fila que se esta pidiendo
      return $stmt -> fetch();
    }

    # VISUALISACION DE USUARIOS
    #--------------------------------------
    static public function vistaUsuariosModel ($tabla) {

      $stmt = Conexion::conectar()->prepare(
        "SELECT id, user, password, email FROM $tabla"
      );

      $stmt -> execute();

      //Obitne todas las filas fetchAll
      return $stmt -> fetchAll();
    }

  }


  // $a = new Conexion();
  // $a -> conectar();
?>
