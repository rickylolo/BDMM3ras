$(document).ready(function () {
  cargarCursosEstudiante()
  function cargarCursosEstudiante() {
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
})
