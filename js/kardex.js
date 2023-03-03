$(document).ready(function () {
  $('#miKardex').hide()

  // -------- MIS BOTONES ------------

  //CONTENIDO
  $('#mostrarKardex').click(function () {
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
