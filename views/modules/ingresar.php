<h1>INGRESAR</h1>

<form method="post" action="" onsubmit="return validacion()">

	<label for="user">
		Usuario:
		<input type="text" placeholder="Usuario" name="user" id="user" required>
	</label>

	<label for="password">
		Contraseña:
		<input type="password" placeholder="Contraseña" name="password" id="password" required>
	</label>

	<input type="submit" value="Enviar">

</form>

<?php
  if (isset($_GET['action'])) {
    if ($_GET['action'] === 'fallo') {
      echo 'Fallo al ingresar';
    }
  }

  $ingreso = new MvcController();
  $ingreso -> ingresoUsuarioController();
?>
