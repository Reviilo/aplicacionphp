<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>Template</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900|Rye" rel="stylesheet">
    <link rel="stylesheet" href="views/icons/style.css" type="text/css">
  	<link rel="stylesheet" href="views/css/style.css" type="text/css">
    <link rel="stylesheet" href="views/css/normalize.css" type="text/css">
  </head>

  <body>

    <?php include "modules/navegacion.php"; ?>

    <section>

      <?php

        $mvc = new MvcController();
        $mvc -> enlacesPaginasController();

       ?>
    </section>

    <script src="views/js/validarRegistro.js" charset="utf-8"></script>
  </body>

</html>
