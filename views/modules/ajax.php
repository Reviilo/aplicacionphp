<?php

  require_once '../../controllers/controller.php';
  require_once '../../models/crud.php';

  class Ajax {

    public $validarUsuario;

    static public function validarUsuarioAjax () {
      $datos = $this -> validarUsuario;

      // $respuesta = MvcController::validarUsuarioController($datos);
      //
      // $echo $respuesta;

      echo $datos;
    }
  }

  if(isset($_POST['validarUsuario'])){
    $a = new Ajax();
    $a -> validarUsuario = $_POST['validarUsuario'];
    $a -> validarUsuarioAjax();
  }

?>
