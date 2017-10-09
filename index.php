<?php
   ini_set('display_errors', '1');
  # ob_start();

  require_once "models/enlaces.php";
  require_once "models/crud.php";
  require_once "controllers/controller.php";

  $mvc = new MvcController();
  $mvc -> pagina();

?>
