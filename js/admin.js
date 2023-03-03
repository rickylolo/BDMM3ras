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
})
