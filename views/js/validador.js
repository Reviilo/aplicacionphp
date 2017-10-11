/** -------------------
 * VALIDAR REGISTRO
 * -------------------- */

function validacion () {
  var user = document.querySelector('#user') && document.querySelector('#user').value;
  var password = document.querySelector('#password') && document.querySelector('#password').value;
  var email = document.querySelector('#email') && document.querySelector('#email').value;
  var terminosElement = document.querySelector('#terminos') && document.querySelector('#terminos');

  /* Validacion de usuario */
  if (user !== null) {
    var userElement = document.querySelector('#user');
    var regex = /^[a-zA-Z0-9]*$/;

    if (user.length > 6) {
      var message = 'Escriba un nombre menor a 6 caracteres';
      var p = crearParrafo(message);
      userElement.parentElement.appendChild(p);

      return false;
    }

    if (!regex.test(user)) {
      var message = 'Escriba un nombre sin caracteres especiales';
      var p = crearParrafo(message);
      userElement.parentElement.appendChild(p);

      return false;
    }

    if (usuarioExistente) {
      var message = 'Usuario existente, pruebe con otro';
      var p = crearParrafo(message);
      userElement.parentElement.appendChild(p);

      return false;
    }
  }

  /* Validacion de la contraseña */
  if (password !== null) {
    var passwordElement = document.querySelector('#password');
    var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/;

    if (!regex.test(password)) {
      var message = 'Escriba una contraseña valida';
      var p = crearParrafo(message);
      passwordElement.parentElement.appendChild(p);

      return false;
    }
  }

  /* Validacion de email */
  if (email !== null) {
    var emailElement = document.querySelector('#email');
    var regex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    if (!regex.test(email)) {
      var message = 'Escriba una correo valido';
      var p = crearParrafo(message);
      emailElement.parentElement.appendChild(p);

      return false;
    }

    if (emailExistente) {
      var message = 'Email existente pruebe con otro';
      var p = crearParrafo(message);
      emailElement.parentElement.appendChild(p);

      return false;
    }
  }

  /* Validacion de terminos y condiciones */
  if (terminosElement) {
    if (!terminosElement.checked) {
      var terminosElement = document.querySelector('#terminos');
      var message = 'Los terminos y condiciones deben ser aceptados';
      var p = crearParrafo(message);
      terminosElement.parentElement.appendChild(p);

      return false;
    }
  }

  return true;
}

/** FIN VALIDAR REGISTRO **/

/** -------------------
 * CREAR ELEMENTO
 * -------------------- */

function crearParrafo (texto) {

  var p = document.createElement('p');
  p.className = 'error';
  var message = texto;
  p.innerText = message;

  return p;
}

 /** FIN CREAR ELEMENTO **/

 /** -------------------
  * VALIDACION DE USUARIO EXISTENTE AJAX
  * -------------------- */

$('#user').change(
  function () {
    var usuario = $('#user').val();
    var datos = new FormData();

    datos.append('validarUsuario', usuario);

    $.ajax({
      url: 'views/modules/ajax.php',
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var userElement = document.querySelector('#user');
        respuesta = parseInt(respuesta);
        if (respuesta === 0) {
          var message = 'Usuario no Disponible';
          var p = crearParrafo(message);
          userElement.parentElement.appendChild(p);
          usuarioExistente = true;
        } else {
          var message = 'Usuario Disponible';
          var p = crearParrafo(message);
          userElement.parentElement.appendChild(p);
          usuarioExistente = false;
        }
      }
    });

  //   var xhttp = new XMLHttpRequest();
  //   xhttp.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     var respuesta this.responseText;
  //     console.log(respuesta);
  //   }
  // };
  // xhttp.open("POST", datos, true);
  // xhttp.send();

  }
);

/** FIN VALIDACION DE USUARIO EXISTENTE AJAX **/

/** -------------------
 * VALIDACION DE USUARIO EXISTENTE AJAX
 * -------------------- */

$('#email').change(
 function () {
   var usuario = $('#email').val();
   var datos = new FormData();

   datos.append('validarEmail', usuario);

   $.ajax({
     url: 'views/modules/ajax.php',
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     success: function (respuesta) {
       var userElement = document.querySelector('#email');
       respuesta = parseInt(respuesta);
       if (respuesta === 0) {
         var message = 'Este email ya esta Registrado';
         var p = crearParrafo(message);
         userElement.parentElement.appendChild(p);
         emailExistente = true;
       } else {
         var message = 'Email Disponible';
         var p = crearParrafo(message);
         userElement.parentElement.appendChild(p);
         emailExistente = false;
       }
     }
   });

 //   var xhttp = new XMLHttpRequest();
 //   xhttp.onreadystatechange = function() {
 //   if (this.readyState == 4 && this.status == 200) {
 //     var respuesta this.responseText;
 //     console.log(respuesta);
 //   }
 // };
 // xhttp.open("POST", datos, true);
 // xhttp.send();

 }
);

/** FIN VALIDACION DE USUARIO EXISTENTE AJAX **/
