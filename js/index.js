$(document).ready(function () {


  $('.SexoUsuario').on('click', function (event) {
    event.preventDefault()
    $('#gender-user').val($(this).text())
  })

    $('.E_SexoUsuario').on('click', function (event) {
    event.preventDefault()
    $('#E-gender-user').val($(this).text())
  })



// ----------------------------- CARGAR DATOS -----------------


  // -- USUARIO --
  cargarDatosUser();
  function cargarDatosUser() {
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerDataUsuario" },
      url: "php/API/Usuario.php",
    })
      .done(function (data) {
        var items = JSON.parse(data);
        // // Datos de mi navbar

        // Imagen 1
         document.getElementById("pfp").src =
           "data:image/jpeg;base64," + items[0].fotoPerfil;
        // Imagen 2
         document.getElementById("pfp2").src =
           "data:image/jpeg;base64," + items[0].fotoPerfil;

        // Mi nombre
         $("#miNombre").text(items[0].nombre);
         $("#correoNav").text(items[0].correo);

        // //Datos para editar mi perfil
        document.getElementById("E_imgFoto").src =
          "data:image/jpeg;base64," + items[0].fotoPerfil;
        
         $("#E_email").val(items[0].correo);
         $("#E_names").val(items[0].nombre);
         $("#E_descripcion").val(items[0].descripcion);
         $("#E_lastNameP").val(items[0].apellidoPaterno);
          $("#E_lastNameM").val(items[0].apellidoMaterno);
         $("#E_generoUsuario").val(items[0].sexo);
         $("#E_FechaNacimiento").val(items[0].fechaNacimiento);
      })
      .fail(function (data) {
        console.error(data);
      });
  }

  
// ----------------------------- ACTUALIZAR DATOS -----------------
   // -- USUARIO --
  $("#EditUser").click(funcActualizarDatosPerfil);
  function funcActualizarDatosPerfil() {

    var file_data = $("#E_userIMG").prop("files")[0];
    var email = $("#E_email").val();
    var usuario = $("#E_usuario").val();
    var names = $("#E_names").val();
    var contrasenia = $("#E_contrasenia").val();
    var descripcion = $("#E_descripcion").val();
    var confirmar_Contrasenia = $("#E_confirmarContrasenia").val();
    var lastNameP = $("#E_lastNameP").val();
    var lastNameM = $("#E_lastNameM").val();
    var genero = $("#E_generoUsuario").val();
    var fechaNacimiento = $("#E_FechaNacimiento").val();


    if (contrasenia != confirmar_Contrasenia) {
      alert('La contraseña no coincide reintenta nuevamente');
      return
    }


    var form_data = new FormData();
    form_data.append("funcion", "actualizarUser");
    form_data.append("file", file_data);
    form_data.append("email", email);
    form_data.append("usuario", usuario);
    form_data.append("password", contrasenia);
    form_data.append("names", names);
    form_data.append("lastNameP", lastNameP);
    form_data.append("lastNameM", lastNameM);
    form_data.append("fechaNac", fechaNacimiento);
    form_data.append("genero", genero);
    form_data.append("MetodoPago_id", 1);
    form_data.append("descripcion", descripcion);
    
    $.ajax({
      url: "php/API/Usuario.php",
      type: "POST",
      cache: false,
      contentType: false,
      data: form_data,
      dataType: "JSON",
      enctype: "multipart/form-data",
      processData: false,
    })
      .done(function (data) {
        console.log(data);
      })
      .fail(function (data) {
        // MANEJO DE ERRORES DEL SERVIDOR
      if (data.responseText.length < 8) {
          alert("Perfil Actualizado Correctamente");
          cargarDatosUser();
        } else {
          alert("Algo ocurrió mal");
          console.log(data.responseText)
        }
      });
  }



  // Inicio de sesión
  $('#ButtonLogIn').click(funcIniciarSesion)
  function funcIniciarSesion() {
    var usuarioCorreo = $('#correoLogin').val()
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


let vista_preliminarEdit = (event) => {
  let leer_img = new FileReader();
  let id_img = document.getElementById("E_imgFoto");

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result;
    }
  };

  leer_img.readAsDataURL(event.target.files[0]);
};


let vista_preliminar2 = (event) => {
  let leer_img = new FileReader();
  let id_img = document.getElementById("img-foto2");

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result;
    }
  };

  leer_img.readAsDataURL(event.target.files[0]);
};