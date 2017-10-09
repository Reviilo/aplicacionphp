<?php

  class MvcController {

  	#LLAMADA A LA PLANTILLA
  	#-------------------------------------
  	static public function pagina () {
  		include "views/template.php";
  	}

  	#ENLACES
  	#-------------------------------------
  	static public function enlacesPaginasController () {
  		if(isset( $_GET['action'])){
  			$enlaces = $_GET['action'];
  		} else{
  			$enlaces = "index";
  		}

  		$respuesta = Paginas::enlacesPaginasModel($enlaces);

  		include $respuesta;
  	}

    #REGISTRO DE USUARIO
  	#-------------------------------------
    static public function registroUsuarioControler () {

      if (isset($_POST['user'])) {

        // recive por el metodo post 3 datos
        $datos = array(
          'user' => $_POST['user'],
          'password' => $_POST['password'],
          'email' => $_POST['email']
        );

        $respuesta = Datos::registroUsuarioModel($datos, 'usuarios');

        if ($respuesta) {
          header('Location: index.php?action=ok', false);
        } else {
          header('Location: index.php', false);
        }

      }

    }

    #INGRESO DE USUARIO
  	#-------------------------------------
    static public function ingresoUsuarioControler () {

      if (isset($_POST['user'])) {

        $datos = array(
          'user' => $_POST['user'],
          'password' => $_POST['password']
        );

        $respuesta = Datos::ingresoUsuarioModel($datos, 'usuarios');

        // var_dump($respuesta);
        $verificacionRespuesta = $respuesta['user'] === $datos['user'] && $respuesta['password'] === $datos['password'];

        if ($verificacionRespuesta) {

          session_start();

          $_SESSION['validar'] = true;

          header('location: index.php?action=usuarios');

        } else {
          header('location: index.php?action=fallo');
        }

      }

    }

    #REGISTRO DE USUARIO
    #-------------------------------------
    static public function vistaUsuariosControler () {

      $respuesta = Datos::vistaUsuariosModel('usuarios');

      // echo '<pre>';
      //   var_dump($respuesta);
      // echo '</pre>';

      foreach($respuesta as $row => $item) {

        // var_dump($item);
        // echo '<pre>';
        //   var_dump($item);
        // echo '</pre>';

        echo '<tr id='.$item["id"].'>
  				<td>'.$item["user"].'</td>
  				<td>'.$item["password"].'</td>
  				<td>'.$item["email"].'</td>
  				<td><button>Editar</button></td>
  				<td><button>Borrar</button></td>
  			</tr>';

      }

      // <tr>
			// 	<td>juan</td>
			// 	<td>1234</td>
			// 	<td>juan@hotmail.com</td>
			// 	<td><button>Editar</button></td>
			// 	<td><button>Borrar</button></td>
			// </tr>

    }

  }



  // ob_end_flush();

?>
