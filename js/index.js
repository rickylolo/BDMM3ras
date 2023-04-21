$(document).ready(function () {
  $('.SexoUsuario').on('click', function (event) {
    event.preventDefault()
    $('#gender-user').val($(this).text())
  })
  // Inicio de sesión
  $('#ButtonLogIn').click(funcIniciarSesion)
  function funcIniciarSesion() {
    var usuarioCorreo = $('#username').val()
    var pass = $('#password').val()
    $.ajax({
      url: 'php/API/Usuario.php',
      type: 'POST',
      data: {
        funcion: 'iniciarSesion',
        username: usuarioCorreo,
        password: pass,
      },
    })
      .done(function (data) {
        console.log(data)
        var items = JSON.parse(data)

        if (items.length == 0) {
          alert('No existen usuarios con esas credenciales, intenta nuevamente')
          return
        }
        switch (items[0].rolUsuario) {
          case 1:
            window.location.replace('paginaAdmin.php')
            break
          case 2:
            window.location.replace('paginaInstructor.php')
            break
          case 3:
            window.location.replace('index.php')
            break
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // Registro de usuarios con dataform
  //-------------------------ESTUDIANTE----------------------------
  $('#ButtonRegistroEstudiante').click(funcRegistrarEstudiante)
  function funcRegistrarEstudiante() {
    //Verificacion contraseña
    var contrasenia = $('#password').val()
    var contrasenia_confirmar = $('#confirmar_password').val()
    if (contrasenia != contrasenia_confirmar) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }
    var form_data = new FormData()
    var file_data = $('#userIMG').prop('files')[0]
    var email = $('#email').val()
    var usuario = $('#usuario').val()
    var names = $('#names').val()
    var lastNameP = $('#lastNameP').val()
    var lastNameM = $('#lastNameM').val()
    var fechaNacimiento = $('#Birthday').val()
    var genero = $('#gender-user').val()
    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarUsuario')
    form_data.append('email', email)
    form_data.append('usuario', usuario)
    form_data.append('password', contrasenia)
    form_data.append('names', names)
    form_data.append('lastNameP', lastNameP)
    form_data.append('lastNameM', lastNameM)
    form_data.append('fechaNac', fechaNacimiento)
    form_data.append('genero', genero)
    form_data.append('user_Type', 3)
    $.ajax({
      url: 'php/API/Usuario.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'JSON',
      enctype: 'multipart/form-data',
      processData: false,
    }).fail(function (data) {
      // MANEJO DE ERRORES DEL SERVIDOR
      console.log(data.responseText)
      if (data.responseText.length < 8) {
        alert('Registro de estudiante correctamente')
        $('#userIMG').val('')
        $('#email').val('')
        $('#usuario').val('')
        $('#names').val('')
        $('#lastNameP').val('')
        $('#lastNameM').val('')
        $('#Birthday').val('')
        $('#gender-user').val('')
        $('#password').val('')
        $('#confirmar_password').val('')
      } else {
        alert('Algo salió mal')
      }
    })
  }

  //-------------------------INSTRUCTOR----------------------------
  $('#ButtonRegistroInstructor').click(funcRegistrarInstructor)
  function funcRegistrarInstructor() {
    //Verificacion contraseña
    var contrasenia = $('#password').val()
    var contrasenia_confirmar = $('#confirmar_password').val()
    if (contrasenia != contrasenia_confirmar) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }
    var form_data = new FormData()
    var file_data = $('#userIMG').prop('files')[0]
    var email = $('#email').val()
    var usuario = $('#usuario').val()
    var names = $('#names').val()
    var lastNameP = $('#lastNameP').val()
    var lastNameM = $('#lastNameM').val()
    var fechaNacimiento = $('#Birthday').val()
    var genero = $('#gender-user').val()
    form_data.append('file', file_data)
    form_data.append('funcion', 'registrarUsuario')
    form_data.append('email', email)
    form_data.append('usuario', usuario)
    form_data.append('password', contrasenia)
    form_data.append('names', names)
    form_data.append('lastNameP', lastNameP)
    form_data.append('lastNameM', lastNameM)
    form_data.append('fechaNac', fechaNacimiento)
    form_data.append('genero', genero)
    form_data.append('user_Type', 2)
    $.ajax({
      url: 'php/API/Usuario.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'JSON',
      enctype: 'multipart/form-data',
      processData: false,
    }).fail(function (data) {
      // MANEJO DE ERRORES DEL SERVIDOR
      console.log(data.responseText)
      if (data.responseText.length < 8) {
        alert('Registro de estudiante correctamente')
        $('#userIMG').val('')
        $('#email').val('')
        $('#usuario').val('')
        $('#names').val('')
        $('#lastNameP').val('')
        $('#lastNameM').val('')
        $('#Birthday').val('')
        $('#gender-user').val('')
        $('#password').val('')
        $('#confirmar_password').val('')
      } else {
        alert('Algo salió mal')
      }
    })
  }
})

let vista_preliminar2 = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById('img-foto2')

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}
