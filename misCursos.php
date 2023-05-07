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
    <title>CryptCourse| Mis Cursos</title>
    <link rel="shortcut icon" href="img\cripto.png">
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <script src="js/kardex.js"></script>
    <link href="css/index.css" rel="stylesheet">
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
        <!--                 CURSOS                 -->
        <!--                 CURSOS MEJORES CALIFICADOS                 -->
        <div class="container" id="misCursos">
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Mis cursos</b></div>
            <hr class="solid">
            <ul class="nav nav-tabs justify-content-end">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">En progreso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mostrarKardex">Kardex</a>
                </li>

            </ul>
            <section class="post-list">
                <div class="content">
                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/html.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Curso de HTML 5</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/css.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>CSS 3 para principiantes</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/javascript.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Javascript elemental</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="producto.html">
                                <img src="img/react.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>React desde Cero a Experto</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/html.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Curso de HTML 5</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/css.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>CSS 3 para principiantes</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/javascript.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Javascript elemental</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="producto.html">
                                <img src="img/react.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>React desde Cero a Experto</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/html.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Curso de HTML 5</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/css.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>CSS 3 para principiantes</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="curso.html">
                                <img src="img/javascript.jpg" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>Javascript elemental</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post-header">
                            <a href="producto.html">
                                <img src="img/react.png" class="post-img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4><b>React desde Cero a Experto</b></h4>
                            <span>Impartido Por :<div class="instructor">Ricardo Alberto Grimaldo Estévez</div></span><br>
                            <div class="btn miCarrito">Ver Curso</div>
                        </div>
                    </article>
                </div>


            </section>


        </div>

        <div class="container" id="miKardex">
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Kardex</b></div>
            <hr class="solid">
            <ul class="nav nav-tabs justify-content-end">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Ver Cursos</a>
                </li>


            </ul>
            <nav class="navbar navbar-light" id="navbarCursosInstructor">
                <div class="container-fluid">
                    <a class="navbar-brand fs-5 p-2">Filtros</a>
                    <form class="d-flex">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Cursos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="">Terminados</a></li>
                                <li><a class="dropdown-item" href="">Activos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="">Todos</a></li>

                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="">Desarrollo</a></li>
                                <li><a class="dropdown-item" href="">Negocios</a></li>
                                <li><a class="dropdown-item" href="">Finanzas</a></li>
                                <li><a class="dropdown-item" href="">Cocina</a></li>
                                <li><a class="dropdown-item" href="">Productividad</a></li>
                                <li><a class="dropdown-item" href="">Diseño</a></li>
                                <li><a class="dropdown-item" href="">Marketing</a></li>
                            </ul>
                        </div>
                        <input class="form-control" type="search" placeholder="Buscar curso" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                    </form>

                </div>

                <div class="container-fluid">
                    <div class="input-group">
                        <span class="input-group-text">Rango de fechas</span>
                        <input type="date" aria-label="First name" class="form-control">
                        <input type="date" aria-label="Last name" class="form-control">
                        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </nav>
            <div class="list-group">
                <div class="d-flex pt-4 pe-4 justify-content-end">Total de cursos: 3</div>
                <hr class="solid">
                <a href="#" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex">
                            <img src="img/html.jpg" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">Curso de HTML 5</p>
                                <p class="text-muted fs-6 fw-light">Desarrollo</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>3/4</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>3/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>5/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>7/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Estado: <b>Incompleto</b>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pt-4">
                            <p class="mb-1"><button type="button" class="btn btn-success"><i class="bi bi-bookmark-star-fill"></i></button>
                            </p>


                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex align-items-start">
                            <img src="img/javascript.jpg" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">Curso de Javascript</p>
                                <p class="text-muted fs-6 fw-light">Desarrollo</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>3/4</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>3/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>5/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>7/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Estado: <b>Incompleto</b>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="mb-1"><button type="button" class="btn btn-success"><i class="bi bi-bookmark-star-fill"></i></button>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action misCursosInstructor" aria-current="true">
                    <div class="d-flex flex-row miImagen justify-content-between">
                        <div class="d-flex align-items-start">
                            <img src="img/css.png" class="pfp">
                            <div class="p-1 d-flex flex-column">
                                <p class="fs-6 fw-bold">Curso de CSS 3</p>
                                <p class="text-muted fs-6 fw-light">Desarrollo</p>
                            </div>
                            <div class="ps-4 d-flex flex-row">
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Progreso: <b>3/4</b>
                                </p>
                                <p class="ps-4 pt-3 text-muted fs-6 fw-light">Fecha de ingreso: <b>3/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha ultimo nivel: <b>5/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Fecha finalizado: <b>7/Feb/2023</b>
                                </p>
                                <p class="ps-4 pt-3  text-muted fs-6 fw-light">Estado: <b>Incompleto</b>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="mb-1"><button type="button" class="btn btn-success"><i class="bi bi-bookmark-star-fill"></i></button>
                            </p>

                        </div>
                    </div>
                </a>

                <hr class="solid">

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
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1">
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
                                <button class="btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                    Selecciona aquí:
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
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


    <!--  >MODAL WINDOW MENSAJES<-->
    <div class="modal fade" id="miModalMensaje" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <input type="hidden" id="miCursoSeleccionadoMensajes">
                <div class="modal-body" id="miBodyMensajes">
                
                    <div class="d-flex flex-row justify-content-between">
     
                        <div class="list-group" id="misChats">
                           
                        </div>
                        <div id="miMensaje" class="ps-2 flex-fill">

                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Aqui apareceran tus mensajes</h4>
                            <p>Aqui iran el contenido de tus mensajes selecciona un chat de el lado izquierdo para continuar</p>
                            <hr>               
                        </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="miFooterMensajes">
                </div>
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