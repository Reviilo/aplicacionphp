/** -------------------
 * VALIDAR REGISTRO
 * -------------------- */

function validarRegistro () {
  var user = document.querySelector('#user').value;
  var password = document.querySelector('#password').value;
  var email = document.querySelector('#email').value;
  var terminos = document.querySelector('#terminos').checked;

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
  }

  /* Validacion de la contraseña */
  if (password !== null) {
    var passwordElement = document.querySelector('#password');
    var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;

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
  }

  /* Validacion de terminos y condiciones */
  if (!terminos) {
    var terminosElement = document.querySelector('#terminos');
    var message = 'Los terminos y condiciones deben ser aceptados';
    var p = crearParrafo(message);
    terminosElement.parentElement.appendChild(p);

    return false;
  }

  return true;
}

 /** -------------------
  * FIN VALIDAR REGISTRO
  * -------------------- */

/** -------------------
 * CREAR ELEMENTO
 * -------------------- */

function crearParrafo (texto) {

  var p = document.createElement('p');
  var message = texto;
  p.innerText = message;

  return p;
}

 /** -------------------
  * FIN CREAR ELEMENTO
  * -------------------- */
