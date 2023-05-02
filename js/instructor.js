$(document).ready(function () {
  // OCULTAR
  $('#categoriasCursoSelected').hide()
  $('#nivelesCursoSelected').hide()

  $('#miPDFNivel').hide()
  $('#miImagenNivel').hide()
  $('#miVideoNivel').hide()

  // MI DROPDOWN CURSO CATEGORIA
  $('#miDropdownCursosCategoriasEditar').on(
    'click',
    '.E_CategoriaCurso_li',
    function (event) {
      event.preventDefault()
      $('#E_categoriaCursoEditar').val($(this).text())
      $('#miCategoriaParaCurso').val($(this).attr('id'))
    }
  )

  // -------- MIS BOTONES ------------

  //CURSO
  $('#VerMiCurso').click(function () {
    // Muestro
    $('#editarMiCursoSelected').show()
    // Oculto
    $('#categoriasCursoSelected').hide()
    $('#nivelesCursoSelected').hide()
  })

  //CATEGORIAS
  $('#VerMisCategoriasCurso').click(function () {
    // Muestro
    $('#categoriasCursoSelected').show()
    // Oculto
    $('#editarMiCursoSelected').hide()
    $('#nivelesCursoSelected').hide()
  })

  // NIVELES
  $('#VerMisNivelesCurso').click(function () {
    // Muestro
    $('#nivelesCursoSelected').show()
    // Oculto
    $('#categoriasCursoSelected').hide()
    $('#editarMiCursoSelected').hide()
  })

  // --------  CARGAR INFORMACION --------

  cargarCategoriasInstructor()
  function cargarCategoriasInstructor() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataTodosCategoria' },
      url: 'php/API/Categoria.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#searchCategoria').empty()
        $('#miDropdownCursosCategoriasEditar').empty()
        for (let i = 0; i < items.length; i++) {
          $('#searchCategoria').append(
            `<li><a class="dropdown-item miBusquedaCategoriaInstructor" id="` +
              items[i].Categoria_id +
              `"> ` +
              items[i].nombre +
              `</a></li> `
          )

          $('#miDropdownCursosCategoriasEditar').append(
            `  <li><a class="dropdown-item E_CategoriaCurso_li" id="` +
              items[i].Categoria_id +
              `">` +
              items[i].nombre +
              `</a></li> `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  cargarReporteCurso()
  function cargarReporteCurso() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getReporteInstructor' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miReporteInstructor').empty()
        for (let i = 0; i < items.length; i++) {
          if (items[i].categoriaNombre == null)
            items[i].categoriaNombre = 'Ninguna categoría'

          $('#miReporteInstructor').append(
            `<a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex justify-content-start">
                            <img  src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="mt-2 pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-5 fw-bold">` +
              items[i].cursoNombre +
              `</p>
                                <p class="text-muted fs-6">` +
              items[i].categoriaNombre +
              `</p>
                            </div>
                        </div>
                        <div class="d-flex mt-2 justify-content-end">
                            <div class="d-flex me-4 pt-2 pb-4">
                                <p class="ps-4  text-muted fs-6 fw-light">Alumnos: <b>` +
              items[i].noAlumnos +
              `</b>
                                </p>
                                <p class="ps-4  text-muted fs-6 fw-light">Promedio nivel: <b>` +
              items[i].Promedio +
              `</b>
                                </p>
                                <p class="ps-4  text-muted fs-6 fw-light">Total ingresos: <b>` +
              items[i].Ingresos +
              ` MXN</b>
                                </p>
                            </div>
                            <p class="mb-1 verCursoDetalle" data-bs-toggle="modal" data-bs-target="#miModalCursoDetalle"><button type="button" class="btn btn-success"><i class="bi bi-search"></i></button>
                            </p>
                            <p class="mb-1 editarCurso" id="` +
              items[i].Curso_id +
              `"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalEditarCurso"><i class="bi bi-pen"></i></button>
                            </p>
                            <p class="mb-1"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></p>

                        </div>
                    </div>
                </a> `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  function cargarNivelesCurso(Curso_id) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataNivelesDeUnCurso', Curso_id: Curso_id },
      url: 'php/API/Nivel.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miContenidoCurso').empty()
        for (let i = 0; i < items.length; i++) {
          $('#miContenidoCurso').append(
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
              `" data-bs-parent="#miContenidoCurso">
                                        <div class="accordion-body">
                                           <div id="` +
              items[i].Nivel_id +
              `" class="d-flex justify-content-center mb-2 mp-2">
                                          <span class="badge rounded-pill bg-success" data-bs-toggle="modal" data-bs-target="#miModalNivelAltaMultimedia">Añadir Multimedia</span>
                                           <span id="` +
              items[i].Nivel_id +
              `" class="ms-2 me-2 badge rounded-pill bg-primary editarNivel" data-bs-toggle="modal" data-bs-target="#miModalEditarNivel">Editar Nivel</span>
                                           <span id="` +
              items[i].Nivel_id +
              `" class="badge rounded-pill bg-danger borrarNivel">Borrar Nivel</span>
                                           </div>           
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

  function cargarMultimediaNivel(Nivel_id) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataMultimediaNivel', Nivel_id: Nivel_id },
      url: 'php/API/Multimedia.php',
    })
      .done(function (data) {
        console.log(data)
        var items = JSON.parse(data)
        console.log(items)
        $('#sd').empty()
        for (let i = 0; i < items.length; i++) {
          $('#sd').append(
            `
             <div class="card">
                <div class="card-header text-end">          
                    <span class="badge rounded-pill bg-primary editarMultimedia">Editar</span>
                    <span class="badge rounded-pill bg-danger borrarMultimedia">Borrar</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Introducción</h5>
                    <p class="card-text">¿Qué es HTML y para qué sirve?
                        El Lenguaje de Marcado de Hipertexto (HTML) es el código que se utiliza
                        para
                        estructurar y desplegar una página web y
                        sus contenidos. Por ejemplo, sus contenidos podrían ser párrafos, una
                        lista con
                        viñetas, o imágenes y tablas de datos.</p>

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

  function cargarCategoriasCurso(miIdCurso) {
    // Mis Datos Categorias
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCategoriasDeUnCurso', Curso_id: miIdCurso },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misCategoriasCursoSelectedEditar').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misCategoriasCursoSelectedEditar').append(
            `      <a class="list-group-item list-group-item-action" aria-current="true">
                                <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                    <div class="container">
                                        <div class="d-flex flex-row">
                                            <div class="flex-fill">
                                                <p class="fs-6 pt-2">` +
              items[i].nombre +
              `</p>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <p class="mb-1 pt-2"><button type="button" id="` +
              items[i].CursoCategoria_id +
              `" class="borrarCategoriaCurso btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                     </a> `
          )
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // ONCLICK
  // -- CURSO DASHBOARD --
  $('#miReporteInstructor').on('click', '.editarCurso', funcionGetCurso)
  function funcionGetCurso() {
    // Muestro
    $('#editarMiCursoSelected').show()
    // Oculto
    $('#categoriasCursoSelected').hide()
    $('#nivelesCursoSelected').hide()

    let miIdCurso = $(this).attr('id')
    $('#miCursoSelectedEdit').val(miIdCurso)

    // Mis datos Curso
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCurso', Curso_id: miIdCurso },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        // Imagen
        document.getElementById('miImagenCursoSelected').src =
          'data:image/jpeg;base64,' + items[0].imagenCurso
        document.getElementById('E_img_cursoIMG').src =
          'data:image/jpeg;base64,' + items[0].imagenCurso
        // Mi nombre
        $('#nombreCursoSelected').text(items[0].nombre)
        $('#E_nombreCurso').val(items[0].nombre)
        $('#E_descCurso').val(items[0].descripcion)
        $('#E_costoCurso').val(items[0].costoCurso)
      })
      .fail(function (data) {
        console.error(data)
      })

    cargarCategoriasCurso(miIdCurso)
    cargarNivelesCurso(miIdCurso)
  }

  // -- NIVEL DASHBOARD --
  $('#miContenidoCurso').on('click', '.editarNivel', funcionGetNivel)
  function funcionGetNivel() {
    let miIdNivel = $(this).attr('id')
    $('#miNivelSelected').val(miIdNivel)
    // Mis datos Nivel
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataNivel', Nivel_id: miIdNivel },
      url: 'php/API/Nivel.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#E_nivelName').val(items[0].nombre)
        $('#E_costoNivel').val(items[0].costoNivel)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- MULTIMEDIA DASHBOARD --
  $('#miContenidoCurso').on(
    'click',
    '.verContenidoNivel',
    funcionGetMultimediaNivel
  )
  function funcionGetMultimediaNivel() {
    let miIdNivel = $(this).attr('id')
    cargarMultimediaNivel(miIdNivel)
  }
  // ----------------------------- REGISTRO DATOS -----------------
  // -- CURSO --
  $('#ButtonRegistrarCurso').click(funcRegistrarCurso)
  function funcRegistrarCurso() {
    var form_data = new FormData()
    var file_data = $('#cursoIMG').prop('files')[0]
    var descCurso = $('#descCurso').val()
    var nombreCurso = $('#nombreCurso').val()
    var costoCurso = $('#costoCurso').val()

    form_data.append('funcion', 'insertarCurso')
    form_data.append('file', file_data)
    form_data.append('nombreCurso', nombreCurso)
    form_data.append('descripcionCurso', descCurso)
    form_data.append('costoCurso', costoCurso)

    $.ajax({
      url: 'php/API/Curso.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'Text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#cursoIMG').val('')
        $('#nombreCurso').val('')
        $('#descCurso').val('')
        $('#costoCurso').val('')
        // CARGAR DATOS MODAL EDIT CURSO
        // Imagen
        document.getElementById('miImagenCursoSelected').src =
          'data:image/jpeg;base64,' + items[0].imagenCurso
        // Mi nombre
        $('#nombreCursoSelected').text(items[0].nombre)
        $('#miCursoSelectedEdit').val(items[0].Curso_id)
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // -- CURSO-CATEGORIA --
  $('#ButtonRegistrarCursoCategoria').click(funcRegistrarCursoCategoria)
  function funcRegistrarCursoCategoria() {
    var idCurso = $('#miCursoSelectedEdit').val()
    var idCategoria = $('#miCategoriaParaCurso').val()
    if (
      idCurso == null ||
      idCurso == '' ||
      idCategoria == null ||
      idCategoria == ''
    )
      return

    $.ajax({
      url: 'php/API/Curso.php',
      type: 'POST',
      data: {
        funcion: 'insertarCursoCategoria',
        Curso_id: idCurso,
        Categoria_id: idCategoria,
      },
    })
      .done(function () {
        cargarReporteCurso()
        cargarCategoriasCurso(idCurso)
        alert('Categoria insertada correctamente en el curso')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }
  // -- NIVEL --
  $('#ButtonRegistrarNivel').click(funcRegistrarNivel)
  function funcRegistrarNivel() {
    var nombreNivel = $('#nivelName').val()
    var costoNivel = $('#costoNivel').val()
    var idCurso = $('#miCursoSelectedEdit').val()
    $.ajax({
      url: 'php/API/Nivel.php',
      type: 'POST',
      data: {
        funcion: 'insertarNivel',
        Curso_id: idCurso,
        nombreNivel: nombreNivel,
        costoNivel: costoNivel,
      },
    })
      .done(function (data) {
        var items = JSON.parse(data)
        alert('Nivel insertado correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- ACTUALIZAR DATOS -----------------

  // -- CURSO --
  $('#ButtonActualizarCurso').click(funcActualizarCurso)
  function funcActualizarCurso() {
    var form_data = new FormData()
    var file_data = $('#E_cursoIMG').prop('files')[0]
    var descCurso = $('#E_descCurso').val()
    var nombreCurso = $('#E_nombreCurso').val()
    var costoCurso = $('#E_costoCurso').val()
    var cursoID = $('#miCursoSelectedEdit').val()

    form_data.append('funcion', 'actualizarCurso')
    form_data.append('file', file_data)
    form_data.append('Curso_id', cursoID)
    form_data.append('nombreCurso', nombreCurso)
    form_data.append('descripcionCurso', descCurso)
    form_data.append('costoCurso', costoCurso)

    $.ajax({
      url: 'php/API/Curso.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'Text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function (data) {
        console.log(data)
        alert('Curso Actualizado Correctamente')
        cargarReporteCurso()
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // -- NIVEL --
  $('#ButtonActualizarNivel').click(funcActualizarNivel)
  function funcActualizarNivel() {
    var nombreNivel = $('#E_nivelName').val()
    var costoNivel = $('#E_costoNivel').val()
    var idNivel = $('#miNivelSelected').val()
    var cursoID = $('#miCursoSelectedEdit').val()
    $.ajax({
      url: 'php/API/Nivel.php',
      type: 'POST',
      data: {
        funcion: 'actualizarNivel',
        Nivel_id: idNivel,
        nombreNivel: nombreNivel,
        costoNivel: costoNivel,
      },
    })
      .done(function (data) {
        console.log(data)
        cargarNivelesCurso(cursoID)
        alert('Nivel actualizado correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // ----------------------------- ELIMINAR DATOS -----------------
  $('#misCategoriasCursoSelectedEditar').on(
    'click',
    '.borrarCategoriaCurso',
    funcionBorrarCategoriaCurso
  )
  function funcionBorrarCategoriaCurso() {
    let miIdCursoCategoria = $(this).attr('id')
    var cursoID = $('#miCursoSelectedEdit').val()
    if (confirm('¿Seguro deseas eliminar esta categoria de este curso?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'eliminarCursoCategoria',
          CursoCategoria_id: miIdCursoCategoria,
        },
        url: 'php/API/Curso.php',
      })
        .done(function () {
          cargarReporteCurso()
          cargarCategoriasCurso(cursoID)
          alert('Categoria eliminada correctamente del curso')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }

  // PREVISUALIZACION NIVELES

  function mostrarPDF() {
    //PDF
    $('#miPDFNivel').show()
    $('#miImagenNivel').hide()
    $('#miVideoNivel').hide()
  }
  function mostrarImagen() {
    //IMAGEN
    $('#miImagenNivel').show()
    $('#miPDFNivel').hide()
    $('#miVideoNivel').hide()
  }
  function mostarVideo() {
    //VIDEO
    $('#miVideoNivel').show()
    $('#miPDFNivel').hide()
    $('#miImagenNivel').hide()
  }
  $('#E_MultimediaNivel').change(handleFileSelect)
  function handleFileSelect(event) {
    const file = event.target.files[0]
    const extension = file.name.split('.').pop().toLowerCase()
    switch (extension) {
      case 'pdf':
        if (file.type !== 'application/pdf') {
          alert('PDF no valido')
          return
        }
        const pdfUrl = URL.createObjectURL(file)
        $('#miPDFViewer').attr('src', pdfUrl)
        mostrarPDF()
        break
      case 'jpg':
      case 'jpeg':
        if (file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
          alert('Por favor, seleccione un archivo de imagen JPG o JPEG.')
          return
        }
        const imgUrl = URL.createObjectURL(file)
        $('#miImageViewer').attr('src', imgUrl)
        mostrarImagen()
        break
      case 'mp4':
        if (file.type !== 'video/mp4') {
          alert('Por favor, seleccione un archivo de video MP4.')
          return
        }
        const videoUrl = URL.createObjectURL(file)
        $('#miVideoViewer').attr('src', videoUrl)
        mostarVideo()
        break
    }
  }
})

// Funciones de imagenes
let vista_preliminarCurso = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById('img_cursoIMG')

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}

let vista_preliminarEditarCurso = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById('E_img_cursoIMG')

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}
