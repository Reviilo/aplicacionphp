<?php
	session_start();

	if(!$_SESSION["validar"]) {
	 header("location:index.php?action=ingresar");
	 exit();
	}
?>

<h1>EDITAR USUARIO</h1>

<form method="post" >

	<?php
		$mvc = new MvcController();
		$mvc -> editarUsuarioController();
		$mvc -> actualizarUsuarioController();
	?>

</form>
