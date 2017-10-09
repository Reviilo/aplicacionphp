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
    static public function registroUsuarioController () {

      if (isset($_POST['user'])) {

        # recive por el metodo post 3 datos
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
    static public function ingresoUsuarioController () {

      if (isset($_POST['user'])) {

        $datos = array(
          'user' => $_POST['user'],
          'password' => $_POST['password']
        );

        $respuesta = Datos::ingresoUsuarioModel($datos, 'usuarios');

        # var_dump($respuesta);
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
    static public function vistaUsuariosController () {

      $respuesta = Datos::vistaUsuariosModel('usuarios');

      # echo '<pre>';
      #   var_dump($respuesta);
      # echo '</pre>';

      foreach($respuesta as $row => $item) {

        # var_dump($item);
        # echo '<pre>';
        #   var_dump($item);
        # echo '</pre>';

        echo '<tr>
  				<td>'.$item["user"].'</td>
  				<td>'.$item["password"].'</td>
  				<td>'.$item["email"].'</td>
  				<td><a href="index.php?action=editar&id='.$item["id"].'" ><button>Editar</button></a></td>
          <td><a href="index.php?action=usuarios&id='.$item["id"].'" ><button>Borrar</button></a></td>
  			</tr>';

        # <tr>
  			# 	<td>juan</td>
  			# 	<td>1234</td>
  			# 	<td>juan@hotmail.com</td>
  			# 	<td><button>Editar</button></td>
  			# 	<td><button>Borrar</button></td>
  			# </tr>
      }
    }

    # EDITAR USUARIO
    #-------------------------------------
    static public function editarUsuarioController () {

      if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $respuesta = Datos::editarUsuarioModel($id, 'usuarios');

        echo '
          <input type="hidden" value="'.$respuesta['id'].'" name="id">

          <input type="text" value="'.$respuesta['user'].'" name="user" required>

          <input type="text" value="'.$respuesta['password'].'" name="password" required>

          <input type="email" value="'.$respuesta['email'].'" name="email" required>

          <input type="submit" value="Actualizar">
        ';
      }
    }

    # ACTUALIZAR USUARIO
    #-------------------------------------
    static public function actualizarUsuarioController () {

      if (isset($_POST['user'])) {

        $datos = array(
          'id' => $_POST['id'],
          'user' => $_POST['user'],
          'password' => $_POST['password'],
          'email' => $_POST['email']
        );

        $respuesta = Datos::actualizarUsuarioModel($datos, 'usuarios');

        if ($respuesta) {
          header('Location: index.php?action=cambio', false);
        } else {
          echo "Sucedio un problema al actualizar los datos";
        }
      }
    }

  # BORRAR USUARIO
  #-------------------------------------
    static public function borrarUsuarioController () {

      if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $respuesta = Datos::borrarUsuarioModel($id, 'usuarios');

        if ($respuesta) {
          header('Location: index.php?action=usuarios');
        } else {
          echo "Ha surgido un problema";
        }
      }
    }

  }
?>
