 $(document).ready(function () {
  $('#categoriasCursoSelected').hide()
  $('#nivelesCursoSelected').hide()

 

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





 cargarCategoriasInstructor()
  function cargarCategoriasInstructor() {
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerDataTodosCategoria" },
      url: "php/API/Categoria.php",
    })
      .done(function (data) {
        var items = JSON.parse(data);
        $("#searchCategoria").empty();
         $("#miDropdownCursosCategoriasEditar").empty();
        for (let i = 0; i < items.length; i++) {
          $("#searchCategoria").append(
             `<li><a class="dropdown-item miBusquedaCategoriaInstructor" id="`+ items[i].Categoria_id +`"> `+ items[i].nombre +`</a></li> `
          );

          $("#miDropdownCursosCategoriasEditar").append(
             `  <li><a class="dropdown-item E_CategoriaCurso_li" id="`+ items[i].Categoria_id +`">`+ items[i].nombre +`</a></li> `
          );
        }
      })
      .fail(function (data) {
        console.error(data);
      });
  }

 cargarReporteCurso()
  function cargarReporteCurso() {
    $.ajax({
      type: "POST",
      data: { funcion: "getReporteInstructor" },
      url: "php/API/Curso.php",
    })
      .done(function (data) {
        var items = JSON.parse(data);
        $("#miReporteInstructor").empty();
        for (let i = 0; i < items.length; i++) {
            if(items[i].categoriaNombre == null)
            items[i].categoriaNombre = 'Ninguna categoría'

          $("#miReporteInstructor").append(
                 `<a class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex justify-content-start">
                            <img  src="data:image/jpeg;base64,` + items[i].imagenCurso + `" class="mt-2 pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-5 fw-bold">` +  items[i].cursoNombre + `</p>
                                <p class="text-muted fs-6">` + items[i].categoriaNombre + `</p>
                            </div>
                        </div>
                        <div class="d-flex mt-2 justify-content-end">
                            <div class="d-flex me-4 pt-2 pb-4">
                                <p class="ps-4  text-muted fs-6 fw-light">Alumnos: <b>` + items[i].noAlumnos + `</b>
                                </p>
                                <p class="ps-4  text-muted fs-6 fw-light">Promedio nivel: <b>` + items[i].Promedio + `</b>
                                </p>
                                <p class="ps-4  text-muted fs-6 fw-light">Total ingresos: <b>` + items[i].Ingresos + ` MXN</b>
                                </p>
                            </div>
                            <p class="mb-1 verCursoDetalle" data-bs-toggle="modal" data-bs-target="#miModalCursoDetalle"><button type="button" class="btn btn-success"><i class="bi bi-search"></i></button>
                            </p>
                            <p class="mb-1 editarCurso" id="` + items[i].Curso_id + `"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalEditarCurso"><i class="bi bi-pen"></i></button>
                            </p>
                            <p class="mb-1"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></p>

                        </div>
                    </div>
                </a> `
          );
        }
      })
      .fail(function (data) {
        console.error(data);
      });
  }




  // MI DROPDOWN CURSO CATEGORIA
   $('#miDropdownCursosCategoriasEditar').on('click','.E_CategoriaCurso_li', function (event) {
    event.preventDefault()
    $('#E_categoriaCursoEditar').val($(this).text())
    $('#miCategoriaParaCurso').val($(this).attr('id'))
  })

// ONCLICK

// -- CURSO DASHBOARD -- 

$("#miReporteInstructor").on("click", ".editarCurso", funcionGetCurso);
  function funcionGetCurso() {
    let miIdCurso = $(this).attr("id");
    $("#miCursoSelectedEdit").val(miIdCurso);

    // Mis datos Curso
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerCurso", Curso_id: miIdCurso },
      url: "php/API/Curso.php",
    })
    .done(function (data) {
        var items = JSON.parse(data)
        // Imagen
         document.getElementById("miImagenCursoSelected").src =
           "data:image/jpeg;base64," + items[0].imagenCurso
         document.getElementById("E_img_cursoIMG").src =
           "data:image/jpeg;base64," + items[0].imagenCurso
          // Mi nombre 
         $("#nombreCursoSelected").text(items[0].nombre)
         $("#E_nombreCurso").val(items[0].nombre)
         $("#E_descCurso").val(items[0].descripcion)
         $("#E_costoCurso").val(items[0].costoCurso)
        
    })
    .fail(function (data) {
        console.error(data);
    });


  
    // Mis Datos Categorias
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerCategoriasDeUnCurso", Curso_id : miIdCurso},
      url: "php/API/Curso.php",
    })
    .done(function (data) {
     var items = JSON.parse(data)  
     $("#misCategoriasCursoSelectedEditar").empty();
     for (let i = 0; i < items.length; i++) {
          $("#misCategoriasCursoSelectedEditar").append(
             `      <a class="list-group-item list-group-item-action" aria-current="true">
                                <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                    <div class="container">
                                        <div class="d-flex flex-row">
                                            <div class="flex-fill">
                                                <p class="fs-6 pt-2">`+ items[i].nombre + `</p>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <p class="mb-1 pt-2"><button type="button" id="`+ items[i].Categoria_id + `" class="borrarCategoriaCurso btn btn-danger"><i class="bi bi-x-lg"></i></button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                     </a> `
          );
     }
     })
     .fail(function (data) {
     console.error(data);
     });
    
  }

  // ----------------------------- REGISTRO DATOS -----------------
    // -- CURSO --
  $("#ButtonRegistrarCurso").click(funcRegistrarCurso);
  function funcRegistrarCurso() {
    var form_data = new FormData()
    var file_data = $("#cursoIMG").prop("files")[0]
    var descCurso = $("#descCurso").val()
    var nombreCurso = $("#nombreCurso").val()
    var costoCurso = $("#costoCurso").val()

    form_data.append("funcion", "insertarCurso")
    form_data.append("file", file_data)
    form_data.append("nombreCurso", nombreCurso)
    form_data.append("descripcionCurso", descCurso)
    form_data.append("costoCurso", costoCurso)


    $.ajax({
      url: "php/API/Curso.php",
      type: "POST",
      cache: false,
      contentType: false,
      data: form_data,
      dataType: "Text",
      enctype: "multipart/form-data",
      processData: false,
    }).done(function (data) {
      var items = JSON.parse(data);
      $("#cursoIMG").val("")
      $("#nombreCurso").val("")
      $("#descCurso").val("")
      $("#costoCurso").val("")
         // CARGAR DATOS MODAL EDIT CURSO
         // Imagen
         document.getElementById("miImagenCursoSelected").src =
           "data:image/jpeg;base64," + items[0].imagenCurso
          // Mi nombre
         $("#nombreCursoSelected").text(items[0].nombre)
         $("#miCursoSelectedEdit").val(items[0].Curso_id)
      
    })
     // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function(jqXHR, textStatus, errorThrown) {
       console.log("Error: " + errorThrown)
      })
  }

    // -- CURSO-CATEGORIA --
  $("#ButtonRegistrarCursoCategoria").click(funcRegistrarCursoCategoria);
  function funcRegistrarCursoCategoria() {
    var idCurso = $("#miCursoSelectedEdit").val()
    var idCategoria = $("#miCategoriaParaCurso").val()
    if(idCurso == null || idCurso == '' || idCategoria == null || idCategoria == '')
    return

    $.ajax({
      url: "php/API/Curso.php",
      type: "POST",
      data: {
        funcion: "insertarCursoCategoria",
        Curso_id: idCurso,
        Categoria_id: idCategoria,
      },
    })
      .done(function () {
         cargarCategoriasInstructor()
        alert("Categoria insertada correctamente en el curso")
          
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function(jqXHR, textStatus, errorThrown) {
       console.log("Error: " + errorThrown)
      })


  }
})

// Funciones de imagenes
let vista_preliminarCurso = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById("img_cursoIMG")

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}

let vista_preliminarEditarCurso = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById("E_img_cursoIMG")

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}
