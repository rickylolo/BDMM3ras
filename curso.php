<?php
include_once 'php\API\Usuario.php';
session_start(); // Inicio mi sesion PHP

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptCourse | Curso</title>
    <link rel="shortcut icon" href="img/cripto.png">
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <script src="js/curso.js"></script>
    <link href="css/curso.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div id="miPagina" class="pb-4">
        <!--                 NAVBAR                 -->
        <nav class="navbar sticky-top navbar-expand-lg navbar-light">
            <div class="container">
                <img src="img/cripto.png" width="70px">
                <a class="navbar-brand fs-4 p-4 fw-bold" href="index.php">CryptCourse</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i> Categorías
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="misCategoriasNav">


                            </ul>
                        </li>

                    </ul>
                    <form class="d-flex me-2" role="search">
                        <input class="form-control " type="search" placeholder="Buscar" aria-label="Buscar">
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>

                    </form>
                    <div class="p-2">
                        <?php
                        if ($_SESSION == NULL) {
                            echo ' 
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalLogin">
                                      Iniciar Sesión
                                    </button>';
                        } else {
                            echo ' 
                                    <div id="perfil">
                                    <div class="d-flex flex-column dropstart misDatosUsuario">
                                    <div class="miImagen dropdown p-2 mx-auto" id="DatosUser" data-bs-toggle="dropdown"
                                                  aria-expanded="false"><img src="" id="pfp" class="pfp rounded-circle">
                                    </div>
                                    <ul class="dropdown-menu p-3" aria-labelledby="DatosUser">
                                    <li class="misDatosUser">
                                    <div class="d-flex flex-row miImagen">
                                    <div class="p-1"><img src="" id="pfp2" class="pfp rounded-circle">
                                    </div>
                                    <div class="p-1">
                                        <div class="d-flex flex-column">

                                            <p class="fs-5 fw-bold " id="miNombre">rickylolo</p>

                                            <p class="text-muted fw-light fs-6" id="correoNav">ricky_lolo29@hotmail.com</p>



                                        </div>
                                    </div>
                                </div>
                            </li>

                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="" data-bs-toggle="modal"
                                    data-bs-target="#miModalEditUser"><i class="pe-1 bi bi-pen"></i> Editar
                                    Perfil</a>
                            </li>
                            ';
                            if ($_SESSION["rolUsuario"] == 1) {
                                echo '<li><a class="dropdown-item" href="paginaAdmin.php"><i class="pe-1 bi bi-file-earmark"></i> Página Admin</a></li>';
                            }
                            if ($_SESSION["rolUsuario"] == 2) {
                                echo '<li><a class="dropdown-item" href="paginaInstructor.php"><i class="pe-1 bi bi-file-earmark"></i> Página Instructor</a></li>
                                 <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalMensaje"><i class="pe-1 bi bi-chat-left-text"></i> Ver Mensajes</a></li>';
                            }
                            if ($_SESSION["rolUsuario"] == 3) {
                                echo ' <li><a class="dropdown-item" href="misCursos.php"><i class="pe-1 bi bi-mortarboard"></i> Mis cursos</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalMensaje"><i class="pe-1 bi bi-chat-left-text"></i> Ver Mensajes</a></li>';
                            }
                            echo ' 
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="index.php?logout=true"><i class="pe-1 bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>';
                        }
                        ?>


                    </div>
                </div>
            </div>
        </nav>


        <div class="container mainPage">
            <div class="container">
                <div class="d-flex flex-row">
                    <div class="p-2">
                        <div class="card" style="width: 22rem;">
                            <img src="img/html.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Curso de HTML 5</h5>
                                <p class="card-text text-end text-primary">
                                    255.50 MXN

                                </p>
                                <a href="" data-bs-toggle="modal" data-bs-target="#miModalMetodoPago" class="btn btn-primary d-flex justify-content-center">Comprar curso</a>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 flex-fill shadow-sm">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row ">
                                <p class="fs-4 p-1 fw-bold me-auto ">Curso de HTML 5</p>
                                <p class="fs-6 p-2 fw-light text-primary">Desarrollo</p>

                            </div>

                            <p class="text-muted fs-6 p-4" id="correo">Conviértete en un experto en HTML con este curso que
                                te
                                enseña a programar desde cero

                                Conocimientos previos? Para tomar este curso no necesitas ningún conocimiento previo, basta
                                con que sepas prender el
                                computador e instalar programas que descargues de internet ya que todos los conocimientos
                                básicos los iremos aprendiendo
                                y practicando a lo largo del curso. Este curso tiene tecnologías modernas que son utilizadas
                                por todos los
                                desarrolladores web del mundo en el día a día. Aprovecha esta oportunidad para que podamos
                                encaminarte de una manera
                                eficiente a convertirte en un desarrollador web.</p>
                            <div class="d-flex flex-row justify-content-end p-2">
                                <span class="badge rounded-pill bg-success p-2">Recomendaciones: 1</span>
                                <span class="badge rounded-pill bg-danger p-2">No Recomendaciones: 1</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <hr class="solid">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item" id="mostrarContenido">
                    <a class="nav-link active" aria-current="page">Contenido</a>
                </li>
                <li class="nav-item" id="mostrarDescripcion">
                    <a class="nav-link" aria-current="page">Descripción</a>
                </li>
                <li class="nav-item" id="mostrarValoracion">
                    <a class="nav-link" aria-current="page">Valoraciones</a>
                </li>
                <li class="nav-item" id="mostrarInstructor">
                    <a class="nav-link" aria-current="page">Instructor</a>
                </li>
            </ul>
            <!-- MI ACORDEON -->
            <div class="accordion accordion-flush" id="miContenido">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Nivel 1: Introducción

                        </button>

                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#miContenido">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-header text-end">
                                    <span class="badge rounded-pill bg-success">Adquirido</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Introducción</h5>
                                    <p class="card-text">¿Qué es HTML y para qué sirve?
                                        El Lenguaje de Marcado de Hipertexto (HTML) es el código que se utiliza para
                                        estructurar y desplegar una página web y
                                        sus contenidos. Por ejemplo, sus contenidos podrían ser párrafos, una lista con
                                        viñetas, o imágenes y tablas de datos.</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary">Marcar como finalizado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Nivel 2: Conceptos Básicos
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#miContenido">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-header text-end">
                                    <span class="badge rounded-pill bg-primary">50.50 MXN</span>
                                    <span class="badge rounded-pill bg-secondary">No Adquirido</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Conceptos Básicos</h5>
                                    <p class="card-text"></p>
                                    Sigue aprendiendo adquiriendo este nivel
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-success">Comprar nivel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            <i class="bi bi-check-lg text-success"></i>Nivel 3: Formularios
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#miContenido">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-header text-end">
                                    <span class="badge rounded-pill bg-success">Adquirido</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center text-muted">Formularios.</h5>
                                    <video controls class="misVideos mx-auto">
                                        <source class="misVideos" src="" type="video/mp4">
                                    </video>
                                    <hr class="solid">
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary">Marcar como finalizado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Nivel 4: Imagenes, links, listas y tablas.
                        </button>
                    </h2>

                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#miContenido">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-header text-end">
                                    <span class="badge rounded-pill bg-success">Adquirido</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center text-muted">Imagenes, links, listas y tablas.</h5>
                                    <video controls class="misVideos mx-auto">
                                        <source class="misVideos" src="" type="video/mp4">
                                    </video>
                                    <hr class="solid">
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-primary">Marcar como finalizado</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>



            </div>

            <!-- MI DESCRIPCION -->
            <div id="CursoDescripcion" class="course-description container">
                <hr class="solid">
                <h4>Acerca de este curso </h4>
                <hr class="solid">
                <p>
                    Conviértete en un experto en HTML con este curso que te enseña a programar
                    desde
                    cero
                </p>
                <p>
                    Conocimientos previos?

                    Para tomar este curso no necesitas ningún conocimiento previo, basta con que sepas prender el computador
                    e instalar
                    programas que descargues de internet ya que todos los conocimientos básicos los iremos aprendiendo y
                    practicando a lo
                    largo del curso.

                    Este curso tiene tecnologías modernas que son utilizadas por todos los desarrolladores web del mundo en
                    el día a día.
                    Aprovecha esta oportunidad para que podamos encaminarte de una manera eficiente a convertirte en un
                    desarrollador web.
                </p>

            </div>

            <!-- MIS VALORACIONES -->
            <div id="Valoraciones" class="container">
                <hr class="solid">
                <h4>Comentarios y valoraciones de los estudiantes </h4>
                <hr class="solid">
                <div id="misValoraciones" class="list-group p-2">
                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="miImagen misMensajes d-flex w-100 justify-content-between">

                            <div class="d-flex">
                                <img src="img/avatar.jpg" class="pfp rounded-circle">
                                <div class="align-self-center">
                                    <p class="fs-5 p-3 fw-bold align-middle">rickylolo</p>
                                </div>
                            </div>
                            <div class="align-self-start">
                                <span class="badge rounded-pill bg-success">Recomendado</span>
                            </div>
                        </div>
                        <hr class="solid">
                        <p class="mb-1">Recomiendo el curso, es facil para principiantes</p>

                    </a>
                    <hr class="solid">
                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                            <div class="d-flex">
                                <img src="img/avatar3.jpg" class="pfp rounded-circle">
                                <div class="align-self-center">
                                    <p class="fs-5 p-3 fw-bold align-middle">Robertin123</p>
                                </div>
                            </div>
                            <div class="align-self-start">
                                <span class="badge rounded-pill bg-danger">No Recomendado</span>
                            </div>
                        </div>
                        <hr class="solid">
                        <p class="mb-1">Este curso es muy facil</p>

                    </a>


                </div>
            </div>

            <!-- MI INSTRUCTOR -->
            <div id="Instructor" class="container">
                <hr class="solid">
                <h4>Instructor</h4>
                <div class="container">
                    <hr class="solid">
                    <div class="d-flex flex-row pfpInstructor">
                        <div class="p-2"><img src="img/avatar2.jpg" class="rounded-circle">
                        </div>
                        <div class="p-2">
                            <div class="d-flex flex-column">

                                <p class="fs-5 p-3 fw-bold">Nicholas Schaufrman</p>

                                <p class="text-muted fs-6 p-3" id="correo">nicky_Schauffy@gmail.com</p>
                                <hr class="solid">
                                <p class="fs-6 p-3" id="descipcion">He sido CTO y CEO de varias compañías de tecnología,
                                    relacionadas con cryptomonedas, geolocalización y comercio
                                    electrónico. Algunas hoy tienen premios internacionales y otros son lindos recuerdos.
                                    Fui contratado en Nueva Zelanda
                                    cuando aún vivía en Chile, Actualmente soy desarrollador de software senior, instructor
                                    de tecnologías para el
                                    desarrollo web y móvil. A lo largo de mi vida he logrado construir mucho software con
                                    herramientas y formas que han dado
                                    un éxito rotundo y otras un terrible fracaso. Por lo que me enfoco en entregar
                                    conocimientos con lo que se pueda
                                    construir software de calidad mundial y fácil de escalar.</p>



                            </div>
                            <hr class="solid">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  >MODAL WINDOW MENSAJES<-->
    <div class="modal fade" id="miModalMensaje" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between">
                        <div id="misChats">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="d-flex flex-row miImagen chat">
                                        <div class="p-2"><img src="img/html.jpg" class="pfp">
                                        </div>
                                        <div class="p-2">
                                            <div class="d-flex flex-column">
                                                <p class="fs-6 p-1 fw-bold">Curso de HTML 5</p>
                                                <p class="text-muted fs-6 fw-light" id="correo">Instructor: Nicholas
                                                    Schaufrman
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="d-flex flex-row miImagen chat">
                                        <div class="p-2"><img src="img/css.png" class="pfp">
                                        </div>
                                        <div class="p-2">
                                            <div class="d-flex flex-column">
                                                <p class="fs-6 p-1 fw-bold">Curso de CSS 3</p>
                                                <p class="text-muted fs-6 fw-light" id="correo">Instructor: Nicholas
                                                    Schaufrman
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="d-flex flex-row miImagen chat">
                                        <div class="p-2"><img src="img/javascript.jpg" class="pfp">
                                        </div>
                                        <div class="p-2">
                                            <div class="d-flex flex-column">
                                                <p class="fs-6 p-1 fw-bold">Curso de Javascript</p>
                                                <p class="text-muted fs-6 fw-light" id="correo">Instructor: Nicholas
                                                    Schaufrman
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div id="miMensaje" class="p-2 flex-fill">
                            <div class="d-flex flex-row miImagen">
                                <div class="p-2"><img src="img/html.jpg" class="pfp">
                                </div>
                                <div class="p-2">
                                    <div class="d-flex flex-column">
                                        <p class="fs-5 p-1 fw-bold">Curso de HTML 5</p>
                                        <p class="text-muted fs-6" id="correo">Instructor: Nicholas Schaufrman</p>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action bg-" aria-current="true">
                                    <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                        <div class="d-flex">
                                            <img src="img/avatar.jpg" class="pfp rounded-circle">
                                            <div class="align-self-center">
                                                <p class="fs-5 p-3 fw-bold align-middle">rickylolo</p>
                                            </div>
                                        </div>
                                        <div class="align-self-start">
                                            <small class="text-muted p-3">8:35pm 22/Feb/2023</small>
                                        </div>
                                    </div>
                                    <hr class="solid">
                                    <p class="mb-1">Tengo dudas del curso</p>

                                </a>
                                <hr class="solid">
                                <a href="#" class="list-group-item list-group-item-action bg-" aria-current="true">
                                    <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                        <div class="d-flex">
                                            <img src="img/avatar2.jpg" class="pfp rounded-circle">
                                            <div class="align-self-center">
                                                <p class="fs-5 p-3 fw-bold align-middle">Nicholas Schaufrman</p>
                                            </div>
                                        </div>
                                        <div class="align-self-start">
                                            <small class="text-muted p-3">9:17pm 23/Feb/2023</small>
                                        </div>
                                    </div>
                                    <hr class="solid">
                                    <p class="mb-1">Cuál es tu duda</p>
                                </a>
                                <hr class="solid">
                                <a href="#" class="list-group-item list-group-item-action bg-" aria-current="true">
                                    <div class="miImagen misMensajes d-flex w-100 justify-content-between">
                                        <div class="d-flex">
                                            <img src="img/avatar.jpg" class="pfp rounded-circle">
                                            <div class="align-self-center">
                                                <p class="fs-5 p-3 fw-bold align-middle">rickylolo</p>
                                            </div>
                                        </div>
                                        <div class="align-self-start">
                                            <small class="text-muted p-3">8:35pm 23/Feb/2023</small>
                                        </div>
                                    </div>
                                    <hr class="solid">
                                    <p class="mb-1">Que diferencia hay entre un div y un span</p>

                                </a>
                                <hr class="solid">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <form class="d-flex" role="search">

                        <input class="form-control me-2" type="search" placeholder="Escribe aqui tu mensaje" aria-label="Buscar">

                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-send"></i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  >MODAL WINDOW METODO PAGO<-->
    <div class="modal fade" id="miModalMetodoPago" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Escoge un método de pago:</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 row">
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                                <div class="col-6">
                                    <img src="https://www.consumoteca.com/wp-content/uploads/Logo-de-PayPal.jpg" height="100px">
                                </div>
                            </div>


                        </div>
                        <div class="col-8 d-flex align-items-center">
                            Paypal

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 row">
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="defaultCheck1">
                                    </label>
                                </div>
                                <div class="col-6">
                                    <img src="https://lapeorempresadelmundo.es/wp-content/uploads/2020/11/tarjeta-credito-logo.png" height="75px">
                                </div>
                            </div>


                        </div>
                        <div class="col-8 d-flex align-items-center">
                            Tarjeta BBVA con terminación ****8243

                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!--  >MODAL WINDOW LOGIN<-->
    <div class="modal fade" id="miModalLogin" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ms-4" id="modalTitle">Inicia sesión</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="separador"></div>
                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Correo Electrónico
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                        <input type="text" class="form-control" id="correoLogin" name="correoLogin" placeholder="Correo" aria-label="correo" aria-describedby="basic-addon1">
                    </div>
                    <div class="separador"></div>
                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Contraseña
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1">
                    </div>
                    <div class="row d-flex text-end">
                        <a href="miModal" data-bs-toggle="modal" data-bs-target="#miModal" data-bs-dismiss="modal">¿Aún
                            no tienes una cuenta? Registrate Aquí</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="ButtonLogIn">Iniciar Sesión</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>

    </div>

    <!--  >MODAL WINDOW REGISTER<-->
    <div class="modal fade" id="miModal" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ms-4" id="modalTitle">Registro de usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row d-flex text-center">
                        <h5>Ingresa los siguientes datos</h5>
                    </div>

                    <div class="image-upload d-flex justify-content-center p-2">
                        <label for="userIMG">
                            <img src="img/avatar.png" alt="" id="img-foto2" width="250px" height="250px">
                        </label>
                        <input type="file" onchange="vista_preliminar2(event)" accept="image/jpeg" class="form-control" id="userIMG" name="userIMG" placeholder="Foto de perfil" aria-label="Username" aria-describedby="basic-addon1">

                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Correo Electrónico
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Nombre(s)
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-person"></i></span>
                        <input type="text" class="form-control" id="names" name="names" placeholder="Nombre(s)" aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Apellido Paterno
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>
                        <input type="text" class="form-control" id="lastNameP" name="lastNameP" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Apellido Materno
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>
                        <input type="text" class="form-control" id="lastNameM" name="lastNameM" placeholder="Apellido Materno" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Nombre de usuario
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Contraseña
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" name="contrasenia" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <p style="font-size: small;">La contraseña debe de incluir 8 caracteres al menos, y debe incluir
                        una mayúscula, un carácter especial, y un número al menos.
                    <p>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Confirmar Contraseña
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Fecha de nacimiento
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-calendar"></i></span>
                        <input type="date" class="form-control" id="Birthday" name="Birthday" placeholder="Fecha de nacimiento" aria-label="Fecha de nacimiento" aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Sexo:
                    </div>
                    <div class="input-group mb-3">
                        <div class="dropdown input-group-text" id="basic-addon1">
                            <button class="btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Selecciona aquí:
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a href=" " class="dropdown-item SexoUsuario">Hombre</a></li>
                                <li><a href=" " class="dropdown-item SexoUsuario">Mujer</a></li>
                                <li><a href=" " class="dropdown-item SexoUsuario">Otro</a></li>
                            </ul>
                        </div>
                        <input type="text" class="form-control" name="gender-user" id="gender-user" placeholder="Sexo" aria-label="Sexo" aria-describedby="basic-addon1" required>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="ButtonRegistroEstudiante" data-bs-dismiss="modal">Registrar
                        Alumno</button>
                    <button type="button" class="btn btn-success" id="ButtonRegistroInstructor" data-bs-dismiss="modal">Registrar
                        Instructor</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#miModalLogin">Regresar</button>
                </div>
            </div>
        </div>
    </div>

    <!--  >MODAL EDIT USER<-->
    <div class="modal fade" id="miModalEditUser" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Edita tus datos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="" action="" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row d-flex justify-content-center">

                            <h5>Ingresa los siguientes datos:</h5>

                        </div>

                        <div class="image-upload d-flex justify-content-center p-2">
                            <label for="E_userIMG">
                                <img src="" alt="" id="E_imgFoto" width="250px" height="250px">
                            </label>
                            <input type="file" onchange="vista_preliminarEdit(event)" accept="image/jpeg" class="form-control" id="E_userIMG" name="E_userIMG" placeholder="Foto de perfil" aria-label="Username" aria-describedby="basic-addon1">


                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Correo Electrónico
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>

                            <input type="text" class="form-control" id="E_email" name="E_email" placeholder="Correo Electrónico" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Contraseña
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="E_contrasenia" name="E_contrasenia" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>
                        <p style="font-size: small;">Contraseña con un mínimo de 8 caracteres, una
                            mayúscula, una minúscula, un número y un carácter
                            especial.
                        <p>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Confirmar contraseña
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="E_confirmarContrasenia" name="E_confirmarContrasenia" placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Descripción
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>

                            <textarea row="8" class="form-control" id="E_descripcion" name="E_descripcion" placeholder="Describete" aria-label="Username" aria-describedby="basic-addon1" value=""></textarea>

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Nombre(s)
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-person"></i></span>
                            <input type="text" class="form-control" id="E_names" name="E_names" placeholder="Nombre(s)" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Apellido Paterno
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>

                            <input type="text" class="form-control" id="E_lastNameP" name="E_lastNameP" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>



                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Apellido Materno
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>

                            <input type="text" class="form-control" id="E_lastNameM" name="E_lastNameM" placeholder="Apellido Materno" aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Sexo:
                        </div>
                        <div class="input-group mb-3">
                            <div class="dropdown input-group-text" id="basic-addon1">
                                <button class="btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Selecciona aquí:
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Hombre</a></li>
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Mujer</a></li>
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Otro</a></li>
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="gender-user" id="E_generoUsuario" placeholder="Sexo" aria-label="Sexo" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Fecha de nacimiento
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>

                            <input type="date" class="form-control" id="E_FechaNacimiento" name="E_FechaNacimiento" placeholder="Fecha de Nacimiento" aria-label="Fecha Nacimiento" aria-describedby="basic-addon1" value="">

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="EditUser" data-bs-dismiss="modal">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--FOOTER<-->
    <footer class="w-100 d-flex align-items justify-content-center flex-wrap">
        <p class="fs-5 px-3 pt-3 PCELText"><img src="img/cripto.png" class="" width="40" height="40">
        <p class="fs-5 px-3 pt-3">&copy; Todos los derechos reservados</p>
        </p>
        <div id="iconos">
            <a href="" data-bs-toggle="modal" data-bs-target="#miModalContacto"><i class="bi bi-shop"></i></a>
            <a href="https://www.facebook.com/RicardoGrimaldo29/"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/rickylolo29"><i class="bi bi-twitter"></i></a>
            <a href="https://www.instagram.com/rickylolo29/"><i class="bi bi-instagram"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>