<h1>INGRESAR</h1>

<form method="post" action="">

	<input type="text" placeholder="Usuario" name="user" required>

	<input type="password" placeholder="Contraseña" name="password" required>

	<input type="submit" value="Enviar">

</form>

<?php
  if (isset($_GET['action'])) {
    if ($_GET['action'] === 'fallo') {
      echo "Fallo al ingresar";
    }
  }


  $ingreso = new MvcController();
  $ingreso -> ingresoUsuarioControler();
?>
