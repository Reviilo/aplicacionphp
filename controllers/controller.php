<?php
  require_once "controllers/crypt.php";

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
  			// $enlaces = $_GET['action'];

        $datosEnlaces = explode('/', $_GET['action']);
        $enlaces = $datosEnlaces[0];

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

        $validador = preg_match('/^[A-Za-z0-9]+$/', $_POST['user']) &&
                    preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST['password']) &&
                    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $_POST['email']);

        $conEnctriptada = encriptar($_POST['password']);

        if ($validador) {
          # recive por el metodo post 3 datos'
          $datos = array(
            'user' => $_POST['user'],
            'password' => $conEnctriptada,
            'email' => $_POST['email']
          );

          $respuesta = Datos::registroUsuarioModel($datos, 'usuarios');

          echo $respuesta;

          if ($respuesta) {
            header('Location: ok', false);
          } else {
            header('Location: index.php', false);
          }
        }
      }
    }

    #INGRESO DE USUARIO
  	#-------------------------------------
    static public function ingresoUsuarioController () {

      if (isset($_POST['user'])) {

        $validador = preg_match('/^[A-Za-z0-9]+$/', $_POST['user']) &&
                    preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST['password']);

        if ($validador) {
          $datos = array(
            'user' => $_POST['user'],
            'password' => $_POST['password']
          );

          $user = $_POST['user'];

          $respuesta = Datos::ingresoUsuarioModel($datos['user'], 'usuarios');

          $verificarContraseña = password_verify($datos['password'], $respuesta['password']);

          $verificacionRespuesta = $respuesta['user'] === $datos['user'] && $verificarContraseña;

          $intentosUsuario = $respuesta['intentos'];

          if ($intentosUsuario < 2) {

            if ($verificacionRespuesta) {
              session_start();
              $_SESSION['validar'] = true;

              $intentosUsuario = 0;
              $datosIntento = array(
                'user' => $datos['user'],
                'intentos' => $intentosUsuario
              );
              $respuestaIntentos = Datos::actualizarIntentoModel($intentos, 'usuarios');

              header('location: index.php?action=usuarios');

            } else {
              ++$intentosUsuario;
              $datosIntento = array(
                'user' => $datos['user'],
                'intentos' => $intentosUsuario
              );
              $respuestaIntentos = Datos::actualizarIntentoModel($datosIntento, 'usuarios');
              echo 'No coinciden los datos, porfavor intentelo de nuevo';
            }
          } else {
            header('location: falloDeIntentos');
          }
        }
      }
    }

    # LISTA DE USUARIOS
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
  				<td><a href="editar/'.$item["id"].'" ><button>Editar</button></a></td>
          <td><a href="usuarios/'.$item["id"].'" ><button>Borrar</button></a></td>
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
        $datos = explode('/', $_GET['action']);
        
        // $id = $_GET['id'];
        $id = $datos[1];

        $respuesta = Datos::editarUsuarioModel($id, 'usuarios');

        echo '
          <input type="hidden" value="'.$respuesta['id'].'" name="id">

          <label for="user">
            Usuario:
            <input type="text" value="'.$respuesta['user'].'" name="user" id="user" required>
          </label>

          <label for="password">
            Contraseña:
            <div class="informacion-password">
        			<span class="icon-info icon-password">info</span>
        			<div class="info-content-password">
        				<p>La contraseña debe tener almenos 6 caracteres </p>
        				<p>Debe tener al menos una mayuscula</p>
        				<p>Debe tener al menos una minuscula</p>
        				<p>Debe tener al menos un numero</p>
        			</div>
        		</div>
            <input type="text" value="'.$respuesta['password'].'" name="password" id="password" required>
          </label>

          <label for="email">
            Correo:
            <input type="email" value="'.$respuesta['email'].'" name="email" id="email" required>
          </label>

          <input type="submit" value="Actualizar">
        ';
    }

    # ACTUALIZAR USUARIO
    #-------------------------------------
    static public function actualizarUsuarioController () {

      if (isset($_POST['user'])) {

        $validador = preg_match('/^[A-Za-z0-9]+$/', $_POST['user']) &&
                    preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST['password']) &&
                    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $_POST['email']);

        $conEnctriptada = encriptar($_POST['password']);

        if (validador) {
          $datos = array(
            'id' => $_POST['id'],
            'user' => $_POST['user'],
            'password' => $conEnctriptada,
            'email' => $_POST['email']
          );

          $respuesta = Datos::actualizarUsuarioModel($datos, 'usuarios');

          if ($respuesta) {
            header('Location: cambio', false);
          } else {
            echo "Sucedio un problema al actualizar los datos";
          }
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
          header('Location: usuarios');
        } else {
          echo "Ha surgido un problema";
        }
      }
    }

  }
?>
