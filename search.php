<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptCourse| Página Principal</title>
    <link rel="shortcut icon" href="img\cripto.png">
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <!--                 NAVBAR                 -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light">
        <div class="container">
            <img src="img/cripto.png" width="70px">
            <a class="navbar-brand fs-4 p-4" href="index.html">CryptCourse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categorías
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Desarrollo</a></li>
                            <li><a class="dropdown-item" href="#">Negocios</a></li>
                            <li><a class="dropdown-item" href="#">Finanzas</a></li>
                            <li><a class="dropdown-item" href="#">Cocina</a></li>
                            <li><a class="dropdown-item" href="#">Productividad</a></li>
                            <li><a class="dropdown-item" href="#">Diseño</a></li>
                            <li><a class="dropdown-item" href="#">Marketing</a></li>

                        </ul>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>

                </form>
                <div id="perfil">
                    <div class="d-flex flex-column dropstart misDatosUsuario">
                        <div class="miImagen dropdown p-2 mx-auto" id="DatosUser" data-bs-toggle="dropdown"
                            aria-expanded="false"><img src="img/avatar.jpg" class="pfp rounded-circle">
                        </div>
                        <ul class="dropdown-menu " aria-labelledby="DatosUser">
                            <li class="misDatosUser">
                                <div class="d-flex flex-row miImagen">
                                    <div class="p-2"><img src="img/avatar.jpg" class="pfp rounded-circle">
                                    </div>
                                    <div class="p-2">
                                        <div class="d-flex flex-column">

                                            <p class="fs-5 p-1 fw-bold">rickylolo</p>

                                            <p class="text-muted fs-6" id="correo">ricky_lolo29@hotmail.com</p>



                                        </div>
                                    </div>
                                </div>
                            </li>

                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="" data-bs-toggle="modal"
                                    data-bs-target="#miModalEditUser">Editar
                                    Perfil</a>
                            </li>
                            <li><a class="dropdown-item" href="misCursos.html">Mis cursos</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalMensaje">Ver
                                    Mensajes</a></li>

                            <li><a class="dropdown-item" href="paginaAdmin.html">Página Admin</a></li>
                            <li><a class="dropdown-item" href="paginaInstructor.html">Página Instructor</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="index.html">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <hr class="solid">
        <nav class="navbar navbar-light" id="navbarCursosInstructor">
            <div class="container-fluid">
                <a class="navbar-brand fs-5 fw-bold p-2">Filtros</a>
                <form class="d-flex">

                    <div class="dropdown">
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="">Desarrollo</a></li>
                            <li><a class="dropdown-item" href="">Negocios</a></li>
                            <li><a class="dropdown-item" href="">Finanzas</a></li>
                            <li><a class="dropdown-item" href="">Cocina</a></li>
                            <li><a class="dropdown-item" href="">Productividad</a></li>
                            <li><a class="dropdown-item" href="">Diseño</a></li>
                            <li><a class="dropdown-item" href="">Marketing</a></li>
                        </ul>
                    </div>
                    <input class="form-control" type="search" placeholder="Buscar por usuario" aria-label="Search">
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
        <hr class="solid">
        <div class="container">
            <div class="d-flex fw-bold justify-content-end pe-4">Resultados: 9</div>
        </div>
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


    <!--  >MODAL WINDOW LOGIN<-->
    <div class="modal fade" id="miModalLogin" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Inicia sesión</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="separador"></div>
                    <div class="row">
                        Nombre de usuario o correo
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Usuario o Correo"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="separador"></div>
                    <div class="row">
                        Contraseña
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña"
                            aria-label="password" aria-describedby="basic-addon1">
                    </div>
                    <div class="row">
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
    <div class="modal fade" id="miModal" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Regístrate</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="php\user_API.php" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <h5>Ingresa los siguientes datos</h5>
                            </div>
                        </div>
                        <div class="row modalTexto">
                            Correo Electrónico
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" name="email" placeholder="Correo Electrónico"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>


                        <div class="row modalTexto">
                            Nombre(s)
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-person"></i></span>
                            <input type="text" class="form-control" name="names" placeholder="Nombre(s)"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>


                        <div class="row modalTexto">
                            Apellido(s)
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i
                                    class="bi bi-file-person-fill"></i></span>
                            <input type="text" class="form-control" name="lastName" placeholder="Apellido(s)"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="row modalTexto">
                            Nombre de usuario
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="row modalTexto">
                            Contraseña
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia"
                                placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>
                        <p style="font-size: small;">La contraseña debe de incluir 8 caracteres al menos, y debe incluir
                            una mayúscula, un carácter especial, y un número al menos.
                        <p>

                        <div class="row modalTexto">
                            Confirmar Contraseña
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="confirmar_contrasenia"
                                name="confirmar_contrasenia" placeholder="Contraseña" aria-label="Username"
                                aria-describedby="basic-addon1" required>
                        </div>

                        <div class="row modalTexto">
                            Fecha de nacimiento
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control" name="Birthday" placeholder="Fecha de nacimiento"
                                aria-label="Fecha de nacimiento" aria-describedby="basic-addon1">
                        </div>

                        <div class="row modalTexto">
                            Sexo:
                        </div>
                        <div class="input-group mb-3">
                            <div class="dropdown input-group-text" id="basic-addon1">
                                <button class="btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Selecciona aquí:
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a href=" " class="dropdown-item SexoUsuario">Hombre</a></li>
                                    <li><a href=" " class="dropdown-item SexoUsuario">Mujer</a></li>
                                    <li><a href=" " class="dropdown-item SexoUsuario">Otro</a></li>
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="gender-user" id="gender-user"
                                placeholder="Sexo" aria-label="Sexo" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="row modalTexto">
                            Foto de perfil
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-camera"> </i></span>
                            <input type="file" onchange="vista_preliminar2(event)" class="form-control" id="userIMG"
                                name="userIMG" placeholder="Foto de perfil" aria-label="Username"
                                aria-describedby="basic-addon1">


                        </div>
                        <div class="d-flex justify-content-center"><img src="" alt="" id="img-foto2" width="250px"
                                height="250px"></div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="ButtonRegistro">Registrar Alumno</button>
                        <button type="submit" class="btn btn-success" id="ButtonRegistro">Registrar Instructor</button>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>

</html>