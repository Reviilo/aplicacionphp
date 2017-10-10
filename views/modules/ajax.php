<?php

  require_once '../../controllers/controller.php';
  require_once '../../models/crud.php';

  class Ajax {

    public $validarUsuario;
    public $validarEmail;

    public function validarUsuarioAjax () {
      $dato = $this -> validarUsuario;

      $respuesta = MvcController::validarUsuarioController($dato);

      echo $respuesta;
    }

    public function validarEmailAjax () {
      $dato = $this -> validarEmail;

      $respuesta = MvcController::validarEmailController($dato);

      echo $respuesta;
    }
  }

  if(isset($_POST['validarUsuario'])){
    $a = new Ajax();
    $a -> validarUsuario = $_POST['validarUsuario'];
    $a -> validarUsuarioAjax();
  }

  if(isset($_POST['validarEmail'])){
    $a = new Ajax();
    $a -> validarEmail = $_POST['validarEmail'];
    $a -> validarEmailAjax();
  }

?>
