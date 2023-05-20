$(document).ready(function () {
  // OCULTAR
  $('#categoriasCursoSelected').hide()
  $('#nivelesCursoSelected').hide()

  $('#miPDFNivel').hide()
  $('#miImagenNivel').hide()
  $('#miVideoNivel').hide()

  $('#E_miPDFNivel').hide()
  $('#E_miImagenNivel').hide()
  $('#E_miVideoNivel').hide()
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
        if (items.length == 0) {
          $('#miReporteInstructor').append(`
                          <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos en progreso</h4>
                            <p class="text-center">Da de alta un nuevo curso</p>
                            <hr>               
                        </div>`)
          return
        }
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
                                <p class="fs-5">` +
              items[i].cursoNombre +
              `</p>
                                <p class="text-muted fs-6">` +
              items[i].categoriaNombre +
              `</p>
                            </div>
                        </div>
                        <div class="d-flex mt-2 justify-content-end">
                            <div class="d-flex me-4 pt-2 pb-4">
                                <p class="ps-4  text-muted fs-6 fw-light">Núm. Niveles: <b>` +
              items[i].noNiveles +
              `</b>
                                </p>
                                <p class="ps-4  text-muted fs-6 fw-light">Costo Curso: <b>` +
              items[i].costoCurso +
              ` MXN</b>
                                </p>
                            </div>
                            <p class="mb-1 me-1 aprobarCurso" id="` +
              items[i].Curso_id +
              `"><button type="button" class="btn btn-success"><i class="bi bi-check2-square"></i></button>
                            </p>
                            <p class="mb-1 me-1 editarCurso" id="` +
              items[i].Curso_id +
              `"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalEditarCurso"><i class="bi bi-pen"></i></button>
                            </p>
                            <p class="mb-1 borrarCurso" id="` +
              items[i].Curso_id +
              `"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></p>

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

  cargarReporteCursoBaja()
  function cargarReporteCursoBaja() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getReporteInstructorBaja' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miReporteInstructorBaja').empty()
        if (items.length == 0) {
          $('#miReporteInstructorBaja').append(`
                               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos dados de baja</h4>
                            <p class="text-center">Puedes dar de baja cursos que ya hayas aprobado previamente.</p>
                            <hr>               
                        </div>`)
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].categoriaNombre == null)
            items[i].categoriaNombre = 'Ninguna categoría'

          $('#miReporteInstructorBaja').append(
            `<a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex justify-content-start">
                            <img  src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="mt-2 pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-5">` +
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
                         
                            <p class="mb-1 verCursoDetalle" id="` +
              items[i].Curso_id +
              `" data-bs-toggle="modal" data-bs-target="#miModalCursoDetalle"><button type="button" class="btn btn-success"><i class="bi bi-search"></i></button>
                            </p>
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

  cargarReporteCursoAprobados()
  function cargarReporteCursoAprobados() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getReporteInstructorAprobados' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miReporteInstructorAprobados').empty()
        if (items.length == 0) {
          $('#miReporteInstructorAprobados').append(`
                               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos aprobados</h4>
                            <p class="text-center">Puedes aprobar cursos desde la página del instructor</p>
                            <hr>               
                        </div>`)
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].categoriaNombre == null)
            items[i].categoriaNombre = 'Ninguna categoría'

          $('#miReporteInstructorAprobados').append(
            `<a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex justify-content-start">
                            <img  src="data:image/jpeg;base64,` +
              items[i].imagenCurso +
              `" class="mt-2 pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-5">` +
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
                         
                            <p class="mb-1 verCursoDetalle" id="` +
              items[i].Curso_id +
              `" data-bs-toggle="modal" data-bs-target="#miModalCursoDetalle"><button type="button" class="btn btn-success"><i class="bi bi-search"></i></button>
                            </p>
                               <p class="mb-1 ps-1 borrarCurso" id="` +
              items[i].Curso_id +
              `"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></p>
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

  cargarIngresosMetodosPago()
  function cargarIngresosMetodosPago() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getReporteIngresosMetodo' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misMetodosPago').empty()
        for (let i = 0; i < items.length; i++) {
          $('#misMetodosPago').append(
            `
           <a class="list-group-item list-group-item-action" aria-current="true">
                        <div class="misMetodosImgs d-flex w-100 justify-content-between">
                            <div class="d-flex flex-fill">
                                <img  src="data:image/jpeg;base64,` +
              items[i].imagenMetodo +
              `">
                                <p class="fs-5 p-3 fw-bold align-middle">` +
              items[i].nombreMetodo +
              `</p>

                            </div>
                            <p class="fs-6 p-3 fw-bold align-middle">` +
              items[i].totalIngresos +
              `MXN</p>
                        </div>


                    </a>

          `
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
                                          <span class="badge rounded-pill bg-success añadirMultimedia" id="` +
              items[i].Nivel_id +
              `" data-bs-toggle="modal" data-bs-target="#miModalNivelAltaMultimedia">Añadir Multimedia</span>
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
        var items = JSON.parse(data)
        $(`#miContenidoMultimedia-` + Nivel_id).empty()
        for (let i = 0; i < items.length; i++) {
          switch (items[i].tipoMultimedia) {
            case 1:
              $(`#miContenidoMultimedia-` + Nivel_id).append(
                `
             <div class="card">
                <div class="card-header text-end">          
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-primary editarMultimedia" data-bs-toggle="modal" data-bs-target="#miModalNivelEditarMultimedia">Editar</span>
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-danger borrarMultimedia">Borrar</span>
                </div>
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
             <div class="card">
                <div class="card-header text-end">          
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-primary editarMultimedia" data-bs-toggle="modal" data-bs-target="#miModalNivelEditarMultimedia">Editar</span>
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-danger borrarMultimedia">Borrar</span>
                </div>
                   <div class="card-body d-flex fw-bold fs-5 text-center justify-content-center">
                    <p class="card-text">` +
                  items[i].texto +
                  `</p>
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
             <div class="card">
                <div class="card-header text-end">          
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-primary editarMultimedia" data-bs-toggle="modal" data-bs-target="#miModalNivelEditarMultimedia">Editar</span>
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-danger borrarMultimedia">Borrar</span>
                </div>
                   <div class="card-body d-flex fw-bold fs-5 text-center justify-content-center">
                    <p class="card-text">` +
                  items[i].texto +
                  `</p>
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
             <div class="card">
                <div class="card-header text-end">          
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-primary editarMultimedia" data-bs-toggle="modal" data-bs-target="#miModalNivelEditarMultimedia">Editar</span>
                    <span id="` +
                  items[i].Multimedia_id +
                  `" class="badge rounded-pill bg-danger borrarMultimedia">Borrar</span>
                </div>
                   <div class="card-body d-flex fw-bold fs-5 text-center justify-content-center">
                    <p class="card-text">` +
                  items[i].texto +
                  `</p>
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

  function cargarCategoriasCurso(Curso_id) {
    // Mis Datos Categorias
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCategoriasDeUnCurso', Curso_id: Curso_id },
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

  function verReporteCursoDetallado(Curso_id) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getReporteDetalleCursoInstructor', Curso_id: Curso_id },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        $('#miCursoDetalleLista').empty()
        var items = JSON.parse(data)
        if (items.length == 0) {
          $('#miCursoDetalleLista').append(
            `
              <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">No hay estudiantes inscritos</h4>
                            <p class="text-center">Aqui veras el reporte de tus estudiantes en este curso</p>
                            <hr>               
                        </div>
          `
          )
          return
        }
        let miTotal = 0
        for (let i = 0; i < items.length; i++) {
          miTotal += parseFloat(items[i].totalPagado)
          $('#miCursoDetalleLista').append(
            `
            <a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                            <div class="d-flex flex-row miImagen justify-content-between">
                                <div class="d-flex pt-1">
                                    <img src="data:image/jpeg;base64,` +
              items[i].fotoPerfil +
              `" class="pfp rounded-circle">
                                    <div class="p-1 d-flex flex-column">
                                        <p class="fs-6 fw-bold">` +
              items[i].Alumno +
              `</p>
                                        <p class="text-muted fs-6">` +
              items[i].tiempoRegistro +
              `
                                    </div>
                                    <div class="ps-4 d-flex justify-content-end">
                                        </p>
                                        <p class="ps-4 pt-4 text-muted fs-6 fw-light">Avance: <b>` +
              items[i].Progreso +
              `</b>
                                        </p>
                                        <p class="ps-4 pt-4 text-muted fs-6 fw-light">Pagó: <b>` +
              items[i].totalPagado +
              ` MXN</b>
                                        </p>
                                        <p class="ps-4 pt-4  text-muted fs-6 fw-light">Forma de Pago: <b>` +
              items[i].nombreMetodo +
              `</b>
                                        </p>
                                    </div>
                                </div>

                            </div>
                  </a>
          `
          )
        }
        $('#nombreCursoEnModalCursoDetalle').text(items[0].nombre)
        document.getElementById('miFotoEnCursoDetalleModal').src =
          'data:image/jpeg;base64,' + items[0].imagenCurso
        $('#miCursoDetalleLista').append(
          `
                      <div class="d-flex flex-row justify-content-between">
                            <div class="fs-5 fw-bold p-2">Total</div>
                            <div class="fs-5 fw-bold p-2">` +
            miTotal +
            ` MXN</div>
                        </div>
          `
        )
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
        $('#nombreCursoSelected').text(items[0].cursoNombre)
        $('#E_nombreCurso').val(items[0].cursoNombre)
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

  // -- VER REPORTE CURSO DETALLE --
  $('#miReporteInstructorAprobados').on(
    'click',
    '.verCursoDetalle',
    funcVerReporteCursoDetalle
  )
  $('#miReporteInstructorBaja').on(
    'click',
    '.verCursoDetalle',
    funcVerReporteCursoDetalle
  )
  function funcVerReporteCursoDetalle() {
    let Curso_id = $(this).attr('id')
    verReporteCursoDetallado(Curso_id)
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

  // -- MULTIMEDIA -> AÑADIR MULTIMEDIA  --
  $('#miContenidoCurso').on(
    'click',
    '.añadirMultimedia',
    funcSendIdNivelMultimedia
  )
  function funcSendIdNivelMultimedia() {
    let miIdNivel = $(this).attr('id')
    $('#miNivelSeleccionado').val(miIdNivel)
  }

  // -- MULTIMEDIA -> EDITAR MULTIMEDIA  --
  $('#miContenidoCurso').on('click', '.editarMultimedia', funcEditarMultimedia)
  function funcEditarMultimedia() {
    let miIdMultimedia = $(this).attr('id')
    $('#miMultimediaSeleccionada').val(miIdMultimedia)
    // Mis datos Multimedia
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerDataMultimedia', Multimedia_id: miIdMultimedia },
      url: 'php/API/Multimedia.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#E_miTipoMultimedia').val(items[0].tipoMultimedia)
        $('#E_TextoNivel').val(items[0].texto)
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- DAR DE BAJA CURSO  --
  $('#miReporteInstructor').on('click', '.borrarCurso', funcDarBajaCurso)
  $('#miReporteInstructorAprobados').on(
    'click',
    '.borrarCurso',
    funcDarBajaCurso
  )
  function funcDarBajaCurso() {
    let idCurso = $(this).attr('id')
    if (confirm('¿Seguro que quieres dar de baja este curso?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'bajaCurso',
          Curso_id: idCurso,
        },
        url: 'php/API/Curso.php',
      })
        .done(function () {
          cargarReporteCurso()
          cargarReporteCursoAprobados()
          alert('Curso dado de baja exitosamente')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }

  // -- APROBAR CURSO  --
  $('#miReporteInstructor').on('click', '.aprobarCurso', funcAprobarCurso)
  function funcAprobarCurso() {
    let idCurso = $(this).attr('id')
    if (confirm('¿Seguro que quieres aprobar este curso?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'aprobarCurso',
          Curso_id: idCurso,
        },
        url: 'php/API/Curso.php',
      })
        .done(function () {
          cargarReporteCurso()
          cargarReporteCursoAprobados()
          alert('Curso aprobado exitosamente')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }

  // ----------------------------- REGISTRO DATOS -----------------
  // -- CURSO --
  $('#ButtonRegistrarCurso').click(funcRegistrarCurso)
  function funcRegistrarCurso() {
    var file_data = $('#cursoIMG').prop('files')[0]
    var descCurso = $('#descCurso').val()
    var nombreCurso = $('#nombreCurso').val()
    var costoCurso = $('#costoCurso').val()

    if (!file_data) {
      alert('Favor de cargar la imagen')
      return
    }
    if (nombreCurso == '' || costoCurso == '' || descCurso == '') {
      alert('Faltan llenar Campos')
      return
    }

    var form_data = new FormData()
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
    if (idCurso == '' || idCategoria == '') return

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

    if (nombreNivel == '' || costoNivel == '' || idCurso == '') {
      alert('Faltan llenar Campos')
      return
    }

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
        $('#nivelName').val('')
        $('#costoNivel').val('')
        var items = JSON.parse(data)
        var Nivel_id = items[0].Nivel_id
        var Curso_id = items[0].Curso_id
        $('#miNivelSeleccionado').val(Nivel_id)
        cargarNivelesCurso(Curso_id)
        alert('Nivel insertado correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // -- MULTIMEDIA --
  $('#ButtonRegistrarMultimedia').click(funcRegistrarMultimedia)
  function funcRegistrarMultimedia() {
    var file_data = $('#miMultimediaNivelModal').prop('files')[0]
    var texto = $('#TextoNivel').val()
    var Nivel_id = $('#miNivelSeleccionado').val()
    var tipoMultimedia = $('#miTipoMultimedia').val()

    if (!file_data && texto == '') {
      alert('Porfavor carga multimedia o escribe un texto')
      return
    }

    var form_data = new FormData()
    form_data.append('funcion', 'registrarMultimedia')
    form_data.append('file', file_data)
    form_data.append('Nivel_id', Nivel_id)
    form_data.append('Texto', texto)
    form_data.append('tipoMultimedia', tipoMultimedia)

    $.ajax({
      url: 'php/API/Multimedia.php',
      type: 'POST',
      cache: false,
      contentType: false,
      data: form_data,
      dataType: 'Text',
      enctype: 'multipart/form-data',
      processData: false,
    })
      .done(function () {
        alert('Registro de multimedia correctamente')
        $('#miMultimediaNivelModal').val('')
        $('#TextoNivel').val('')
        $('#miNivelSeleccionado').val('')
        $('#miTipoMultimedia').val('')
        cargarMultimediaNivel(Nivel_id)
        mostrarNada()
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
    var file_data = $('#E_cursoIMG').prop('files')[0]
    var descCurso = $('#E_descCurso').val()
    var nombreCurso = $('#E_nombreCurso').val()
    var costoCurso = $('#E_costoCurso').val()
    var cursoID = $('#miCursoSelectedEdit').val()

    if (!file_data) {
      alert('Favor de cargar la imagen')
      return
    }
    if (
      nombreCurso == '' ||
      costoCurso == '' ||
      descCurso == '' ||
      cursoID == ''
    ) {
      alert('Faltan llenar Campos')
      return
    }

    var form_data = new FormData()
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
      .done(function () {
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

    if (
      nombreNivel == '' ||
      costoNivel == '' ||
      idNivel == '' ||
      cursoID == ''
    ) {
      alert('Faltan llenar Campos')
      return
    }
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
      .done(function () {
        cargarNivelesCurso(cursoID)
        alert('Nivel actualizado correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }

  // -- MULTIMEDIA --
  $('#ButtonActualizarMultimedia').click(funcActualizarMultimedia)
  function funcActualizarMultimedia() {
    var multimediaId = $('#miMultimediaSeleccionada').val()
    var file_data = $('#E_miMultimediaNivelModal').prop('files')[0]
    var texto = $('#E_TextoNivel').val()
    var tipoMultimedia = $('#E_miTipoMultimedia').val()

    if (!file_data && texto == '') {
      alert('Porfavor carga multimedia o escribe un texto')
      return
    }
    var form_data = new FormData()
    form_data.append('funcion', 'actualizarMultimedia')
    form_data.append('file', file_data)
    form_data.append('Multimedia_id', multimediaId)
    form_data.append('Texto', texto)
    form_data.append('tipoMultimedia', tipoMultimedia)
    $.ajax({
      url: 'php/API/Multimedia.php',
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
        cargarMultimediaNivel(items[0].Nivel_id)
        alert('Multimedia actualizada correctamente')
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error: ' + errorThrown)
      })
  }
  // ----------------------------- ELIMINAR DATOS -----------------

  // -- CURSO-CATEGORIA --
  $('#misCategoriasCursoSelectedEditar').on(
    'click',
    '.borrarCategoriaCurso',
    funcionBorrarCategoriaCurso
  )
  function funcionBorrarCategoriaCurso() {
    var miIdCursoCategoria = $(this).attr('id')
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

  // -- NIVEL --
  $('#miContenidoCurso').on('click', '.borrarNivel', funcBorrarNivel)
  function funcBorrarNivel() {
    var miIdNivel = $(this).attr('id')
    var cursoID = $('#miCursoSelectedEdit').val()
    if (confirm('¿Seguro deseas eliminar este Nivel de este curso?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'eliminarNivel',
          Nivel_id: miIdNivel,
        },
        url: 'php/API/Nivel.php',
      })
        .done(function () {
          cargarNivelesCurso(cursoID)
          alert('Nivel eliminado correctamente del curso')
        })
        .fail(function (data) {
          console.error(data)
        })
    }
  }

  // -- MULTIMEDIA --
  $('#miContenidoCurso').on('click', '.borrarMultimedia', funcBorrarMultimedia)
  function funcBorrarMultimedia() {
    var miIdMultimedia = $(this).attr('id')
    if (confirm('¿Seguro deseas eliminar esta Multimedia?')) {
      $.ajax({
        type: 'POST',
        data: {
          funcion: 'eliminarMultimedia',
          Multimedia_id: miIdMultimedia,
        },
        url: 'php/API/Multimedia.php',
      })
        .done(function (data) {
          var items = JSON.parse(data)
          cargarMultimediaNivel(items[0].Nivel_id)
          alert('Multimedia eliminada correctamente del curso')
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
  function mostrarNada() {
    $('#miPDFNivel').hide()
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
  function mostrarPDFEditar() {
    //PDF
    $('#E_miPDFNivel').show()
    $('#E_miImagenNivel').hide()
    $('#E_miVideoNivel').hide()
  }
  function mostrarImagenEditar() {
    //IMAGEN
    $('#E_miImagenNivel').show()
    $('#E_miPDFNivel').hide()
    $('#E_miVideoNivel').hide()
  }
  function mostarVideoEditar() {
    //VIDEO
    $('#E_miVideoNivel').show()
    $('#E_miPDFNivel').hide()
    $('#E_miImagenNivel').hide()
  }
  $('#miMultimediaNivelModal').change(handleFileSelectAlta)
  function handleFileSelectAlta(event) {
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
        $('#miTipoMultimedia').val(4)
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
        $('#miTipoMultimedia').val(2)
        mostrarImagen()
        break
      case 'mp4':
        if (file.type !== 'video/mp4') {
          alert('Por favor, seleccione un archivo de video MP4.')
          return
        }
        const videoUrl = URL.createObjectURL(file)
        $('#miVideoViewer').attr('src', videoUrl)
        $('#miTipoMultimedia').val(3)
        mostarVideo()
        break
    }
  }
  $('#E_miMultimediaNivelModal').change(handleFileSelect)
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
        $('#E_miPDFViewer').attr('src', pdfUrl)
        $('#E_miTipoMultimedia').val(4)
        mostrarPDFEditar()
        break
      case 'jpg':
      case 'jpeg':
        if (file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
          alert('Por favor, seleccione un archivo de imagen JPG o JPEG.')
          return
        }
        const imgUrl = URL.createObjectURL(file)
        $('#E_miImageViewer').attr('src', imgUrl)
        $('#E_miTipoMultimedia').val(2)
        mostrarImagenEditar()
        break
      case 'mp4':
        if (file.type !== 'video/mp4') {
          alert('Por favor, seleccione un archivo de video MP4.')
          return
        }
        const videoUrl = URL.createObjectURL(file)
        $('#E_miVideoViewer').attr('src', videoUrl)
        $('#E_miTipoMultimedia').val(3)
        mostarVideoEditar()
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
