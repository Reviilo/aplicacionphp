<?php
  # include 'Conexion.php';
  require_once 'conexion.php';

  class Datos extends Conexion {

    # REGISTRO DE USUARIO
    #--------------------------------------
    static public function registroUsuarioModel ($datos, $tabla) {
      # Operador de resolucion de ambito ::
      # para llegar a una funcion de una clase heredada

      # stmt  =  statment
      # Para el sql las comillas tienen que ser dobles
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

      $stmt -> close();
    }

    # INGRESO DE USUARIO
    #--------------------------------------
    static public function ingresoUsuarioModel ($user, $tabla) {

      $stmt = Conexion::conectar()->prepare(
        "SELECT user, password, intentos FROM $tabla WHERE user = :user"
      );

      $stmt -> bindParam(':user', $user, PDO::PARAM_STR);

      $stmt -> execute();

      # Obitiene la fila que se esta pidiendo
      return $stmt -> fetch();

      $stmt -> close();
    }

    # VISUALISACION DE USUARIOS
    #--------------------------------------
    static public function vistaUsuariosModel ($tabla) {

      $stmt = Conexion::conectar()->prepare(
        "SELECT id, user, password, email FROM $tabla"
      );

      $stmt -> execute();

      #Obitne todas las filas fetchAll
      return $stmt -> fetchAll();

      $stmt -> close();
    }

    # EDITAR USUARIO
    #--------------------------------------
    static public function editarUsuarioModel($id, $tabla) {

      $stmt = Conexion::conectar() -> prepare(
        "SELECT id, user, password, email FROM $tabla WHERE id = :id"
      );

      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();
    }

    # ACTUALIZAR USUARIO
    #-------------------------------------
    static public function actualizarUsuarioModel ($datos, $tabla) {
      $stmt = Conexion::conectar() -> prepare(
        "UPDATE $tabla SET user=:user, password=:password, email=:email WHERE id=:id"
      );

      $stmt -> bindParam(':id', $datos['id'], PDO::PARAM_INT);
      $stmt -> bindParam(':user', $datos['user'], PDO::PARAM_STR);
      $stmt -> bindParam(':password', $datos['password'], PDO::PARAM_STR);
      $stmt -> bindParam(':email', $datos['email'], PDO::PARAM_STR);

      return $stmt -> execute();

      $stmt -> close();
    }

    # BORRAR USUARIO
    #-------------------------------------
    static public function borrarUsuarioModel ($id, $tabla) {
      $stmt = Conexion::conectar() -> prepare(
        "DELETE FROM $tabla WHERE id=:id"
      );

      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);

      return $stmt -> execute();

      $stmt -> close();
    }

    # ACTUALIZAR INTENTOS DE INGRESO USUARIO
    #-------------------------------------
    static public function actualizarIntentoModel ($datos, $tabla) {
      $stmt = Conexion::conectar() -> prepare(
        "UPDATE $tabla SET intentos=:intentos WHERE user=:user"
      );

      $stmt -> bindParam(':user', $datos['user'], PDO::PARAM_STR);
      $stmt -> bindParam(':intentos', $datos['intentos'], PDO::PARAM_INT);

      return $stmt -> execute();

      $stmt -> close();
    }
  }
  # $a = new Conexion();
  # $a -> conectar();
?>
