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
      echo 'Fallo al ingresar, vuelvalo a intentar';
    }
  }

  if (isset($_GET['action'])) {
    if ($_GET['action'] === 'falloDeIntentos') {
      echo 'Compruebe que no es un robot, toquese la nariz con el dedo gordo del pie';
    }
  }

  $ingreso = new MvcController();
  $ingreso -> ingresoUsuarioController();
?>
