<?php
	session_start();

	if(!$_SESSION["validar"]) {
	 header("location: ingresar");
	 exit();
	}
?>

<h1>EDITAR USUARIO</h1>

<form method="post" onsubmit="return validacion()">

	<?php
		$mvc = new MvcController();
		$mvc -> editarUsuarioController();
		$mvc -> actualizarUsuarioController();
	?>

</form>
