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
    <title>CryptCourse| Página Principal</title>
    <link rel="shortcut icon" href="img\cripto.png">
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <script src="js/admin.js"></script>
    <link href="css/curso.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
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

        <div class="container">
            <hr class="solid">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="mostrarUsuarios"><i class="me-1 bi bi-person-fill"></i> Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"><i class="me-1 bi bi-list"></i> Categorias</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" id="mostrarCategorias"><i class="bi bi-eye"></i> Mostrar</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalCategoria"><i class="bi bi-plus-circle"></i> Agregar</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"><i class="me-1 bi bi-credit-card"></i> Método
                        Pago</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" id="mostrarMetodosPago"><i class="bi bi-eye"></i> Mostrar</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#miModalMetodoPago"><i class="bi bi-plus-circle"></i> Agregar</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <div id="misUsuariosBloqueados">
                <nav class="navbar navbar-light" id="buscarUsersBlock">
                    <div class="container-fluid">
                        <a class="navbar-brand fs-3 fw-bold p-2">Usuarios bloqueados</a>
                        <form class="d-flex">
                            <input class="form-control" type="search" placeholder="Buscar Usuario" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </nav>
                <hr class="solid">
                <div id="usuariosBloqueadosDashboard">
                </div>


            </div>
            <div id="misCategoriasAdmin">
                <nav class="navbar navbar-light" id="buscarUsersBlock">
                    <div class="container-fluid">
                        <a class="navbar-brand fs-3 fw-bold">Categorias</a>
                        <form class="d-flex">
                            <input class="form-control" type="search" placeholder="Buscar Categoria" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </nav>
                <hr class="solid">
                <div id="misCategoriasDashboard">


                </div>
            </div>
            <div id="misMetodosPago">
                <nav class="navbar navbar-light" id="buscarUsersBlock">
                    <div class="container-fluid">
                        <a class="navbar-brand fs-3 fw-bold">Método de pago</a>
                        <form class="d-flex">
                            <input class="form-control" type="search" placeholder="Buscar Método de pago" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </nav>
                <hr class="solid">
                <div id="misMetodosPagoDashboard">


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

    <!--  >MODAL WINDOW METODO DE PAGO<-->
    <div class="modal fade" id="miModalMetodoPago" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ms-4" id="modalTitle">Registro Método de Pago</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="row d-flex text-center pb-4">

                            <h5>Ingresa los datos:</h5>

                        </div>
                        <form method="POST">

                            <div class="image-upload d-flex justify-content-center p-2">
                                <label for="metodoIMG">
                                    <img src="img/camera.jpg" alt="" id="img-metPago" width="350px" height="275px">
                                </label>
                                <input type="file" onchange="vista_preliminarMetPago(event)" accept="image/jpeg" class="form-control" id="metodoIMG" name="metodoIMG" placeholder="Foto de perfil" aria-label="Username" aria-describedby="basic-addon1">

                            </div>

                            <div class="row fw-bold fs-6 ms-3 mb-2 mt-4">
                                Nombre del método
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card"></i></span>
                                <input type="text" class="form-control" id="nameMetodo" name="nameMetodo" placeholder="Metodo de pago" aria-label="Username" aria-describedby="basic-addon1">
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="ButtonRegistroMetodoPago">Registrar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  >MODAL WINDOW CATEGORIA<-->
    <div class="modal fade" id="miModalCategoria" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Registro categoría</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="mb-4 d-flex text-center row">

                            <h5>Ingresa los datos:</h5>

                        </div>
                        <form method="POST">
                            <div class="row fw-bold fs-6 ms-3 mb-2">
                                Nombre de Categoria:
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control" id="nameCategoria" name="nameCategoria" placeholder="Nombre de la categoría" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="row fw-bold fs-6 ms-3 mb-2">
                                Descripción de la categoría:
                            </div>

                            <textarea class="form-control" rows="5" id="descCategoria" name="descCategoria"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="ButtonRegistroCategoria" data-bs-dismiss="modal">Registrar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  >MODAL WINDOW EDITAR CATEGORIA<-->
    <div class="modal fade" id="miModalEditarCategoria" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Editar categoría</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" id="miCategoriaSeleccionada">
                        <div class="mb-4 d-flex text-center row">

                            <h5>Actualiza los datos:</h5>

                        </div>
                        <form method="POST">
                            <div class="row fw-bold fs-6 ms-3 mb-2">
                                Nombre de Categoria:
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control" id="E_nameCategoria" name="E_nameCategoria" placeholder="Nombre de la categoría" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="row fw-bold fs-6 ms-3 mb-2">
                                Descripción de la categoría:
                            </div>

                            <textarea class="form-control" rows="5" id="E_descCategoria" name="E_descCategoria"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="ButtonActualizarCategoria" data-bs-dismiss="modal">Actualizar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
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
                        Nombre de usuario"
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
    <footer class="w-100 d-flex justify-content-center flex-wrap">
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