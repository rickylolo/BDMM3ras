$(document).ready(function () {
  $('#misCategoriasAdmin').hide()
  $('#misMetodosPago').hide()

  // -------- MIS BOTONES ------------

  //USUARIOS
  $('#mostrarUsuarios').click(function () {
    // Muestro
    $('#misUsuariosBloqueados').show()
    // Oculto
    $('#misCategoriasAdmin').hide()
    $('#misMetodosPago').hide()
  })

  //CATEGORIAS
  $('#mostrarCategorias').click(function () {
    // Muestro
    $('#misCategoriasAdmin').show()
    // Oculto
    $('#misUsuariosBloqueados').hide()
    $('#misMetodosPago').hide()
  })

  //METODO PAGO
  $('#mostrarMetodosPago').click(function () {
    // Muestro
    $('#misMetodosPago').show()
    // Oculto
    $('#misCategoriasAdmin').hide()
    $('#misUsuariosBloqueados').hide()
  })


  cargarCategoriasAdmin()
  function cargarCategoriasAdmin() {
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerDataTodosCategoria" },
      url: "php/API/Categoria.php",
    })
      .done(function (data) {
        var items = JSON.parse(data);
        $("#misCategoriasNav").empty();
        $("#misCategoriasDashboard").empty();
        for (let i = 0; i < items.length; i++) {
          $("#misCategoriasNav").append(
             `<li><a class="dropdown-item miBusquedaCategoria" href="" id="`+ items[i].Categoria_id +`"> `+ items[i].nombre +`</a></li> `
          );

          $("#misCategoriasDashboard").append(
            `
          <a class="list-group-item list-group-item-action" aria-current="true">
                <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                    <div class="container">

                        <div class="d-flex flex-row">

                            <div class="flex-fill">
                                <p class="fs-5 pt-2 fw-bold">`+ items[i].nombre +`</p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="mb-1 mt-1"><button type="button" class="btn editarCategoria btn-primary" data-bs-toggle="modal" data-bs-target="#miModalEditarCategoria" id="`+ items[i].Categoria_id +`"><i class="bi bi-pen"></i></button></p>
                                <p class="mb-1 mt-1"><button type="button" class="btn borrarCategoria btn-danger" id="`+ items[i].Categoria_id +`"><i class="bi bi-trash"></i></button></p>

                            </div>
                        </div>

                    </div>
                </div>
                <hr class="solid">
                <div class="d-flex flex-row justify-content-between p-2">
                    <small class="text-muted p-1">Núm. Cursos: `+ items[i].noCursos +`</small>
                    <small class="text-muted p-1">`+ items[i].tiempoRegistro +`</small>
                </div>
            </a>
          `
          );
        }
      })
      .fail(function (data) {
        console.error(data);
      });
  }
  
  cargarMetodosPago()
  function cargarMetodosPago() {
    $.ajax({
      type: "POST",
      data: { funcion: "obtenerDataTodosMetodoPago" },
      url: "php/API/MetodoPago.php",
    })
      .done(function (data) {
        var items = JSON.parse(data);
        $("#misMetodosPagoDashboard").empty();
        for (let i = 0; i < items.length; i++) {
          $("#misMetodosPagoDashboard").append(
             `            <a class="p-4 list-group-item list-group-item-action" aria-current="true">
                <div class="misMetodosImgs d-flex w-100 justify-content-between">
                    <div class="d-flex flex-fill">
                        <img  src="data:image/jpeg;base64,` +
              items[i].imagenMetodo +
              `" >
                        <p class="fs-5 p-3 fw-bold align-middle">` + items[i].nombreMetodo +  `</p>

                    </div>
                    <p class="mb-1"><button type="button" id="` + items[i].MetodoPago_id +  `" class="btn eliminarMetodo btn-danger"><i class="bi bi-trash"></i></button>
                    </p>

                </div>


            </a>`
          );

        }
      })
      .fail(function (data) {
        console.error(data);
      });
  }

// ONCLICK CATEGORIA DASHBOARD

$("#misCategoriasDashboard").on("click", ".editarCategoria", funcGetMiIDCategoria);
  function funcGetMiIDCategoria() {
    let miIdCategoria = $(this).attr("id");
    $("#miCategoriaSeleccionada").val(miIdCategoria);

    $.ajax({
      type: "POST",
      data: { funcion: "obtenerDataCategoria", Categoria_id: miIdCategoria },
      url: "php/API/Categoria.php",
    })
      .done(function (data) {
        if (data.length != 0) {
          var items = JSON.parse(data);
          $("#E_nameCategoria").val(items[0].nombre);
          $("#E_descCategoria").val(items[0].descripcion);
        }
      })
      .fail(function (data) {
        console.error(data);
      });
  }


  // ----------------------------- REGISTRO DATOS -----------------
   // -- CATEGORIA --
  $("#ButtonRegistroCategoria").click(funcRegistrarCategoria)
  function funcRegistrarCategoria() {
    var nomCategoria = $("#nameCategoria").val()
    var descCategoria = $("#descCategoria").val()
    $.ajax({
      url: "php/API/Categoria.php",
      type: "POST",
      data: {
        funcion: "registrarCategoria",
        nombreCategoria: nomCategoria,
        descripcionCategoria: descCategoria,
      },
    })
      .done(function () {
        cargarCategoriasAdmin()
        alert("Categoria insertada correctamente")
          
      })
      // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function(jqXHR, textStatus, errorThrown) {
       console.log("Error: " + errorThrown)
      })
  }

  // -- METODO DE PAGO --
  $("#ButtonRegistroMetodoPago").click(funcRegistrarMetodoPago);
  function funcRegistrarMetodoPago() {
    var form_data = new FormData()
    var file_data = $("#metodoIMG").prop("files")[0]
    var namMet = $("#nameMetodo").val()

    form_data.append("funcion", "registrarMetodoPago")
    form_data.append("file", file_data)
    form_data.append("NombreMetodo", namMet)


    $.ajax({
      url: "php/API/MetodoPago.php",
      type: "POST",
      cache: false,
      contentType: false,
      data: form_data,
      dataType: "Text",
      enctype: "multipart/form-data",
      processData: false,
    }).done(function () {
      alert("Registro de metodo de pago correctamente")
      $("#metodoIMG").val("")
      $("#tipoMetodo").val("")
      $("#nameMetodo").val("")
   
      
    })
     // MANEJO DE ERRORES DEL SERVIDOR
      .fail(function(jqXHR, textStatus, errorThrown) {
       console.log("Error: " + errorThrown)
      })
  }


  // ----------------------------- ACTUALIZAR DATOS -----------------
   // -- CATEGORIA --
  $("#ButtonActualizarCategoria").click(funcActualizarCategoria);
  function funcActualizarCategoria() {
    var idCategoria = $("#miCategoriaSeleccionada").val();
    var nomCategoria = $("#E_nameCategoria").val();
    var descCategoria = $("#E_descCategoria").val();
    $.ajax({
      url: "php/API/Categoria.php",
      type: "POST",
      data: {
        funcion: "actualizarCategoria",
        Categoria_id: idCategoria,
        nombreCategoria: nomCategoria,
        descripcionCategoria: descCategoria,
      },
    })
      .done(function (data) {
        console.log(data)
        $("#E_nameCategoria").val("");
        $("#E_descCategoria").val("");
        cargarCategoriasAdmin();
        alert("Categoria actualizada correctamente");
      })
      .fail(function (data) {
        console.error(data);
      });
  }

  // ----------------------------- ELIMINAR DATOS -----------------
   // -- CATEGORIA --
  $("#misCategoriasDashboard").on(
    "click",
    ".borrarCategoria",
    funcEliminarCategoria
  );
  function funcEliminarCategoria() {
    let miIdCategoria = $(this).attr("id");
    if (confirm("¿Seguro deseas eliminar esta categoria?")) {
      $.ajax({
        type: "POST",
        data: { funcion: "eliminarCategoria", Categoria_id: miIdCategoria },
        url: "php/API/Categoria.php",
      })
        .done(function () {
          cargarCategoriasAdmin();
          alert("Categoria eliminada correctamente");
        })
        .fail(function (data) {
          console.error(data);
        });
    }
  }

  // -- METODO DE PAGO --
  $("#misMetodosPagoDashboard").on(
    "click",
    ".eliminarMetodo",
    funcEliminarMetodoPago
  );
  function funcEliminarMetodoPago() {
    let miIdMetodo = $(this).attr("id");
    if (confirm("¿Seguro deseas eliminar este método de pago?")) {
      $.ajax({
        type: "POST",
        data: { funcion: "eliminarMetodoPago", MetodoPago_id: miIdMetodo },
        url: "php/API/MetodoPago.php",
      })
      .done(function (data) {
        console.log(data)
        if (data && data.error) {
          alert("Se produjo un error al eliminar el método de pago: " + data.error)
        } else {
        cargarMetodosPago()
        alert("Método de pago eliminado correctamente")
        }
        })
        .fail(function (xhr, textStatus, errorThrown) {
        console.error("Se produjo un error al realizar la solicitud:", textStatus, errorThrown)
        })
    }
  }
})


// Funciones de imagenes
let vista_preliminarMetPago = (event) => {
  let leer_img = new FileReader()
  let id_img = document.getElementById("img-metPago")

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result
    }
  }

  leer_img.readAsDataURL(event.target.files[0])
}
