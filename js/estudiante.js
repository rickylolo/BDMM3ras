$(document).ready(function () {
  $('#miKardex').hide()

  cargarCursosEstudiante()
  function cargarCursosEstudiante() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCursosDeUnUsuario' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)

        if (items.length == 0) {
          $('#miAlertaCursosEstudiante').empty()
          $('#miAlertaCursosEstudiante').append(
            `
                             <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos comprados</h4>
                            <p class="text-center">Puedes comprar cursos en la página de inicio</p>
                            <hr>    
                            <div class="d-flex justify-content-center">           
                            <a class="btn btn-primary" href="index.php">Ir a Inicio</a>
                            </div>
                        </div>
            `
          )
          return
        }
        $('#miContenidoCursosEstudiante').empty()
        for (let i = 0; i < items.length; i++) {
          $('#miContenidoCursosEstudiante').append(
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

  cargarKardex()
  function cargarKardex() {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getKardex' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misElementosKardex').empty()
        $('#miTotalDeCursosResultados').text('Total de cursos: ' + items.length)
        if (items.length == 0) {
          $('#misElementosKardex').append(
            `
               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos</h4>
                            <p class="text-center">No te haz inscrito a ningun curso</p>
                            <hr>    
                    
                        </div>
          `
          )
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].tiempoCompletado != null) {
            $('#misElementosKardex').append(
              `
                         <a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex w-100 justify-content-between miImagen">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp mt-1">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            </div>
                    
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
  </p>
                  <div class="p-1 ps-4 d-flex flex-column">
                                <p class="text-muted fs-6 fw-light">Fecha ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                </p>
                                                                <p class="text-muted fs-6 fw-light">Fecha finalizado: <b>` +
                items[i].tiempoCompletado +
                `</b>
                                </p>
                                
                            </div>

                             <div class="d-flex pt-2"> 
                                <p class="mb-1 pe-1"><button type="button" id="` +
                items[i].Curso_id +
                `" class="btn btn-primary escribirComentario"><i class="bi bi-pencil-square"></i></button>
                            </p>
                            <p class="mb-1" data-bs-toggle="modal" data-bs-target="#miModalDiploma"><button type="button" class="btn btn-success verDiploma" id="` +
                items[i].Curso_id +
                `"><i
                                        class="bi bi-bookmark-star-fill"></i></button>
                            </p>
                            </div>

                   
                      
                     
                       
                    </div>
                </a>`
            )
          } else {
            $('#misElementosKardex').append(
              `
                   <a href="" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>No Completado</b>
                                </p>
                                             
                            </div>
                        </div>
                       
                    </div>
                </a>
            `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // FILTROS KARDEX
  $('#verKardexTodos').click(cargarKardex)
  $('#verKardexTerminados').click(function () {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getKardexTerminados' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misElementosKardex').empty()
        $('#miTotalDeCursosResultados').text('Total de cursos: ' + items.length)
        if (items.length == 0) {
          $('#misElementosKardex').append(
            `
               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos con este filtro</h4>
                            <p class="text-center">Intenta aplicando otro filtro de búsqueda</p>
                            <hr>    
                    
                        </div>
          `
          )
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].tiempoCompletado != null) {
            $('#misElementosKardex').append(
              `
                         <a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex w-100 justify-content-between miImagen">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp mt-1">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            </div>
                    
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
  </p>
                  <div class="p-1 ps-4 d-flex flex-column">
                                <p class="text-muted fs-6 fw-light">Fecha ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                </p>
                                                                <p class="text-muted fs-6 fw-light">Fecha finalizado: <b>` +
                items[i].tiempoCompletado +
                `</b>
                                </p>
                                
                            </div>

                             <div class="d-flex pt-2"> 
                                <p class="mb-1 pe-1"><button type="button" id="` +
                items[i].Curso_id +
                `" class="btn btn-primary escribirComentario"><i class="bi bi-pencil-square"></i></button>
                            </p>
                            <p class="mb-1" data-bs-toggle="modal" data-bs-target="#miModalDiploma"><button type="button" class="btn btn-success verDiploma" id="` +
                items[i].Curso_id +
                `"><i
                                        class="bi bi-bookmark-star-fill"></i></button>
                            </p>
                            </div>

                   
                      
                     
                       
                    </div>
                </a>`
            )
          } else {
            $('#misElementosKardex').append(
              `
                   <a href="" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>No Completado</b>
                                </p>
                                             
                            </div>
                        </div>
                       
                    </div>
                </a>
            `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  })
  $('#verKardexActivos').click(function () {
    $.ajax({
      type: 'POST',
      data: { funcion: 'getKardexActivos' },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miTotalDeCursosResultados').text('Total de cursos: ' + items.length)
        $('#misElementosKardex').empty()
        if (items.length == 0) {
          $('#misElementosKardex').append(
            `
               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos con este filtro</h4>
                            <p class="text-center">Intenta aplicando otro filtro de búsqueda</p>
                            <hr>    
                    
                        </div>
          `
          )
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].tiempoCompletado != null) {
            $('#misElementosKardex').append(
              `
                         <a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex w-100 justify-content-between miImagen">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp mt-1">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            </div>
                    
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
  </p>
                  <div class="p-1 ps-4 d-flex flex-column">
                                <p class="text-muted fs-6 fw-light">Fecha ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                </p>
                                                                <p class="text-muted fs-6 fw-light">Fecha finalizado: <b>` +
                items[i].tiempoCompletado +
                `</b>
                                </p>
                                
                            </div>

                             <div class="d-flex pt-2"> 
                                <p class="mb-1 pe-1"><button type="button" id="` +
                items[i].Curso_id +
                `" class="btn btn-primary escribirComentario"><i class="bi bi-pencil-square"></i></button>
                            </p>
                            <p class="mb-1" data-bs-toggle="modal" data-bs-target="#miModalDiploma"><button type="button" class="btn btn-success verDiploma" id="` +
                items[i].Curso_id +
                `"><i
                                        class="bi bi-bookmark-star-fill"></i></button>
                            </p>
                            </div>

                   
                      
                     
                       
                    </div>
                </a>`
            )
          } else {
            $('#misElementosKardex').append(
              `
                   <a href="" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>No Completado</b>
                                </p>
                                             
                            </div>
                        </div>
                       
                    </div>
                </a>
            `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  })
  $('#BuscarSearchKardex').click(function () {
    let textoSearch = $('#miTextoSearchKardex').val()
    $.ajax({
      type: 'POST',
      data: { funcion: 'getKardexSearch', texto: textoSearch },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#miTotalDeCursosResultados').text('Total de cursos: ' + items.length)
        $('#misElementosKardex').empty()
        if (items.length == 0) {
          $('#misElementosKardex').append(
            `
               <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading text-center">No hay cursos con este filtro</h4>
                            <p class="text-center">Intenta aplicando otro filtro de búsqueda</p>
                            <hr>            
               </div>
          `
          )
          return
        }
        for (let i = 0; i < items.length; i++) {
          if (items[i].tiempoCompletado != null) {
            $('#misElementosKardex').append(
              `
                         <a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex w-100 justify-content-between miImagen">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp mt-1">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            </div>
                    
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
  </p>
                  <div class="p-1 ps-4 d-flex flex-column">
                                <p class="text-muted fs-6 fw-light">Fecha ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                </p>
                                                                <p class="text-muted fs-6 fw-light">Fecha finalizado: <b>` +
                items[i].tiempoCompletado +
                `</b>
                                </p>
                                
                            </div>

                             <div class="d-flex pt-2"> 
                                <p class="mb-1 pe-1"><button type="button" id="` +
                items[i].Curso_id +
                `" class="btn btn-primary escribirComentario"><i class="bi bi-pencil-square"></i></button>
                            </p>
                            <p class="mb-1" data-bs-toggle="modal" data-bs-target="#miModalDiploma"><button type="button" class="btn btn-success verDiploma" id="` +
                items[i].Curso_id +
                `"><i
                                        class="bi bi-bookmark-star-fill"></i></button>
                            </p>
                            </div>

                   
                      
                     
                       
                    </div>
                </a>`
            )
          } else {
            $('#misElementosKardex').append(
              `
                   <a href="" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex">
                            <img src="data:image/jpeg;base64,` +
                items[i].imagenCurso +
                `" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">` +
                items[i].nombreCurso +
                `</p>
                                <p class="text-muted fs-6 fw-light">` +
                items[i].nombreCategoria +
                `</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>` +
                items[i].Progreso +
                `</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>` +
                items[i].tiempoRegistro +
                `</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>` +
                items[i].ultimoNivel +
                `</b>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>No Completado</b>
                                </p>
                                             
                            </div>
                        </div>
                       
                    </div>
                </a>
            `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  })

  // --- DETALLES CURSO ---
  function misDatosCursoDetalle(cursoID) {
    $.ajax({
      type: 'POST',
      data: { funcion: 'obtenerCurso', Curso_id: cursoID },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        misDatosInstructor(items[0].Usuario_id)
        $('#miCursoSeleccionadoMensajes').val(items[0].Curso_id)
        $('#cursoPagoDetalle').val(items[0].Curso_id)
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

                            <p class="text-muted fs-6 p-4">` +
            items[0].descripcion +
            `</p>
                            <div class="mt-auto">
                              <div class="fw-bold pb-2 pt-4">
                            </div>
                            
                       
                        </div>
                    </div>
                </div>
        
        `
        )
        $('#miContenidoDetalle').empty()
        $('#miContenidoDetalle').append(
          `
                            <div class="d-flex justify-content-start">
                                <div class="p-2"><img class="rounded" src="data:image/jpeg;base64,` +
            items[0].imagenCurso +
            `" width="200px" height="200px"></div>
                                <div class="d-flex flex-column">
                                    <div class="ps-2 pb-2 fs-4 fw-bold">` +
            items[0].cursoNombre +
            `</div>
                                    <div class="ps-4 fs-6">` +
            items[0].descripcion +
            `</div>
                                </div>
                            </div>
                            <hr class="solid">
        
        `
        )

        $('#miCursoDetalle').show()
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // --- CONTENIDO NIVELES DE MI CURSO ---
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
          if (!(items[i].isComprado == 0)) {
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
                                               <div class="d-flex justify-content-end p-2"> <button id="` +
                items[i].Nivel_id +
                `" class="btn btn-primary finalizarNivel">Marcar como finalizado</button></div>
                                            </div>
                                        </div>
                                    </div>
    
                                    
              `
            )
          } else {
            $('#miContenido').append(
              `
            <div class="accordion-item">
            <h2 class="accordion-header" id="` +
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
                <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">No has comprado este nivel</h4>
                <p class="text-start">Puedes comprar el nivel en la pagina de inicio</p>
                <p class="text-end">Costo del nivel: ` +
                items[i].costoNivel +
                `</p>
                <hr>       
                <div id=" ` +
                items[i].Curso_id +
                `">        
                <a class="btn btn-primary" href="index.php" id="` +
                items[i].Nivel_id +
                `">Inicio</a>
                  </div>
            </div>
                </div>
            </div>
        </div>

        
        
          `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- MIS VALORACIONES CURSO --
  function misComentariosCurso(cursoID) {
    // Mis Comentarios Curso
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataComentariosCurso',
        Curso_id: cursoID,
      },
      url: 'php/API/Comentario.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        $('#misValoraciones').empty()
        for (let i = 0; i < items.length; i++) {
          if (items[i].isLike == 1) {
            $('#misValoraciones').append(
              `
                 <a class="list-group-item list-group-item-action pb-2" aria-current="true">
                        <div class="miImagen misMensajes d-flex w-100 justify-content-between">

                            <div class="d-flex">
                                <img src="data:image/jpeg;base64,` +
                items[i].fotoPerfil +
                `" class="pfp rounded-circle">
                                <div class="align-self-center">
                                    <p class="fs-5 ps-2 pt-1 fw-bold align-middle">` +
                items[i].nombreUsuario +
                `</p>
                                </div>
                            </div>
                            <div class="align-self-start">
                                <span class="badge rounded-pill bg-success">Recomendado</span>
                            </div>
                        </div>
                        <hr class="solid">
                        <p class="mb-1">` +
                items[i].texto +
                `</p>

                    </a>
              `
            )
          }
          if (items[i].isLike == 0) {
            $('#misValoraciones').append(
              `
                              <a class="list-group-item list-group-item-action pb-2" aria-current="true">
                        <div class="miImagen misMensajes d-flex w-100 justify-content-between">

                            <div class="d-flex">
                                <img src="data:image/jpeg;base64,` +
                items[i].fotoPerfil +
                `" class="pfp rounded-circle">
                                <div class="align-self-center">
                                    <p class="fs-5 ps-2 pt-1 fw-bold align-middle">` +
                items[i].nombreUsuario +
                `</p>
                                </div>
                            </div>
                            <div class="align-self-start">
                                <span class="badge rounded-pill bg-danger">No Recomendado</span>
                            </div>
                        </div>
                        <hr class="solid">
                        <p class="mb-1">` +
                items[i].texto +
                `</p>

                    </a>
              `
            )
          }
        }
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // --- DATOS DE MI INSTRUCTOR ---
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
                                <div class="d-flex justify-content-between">
                                <p class="fs-5 ps-4  fw-bold">` +
            items[0].nombre +
            `</p> 
                                <button class="btn btn-primary enviarMensajeInstructor" id="` +
            items[0].Usuario_id +
            `" data-bs-toggle="modal" data-bs-target="#miModalMensaje"><i class="bi bi-chat"></i> Enviar Mensaje</button>
                                </div>
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
  $('#miContenidoCursosEstudiante').on(
    'click',
    '.verCursoDetalle',
    funcVerCurso
  )
  function funcVerCurso() {
    let miIdCurso = $(this).attr('id')
    misDatosCursoDetalle(miIdCurso)
    misDatosContenidoCurso(miIdCurso)
    misComentariosCurso(miIdCurso)
  }

  // -- MARCAR NIVEL COMO FINALIZADO --
  $('#miContenido').on('click', '.finalizarNivel', funcFinalizarNivel)
  function funcFinalizarNivel() {
    let miIdNivel = $(this).attr('id')
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'marcarNivelFinalizado',
        Nivel_id: miIdNivel,
      },
      url: 'php/API/Nivel.php',
    })
      .done(function (data) {
        console.log(data)
        alert('Nivel Finalizado Correctamente')
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- ESCRIBIR COMENTARIO PASAR ID Y ABRIR MODAL --
  $('#misElementosKardex').on(
    'click',
    '.escribirComentario',
    funcEscribirComentario
  )
  function funcEscribirComentario() {
    let miCurso = $(this).attr('id')
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'obtenerDataComentariosEstudiante',
        Curso_id: miCurso,
      },
      url: 'php/API/Comentario.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        if (items.length != 0) {
          alert('No se puede registrar mas de un comentario por curso')
          return
        }
        $('#miCursoSeleccionadoComentario').val(miCurso)
        $('#miModalComentario').modal('show')
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -- GET DIPLOMA --
  $('#misElementosKardex').on('click', '.verDiploma', funcVerDiploma)
  function funcVerDiploma() {
    let miCurso = $(this).attr('id')
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'getDiploma',
        Curso_id: miCurso,
      },
      url: 'php/API/Curso.php',
    })
      .done(function (data) {
        var items = JSON.parse(data)
        if (items.length == 0) {
          alert('Error no se obtuvo diploma')
          return
        }
        $('#miDiploma').empty()
        $('#miDiploma').append(
          `
                            <div class="logo">
                                <img src="img/cripto.png" width="40px">
                                CryptCourse
                            </div>

                            <div class="marquee">
                                Certificado
                            </div>

                            <div class="assignment">
                                Se le presenta el siguiente certificado a:
                            </div>

                            <div class="person">
                                ` +
            items[0].Alumno +
            `
                            </div>

                            <div class="reason">
                                Por haber completado satisfactoriamente <br>                 ` +
            items[0].nombreCurso +
            `
                            </div>
                            <div class="ps-4 pe-4 d-flex justify-content-between">
                            <div class="fs-6">
                                Firmado por: <br>                 ` +
            items[0].Instructor +
            `
                            </div>
                            <div class="fs-6">
                                Terminado: <br>                 ` +
            items[0].tiempoCompletado +
            `
                            </div>
                            </div>
        
        
          `
        )
      })
      .fail(function (data) {
        console.error(data)
      })
  }

  // -------- REGISTRAR COMENTARIO LIKE  ------------

  // COMENTARIO POSITIVO
  $('#RegistrarComentarioPositivo').click(function () {
    let idCurso = $('#miCursoSeleccionadoComentario').val()
    let miComentario = $('#comentarioCurso').val()

    //-------- VALIDACIONES
    if (miComentario == '') {
      alert('Favor de escribir un comentario')
      return
    }
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'registrarComentario',
        Curso_id: idCurso,
        TextoComentario: miComentario,
        isLike: 1,
      },
      url: 'php/API/Comentario.php',
    })
      .done(function () {
        alert('Comentario realizado correctamente')
      })
      .fail(function (data) {
        console.error(data)
      })
  })

  // COMENTARIO NEGATIVO
  $('#RegistrarComentarioNegativo').click(function () {
    let idCurso = $('#miCursoSeleccionadoComentario').val()
    let miComentario = $('#comentarioCurso').val()

    //-------- VALIDACIONES
    if (miComentario == '') {
      alert('Favor de escribir un comentario')
      return
    }
    $.ajax({
      type: 'POST',
      data: {
        funcion: 'registrarComentario',
        Curso_id: idCurso,
        TextoComentario: miComentario,
        isLike: 0,
      },
      url: 'php/API/Comentario.php',
    })
      .done(function () {
        alert('Comentario realizado correctamente')
      })
      .fail(function (data) {
        console.error(data)
      })
  })

  // GENERAR DIPLOMA PDF
  $('#GenerarDiploma').click(function () {
    const $miDiploma = document.querySelector('#miPDFDiploma')
    html2pdf()
      .set({
        margin: 1,
        filename: 'diploma.pdf',
        image: {
          type: 'jpeg',
          quality: 0.98,
        },
        html2canvas: {
          scale: 3,
          letterRendering: true,
        },
        jsPDF: {
          unit: 'in',
          format: 'a3',
          orientation: 'landscape',
        },
      })
      .from($miDiploma)
      .save()
      .catch((err) => console.log(err))
  })

  // -------- MIS BOTONES ------------

  //CONTENIDO
  $('#mostrarKardex').click(function () {
    cargarKardex()
    // Muestro
    $('#miKardex').show()
    // Oculto
    $('#misCursos').hide()
  })

  //DESCRIPCIONES
  $('#mostarCursos').click(function () {
    // Muestro
    $('#misCursos').show()
    // Oculto
    $('#miKardex').hide()
  })
})
