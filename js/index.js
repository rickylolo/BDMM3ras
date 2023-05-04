$(document).ready(function () {
  $('.SexoUsuario').on('click', function (event) {
    event.preventDefault()
    $('#gender-user').val($(this).text())
  })

  $('.E_SexoUsuario').on('click', function (event) {
    event.preventDefault()
    $('#E-gender-user').val($(this).text())
  })

  $('#Valoraciones').hide()
  $('#Instructor').hide()
  $('#miCursoDetalle').hide()

  // -------- MIS BOTONES ------------
  //CONTENIDO
  $('#mostrarContenido').click(function () {
    // Muestro
    $('#miContenido').show()
    // Oculto
    $('#Valoraciones').hide()
    $('#Instructor').hide()
  })

  //VALORACIONES
  $('#mostrarValoracion').click(function () {
    // Muestro
    $('#Valoraciones').show()
    // Oculto
    $('#Instructor').hide()
    $('#miContenido').hide()
  })

  //INSTRUCTOR
  $('#mostrarInstructor').click(function () {
    // Muestro
    $('#Instructor').show()
    // Oculto
    $('#Valoraciones').hide()
    $('#miContenido').hide()
  })

  // ----------------------------- CARGAR DATOS -----------------

  // -- CATEGORIA --
  cargarCategorias()
  function cargarCategorias() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataTodosCategoria' },
      url: 'php/API/Categoria.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misCategoriasNav').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misCategoriasNav').append(
            `<li><a class="dropdown-item miBusquedaCategoria" href="" id="` +
              items[i].Categoria_id +
              `"> ` +
              items[i].nombre +
              `</a></li> `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- USUARIO --
  cargarDatosUser()
  function cargarDatosUser() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataUsuario' },
      url: 'php/API/Usuario.php',
    })
      .done(function (data) {
        if (data == 0) return
        var items = JSON.parse(data)
        // // Datos de mi navbar

        // Imagen 1
        document.getElementById('pfp').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil
        // Imagen 2
        document.getElementById('pfp2').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil

        // Mi nombre
        $('#miNombre').text(items[0].nombre)
        $('#correoNav').text(items[0].correo)

        // //Datos para editar mi perfil
        document.getElementById('E_imgFoto').src =
          'data:image/jpeg;base64,' + items[0].fotoPerfil

        $('#E_email').val(items[0].correo)
        $('#E_names').val(items[0].nombre)
        $('#E_descripcion').val(items[0].descripcion)
        $('#E_lastNameP').val(items[0].apellidoPaterno)
        $('#E_lastNameM').val(items[0].apellidoMaterno)
        $('#E_generoUsuario').val(items[0].sexo)
        $('#E_FechaNacimiento').val(items[0].fechaNacimiento)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // ------- CURSOS --------
  // --- MEJORES CALIFICADOS ---
  cargarCursosMejoresCalificados()
  function cargarCursosMejoresCalificados() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getCursosMejoresCalificados' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misCursosMejoresCalificados').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misCursosMejoresCalificados').append(
            `
                <article class="post">
                        <div class="post-header">
                             <a href="#" class="verCursoDetalle" id="` +
              items[i].Curso_id +
              `">
                                <img src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>` +
              items[i].nombre +
              `</b></h4>
                            <span>Impartido Por :<div class="instructor">` +
              items[i].nombreCompleto +
              `</div></span><br>
                            <a href="#" class="btn verCurso verCursoDetalle" id="` +
              items[i].Curso_id +
              `">Ver Curso</a>
                        </div>
                </article>
            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // --- MAS VENDIDOS  ---
  cargarCursosMasVendidos()
  function cargarCursosMasVendidos() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getCursosMasVendidos' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misCursosMasVendidos').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misCursosMasVendidos').append(
            `
                <article class="post">
                        <div class="post-header">
                             <a href="#" class="verCursoDetalle" id="` +
              items[i].Curso_id +
              `">
                                <img src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>` +
              items[i].nombre +
              `</b></h4>
                            <span>Impartido Por :<div class="instructor">` +
              items[i].nombreCompleto +
              `</div></span><br>
                            <a href="#" class="btn verCurso verCursoDetalle" id="` +
              items[i].Curso_id +
              `">Ver Curso</a>
                        </div>
                </article>
            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }
  // --- MAS RECIENTES ---
  cargarCursosMasRecientes()
  function cargarCursosMasRecientes() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getCursosMasRecientes' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misCursosMasRecientes').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misCursosMasRecientes').append(
            `
                <article class="post">
                        <div class="post-header">
                             <a href="#" class="verCursoDetalle" id="` +
              items[i].Curso_id +
              `">
                                <img src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>` +
              items[i].nombre +
              `</b></h4>
                            <span>Impartido Por :<div class="instructor">` +
              items[i].nombreCompleto +
              `</div></span><br>
                            <a href="#" class="btn verCurso verCursoDetalle" id="` +
              items[i].Curso_id +
              `">Ver Curso</a>
                        </div>
                </article>
            `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function misDatosCursoDetalle(cursoID) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCurso', Curso_id: cursoID },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        misDatosInstructor(items[0].Usuario_id)
        $('#miInfoCurso').empty()
        $('#miInfoCurso').append(
          `
           <div class="d-flex flex-row">
                    <div class="p-2">
                        <div class="card" style="width: 22rem;">
                            <img src="data:image/jpeg;base64,` +
            items[0].imagenCurso +
            `" class="card-img-top" alt="...">
                          
                        </div>
                    </div>
                    
                    <div class="ps-4 pe-4 pt-2 pb-2 d-flex flex-column flex-fill shadow-sm">
                      <div class="d-flex justify-content-end">
                                <span class="badge rounded-pill bg-primary me-2">Valoraciones: ` +
            items[0].noComentarios +
            `</span>
                                <span class="badge rounded-pill bg-success me-2">Recomendaciones: ` +
            items[0].noLikes +
            `</span>
                                <span class="badge rounded-pill bg-danger">No Recomendaciones: ` +
            items[0].noDislikes +
            `</span>
                              </div>
                                   <hr class="solid">
                            <div class="d-flex flex-row">
                                <p class="fs-2 pt-1 ps-4 fw-bolder me-auto ">` +
            items[0].cursoNombre +
            `</p>
                                <p class="fs-4 pe-4 pt-2 fw-light text-primary">` +
            items[0].categoriaNombre +
            `</p>

                            </div>

                            <p class="text-muted fs-5 p-4">` +
            items[0].descripcion +
            `</p>
                            <div class="mt-auto">
                              <div class="fw-bold pb-2 pt-4">
                                <p class="fs-4 pe-4 text-end text-primary">
                                    ` +
            items[0].costoCurso +
            ` MXN

                                </p>
                                <a href="" data-bs-toggle="modal" data-bs-target="#miModalMetodoPago" class="btn btn-primary d-flex justify-content-center"><i class="bi bi-cart"></i> Comprar curso</a>
                            </div>
                            
                       
                        </div>
                    </div>
                </div>
        
        `
        )
        $('#miCursoDetalle').show()
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function misDatosContenidoCurso(cursoID) {
    // Mis datos Curso
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataNivelesDeUnCurso',
        Curso_id: cursoID,
      },
      url: 'php/API/Nivel.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miContenido').empty()
        for (let i = 0; i < items.length; i++) {
          $('#miContenido').append(
            `
                                <div class="accordion-item">
                                    <h2 class="verContenidoNivel accordion-header" id="` +
              items[i].Nivel_id +
              `">
                                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-` +
              items[i].Nivel_id +
              `" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                        Nivel ` +
              items[i].noNivel +
              `: ` +
              items[i].nombreNivel +
              `
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-` +
              items[i].Nivel_id +
              `" class="accordion-collapse collapse" aria-labelledby="` +
              items[i].Nivel_id +
              `" data-bs-parent="#miContenido">
                                        <div class="accordion-body">    
                                           <div id="miContenidoMultimedia-` +
              items[i].Nivel_id +
              `">    

                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
          `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function misDatosMultimediaNivel(Nivel_id) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataMultimediaNivel', Nivel_id: Nivel_id },
      url: 'php/API/Multimedia.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $(`#miContenidoMultimedia-` + Nivel_id).empty()
        $(`#miContenidoMultimedia-` + Nivel_id).append(`
             <div class="card">
                              <div class="card-header text-end">          
                    <span class="badge rounded-pill bg-primary">Nivel No Comprado</span>
                    <span class="badge rounded-pill bg-success">Nivel Completado</span>
                    <span class="badge rounded-pill bg-danger">Nivel No Completado</span>
                </div>`)
        for (let i = 0; i < items.length; i++) {
          switch (items[i].tipoMultimedia) {
            case 1:
              $(`#miContenidoMultimedia-` + Nivel_id).append(
                `
             <div class="card mt-2 mb-2">
                <div class="card-body d-flex text-center justify-content-center">
                    <p class="card-text">` +
                  items[i].texto +
                  `</p>
                </div>
            </div>
          `
              )
              break
            case 2:
              $(`#miContenidoMultimedia-` + Nivel_id).append(
                `
             <div class="card mt-2 mb-2">
                 <div class="card-header text-center fw-bold fs-5">          
` +
                  items[i].texto +
                  `
                </div>
                    <div class="image-upload d-flex justify-content-center p-2 ms-3 me-3 mb-4">
                                    <img src="data:image/jpeg;base64,` +
                  items[i].multimedia +
                  `" alt="" width="75%">                                        
                
                </div>
            </div>
          `
              )
              break
            case 3:
              $(`#miContenidoMultimedia-` + Nivel_id).append(
                `
             <div class="card mt-2 mb-2">
                 <div class="card-header text-center fw-bold fs-5">          
` +
                  items[i].texto +
                  `
                </div>
                    <div class="image-upload d-flex justify-content-center p-2 ms-3 me-3 mb-4">
                                 <video controls class="misVideos mx-auto">
                                        <source class="misVideos" src="data:video/mp4;base64,` +
                  items[i].multimedia +
                  `"width="640" height="360" type="video/mp4">
                                 </video>            
                </div>
            </div>
          `
              )
              break
            case 4:
              $(`#miContenidoMultimedia-` + Nivel_id).append(
                `
             <div class="card mt-2 mb-2">
                 <div class="card-header text-center fw-bold fs-5">          
` +
                  items[i].texto +
                  `
                </div>
                    <div class="image-upload d-flex justify-content-center p-2 ms-3 me-3 mb-4">
                                <iframe src="data:application/pdf;base64,` +
                  items[i].multimedia +
                  `" width="100%" height="600px">
                                    <p>Lo sentimos, no se puede mostrar el archivo PDF.</p>
                                </iframe>
                </div>
            </div>
          `
              )
              break
            default:
              break
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function misDatosInstructor(miUsuario_id) {
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataUsuarioInstructor',
        Usuario_id: miUsuario_id,
      },
      url: 'php/API/Usuario.php',
    })
      .done(function (data) {
        if (data == 0) return
        var items = JSON.parse(data)
        $('#Instructor').empty()
        $('#Instructor').append(
          `
            <hr class="solid">
                <h4>Instructor</h4>
                <div class="container">
                    <hr class="solid">
                    <div class="d-flex flex-row pfpInstructor">
                        <div class="p-2"><img src="data:image/jpeg;base64,` +
            items[0].fotoPerfil +
            `" class="rounded-circle">
                        </div>
                        <div class="p-2">
                            <div class="d-flex flex-column">

                                <p class="fs-5 ps-4  fw-bold">` +
            items[0].nombre +
            `</p>

                                <p class="text-muted ps-4  fs-6">` +
            items[0].correo +
            `</p>
                                <hr class="solid">
                                <p class="fs-6 ps-4">` +
            items[0].descripcion +
            `</p>



                            </div>
                            <hr class="solid">
                        </div>

                    </div>
                </div>`
        )
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- VER CONTENIDO CURSO --
  $('#misCursosIndex').on('click', '.verCursoDetalle', funcVerCurso)
  function funcVerCurso() {
    let miIdCurso = $(this).attr('id')
    misDatosCursoDetalle(miIdCurso)
    misDatosContenidoCurso(miIdCurso)
  }

  // -- VER CONTENIDO NIVEL --
  $('#miContenido').on('click', '.verContenidoNivel', funcVerMultimedia)
  function funcVerMultimedia() {
    let Nivel_id = $(this).attr('id')
    misDatosMultimediaNivel(Nivel_id)
  }

  // ----------------------------- ACTUALIZAR DATOS -----------------
  // -- USUARIO --
  $('#EditUser').click(funcActualizarDatosPerfil)
  function funcActualizarDatosPerfil() {
    var file_data = $('#E_userIMG').prop('files')[0]
    var email = $('#E_email').val()
    var usuario = $('#E_usuario').val()
    var names = $('#E_names').val()
    var contrasenia = $('#E_contrasenia').val()
    var descripcion = $('#E_descripcion').val()
    var confirmar_Contrasenia = $('#E_confirmarContrasenia').val()
    var lastNameP = $('#E_lastNameP').val()
    var lastNameM = $('#E_lastNameM').val()
    var genero = $('#E_generoUsuario').val()
    var fechaNacimiento = $('#E_FechaNacimiento').val()

    if (contrasenia != confirmar_Contrasenia) {
      alert('La contraseña no coincide reintenta nuevamente')
      return
    }

    var form_data = new FormData()
    form_data.append('funcion', 'actualizarUser')
    form_data.append('file', file_data)
    form_data.append('email', email)
    form_data.append('usuario', usuario)
    form_data.append('password', contrasenia)
    form_data.append('names', names)
    form_data.append('lastNameP', lastNameP)
    form_data.append('lastNameM', lastNameM)
    form_data.append('fechaNac', fechaNacimiento)
    form_data.append('genero', genero)
    form_data.append('MetodoPago_id', 1)
    form_data.append('descripcion', descripcion)

    $.ajax({
      url: 'php/API/Usuario.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        cargarDatosUser()
        alert('Perfil Actualizado Correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // Inicio de sesión
  $('#ButtonLogIn').click(funcIniciarSesion)
  function funcIniciarSesion() {
    var usuarioCorreo = $('#correoLogin').val()
    var pass = $('#login_password').val()
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
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- REGISTRO DATOS -----------------
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
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
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
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
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
      dataType: 'text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        alert('Registro de instructor correctamente')
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
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }
})

// Funciones de imagenes
let vista_preliminarEdit = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById('E_imgFoto')

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}

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
