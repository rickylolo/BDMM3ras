$(document).ready(function () {
  $('#Valoraciones').hide()
  $('#Instructor').hide()
  $('#CursoDescripcion').hide()

  // -------- MIS BOTONES ------------

  //CONTENIDO
  $('#mostrarContenido').click(function () {
    // Muestro
    $('#miContenido').show()
    // Oculto
    $('#Valoraciones').hide()
    $('#Instructor').hide()
    $('#CursoDescripcion').hide()
  })

  //DESCRIPCIONES
  $('#mostrarDescripcion').click(function () {
    // Muestro
    $('#CursoDescripcion').show()
    // Oculto
    $('#Valoraciones').hide()
    $('#Instructor').hide()
    $('#miContenido').hide()
  })

  //VALORACIONES
  $('#mostrarValoracion').click(function () {
    // Muestro
    $('#Valoraciones').show()
    // Oculto
    $('#CursoDescripcion').hide()
    $('#Instructor').hide()
    $('#miContenido').hide()
  })

  //INSTRUCTOR
  $('#mostrarInstructor').click(function () {
    // Muestro
    $('#Instructor').show()
    // Oculto
    $('#CursoDescripcion').hide()
    $('#Valoraciones').hide()
    $('#miContenido').hide()
  })
})
