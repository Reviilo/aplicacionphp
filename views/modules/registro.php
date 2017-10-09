<h1>REGISTRO DE USUARIO</h1>

<form method="post" onsubmit="return validarRegistro()">

	<label for="user">
		User
		<input type="text" placeholder="Usuario" name="user" id="user" required>
	</label>

	<label for="password">
		Password
		<div class="informacion-password">
			<span class="icon-info icon-password">info</span>
			<div class="info-content-password">
				<p>La contraseña debe tener almenos 6 caracteres </p>
				<p>Debe tener al menos una mayuscula</p>
				<p>Debe tener al menos una minuscula</p>
				<p>Debe tener al menos un numero</p>
				<p>Debe tener al menos un caracter especial</p>
			</div>
		</div>
		<input type="password" placeholder="Contraseña" name="password" id="password" required>
	</label>

	<label for="email">
		Email
		<input type="email" placeholder="Email" name="email" id="email" required>
	</label>

	<label for="terminos">
		<input type="checkbox" name="terminos" id="terminos">
		<a href="#">Acepta los terminos y condiciones</a>
	</label>

	<!-- <button type="button" name="button">Enviar</button> -->
	<input type="submit" value="Enviar">

</form>

<?php
  $registro = new MvcController();
  $registro -> registroUsuarioController();

   if (isset($_GET['action'])) {
     if ($_GET['action'] === 'ok') {
       echo 'Registro Existoso';
     }
   }
?>
