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
    <link href="css/index.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>

<body>

    <?php
    if ($_SESSION != NULL) { // Si mi sesion no es nula significa que un usuario inicio sesion
        echo '<input type="hidden" value="' . $_SESSION['Usuario_id'] . '" id="miUserIdActual">'; // Valor del id del usuario en un campo invisible
    }
    ?>

    <div id="miPagina" class="pb-4">
        <!--                 NAVBAR                 -->
        <nav class="navbar sticky-top navbar-expand-lg navbar-light">
            <div class="container">
                <img src="img/cripto.png" width="70px">
                <a class="navbar-brand fs-4 p-4 fw-bold" href="index.php">CryptCourse</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i> Categorías
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="misCategoriasNav">


                            </ul>
                        </li>

                    </ul>
                    <form class="d-flex me-2" role="search">
                        <input class="form-control " type="search" id="miTextoBuscarCursos" placeholder="Buscar"
                            aria-label="Buscar">
                        <button class="btn btn-outline-primary" type="button" id="buscarSearchCursos"><i
                                class="bi bi-search"></i></button>

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
                                                  aria-expanded="false">
                                                  <img src="" id="pfp" class="pfp rounded-circle">
                                            </div>
                                            <ul class="dropdown-menu p-3" aria-labelledby="DatosUser">
                                            <li class="misDatosUser">
                                                <div class="d-flex flex-row miImagen">
                                                    <div class="p-1">
                                                        <img src="" id="pfp2" class="pfp rounded-circle">
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
                                            <li><a class="dropdown-item" href="" data-bs-toggle="modal"data-bs-target="#miModalEditUser"><i class="pe-1 bi bi-pen"></i> Editar Perfil</a>
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
        <div id="miCursoDetalle" class="mt-2">
            <div class="container" id="miInfoCurso">

            </div>
            <hr class="solid">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"  id="mostrarContenido">Contenido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"  id="mostrarValoracion">Valoraciones</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" aria-current="page" id="mostrarInstructor">Instructor</a>
                </li>
            </ul>
            <!-- MI ACORDEON -->
            <div id="miContenido" class="container">
            </div>
            <!-- MIS VALORACIONES -->
            <div id="Valoraciones" class="container">
                <hr class="solid">
                <h4>Comentarios y valoraciones de los estudiantes </h4>
                <hr class="solid">
                <div id="misValoraciones" class="list-group p-2">
                   
                </div>
            </div>
            <!-- MI INSTRUCTOR -->
            <div id="Instructor" class="container">

            </div>
        </div>
        <div id="cursoSearch" class="container">
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Resultados de la busqueda</b></div>
            <hr class="solid">
            <div class="d-flex justify-content-center" id="miAlertaBusqueda"></div>
            <section class="post-list">
                <div class="content" id="misCursosSearch">
                </div>
            </section>
        </div>
        <div class="container" id="misCursosIndex">

            <!--                 CURSOS MEJORES CALIFICADOS                 -->
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Cursos mejores calificados</b></div>
            <hr class="solid">
            <div id="miAlertCursosMejoresCalificados"></div>
            <section class="post-list">
                <div class="content" id="misCursosMejoresCalificados">
                </div>
            </section>

            <!--                 CURSOS MAS VENDIDOS                 -->
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Cursos mas vendidos</b></div>
            <hr class="solid">
             <div id="miAlertCursosMasVendidos"></div>
            <section class="post-list">
                <div class="content" id="misCursosMasVendidos">
                </div>



            </section>

            <!--                 CURSOS MAS RECIENTES                 -->
            <hr class="solid">
            <div class="row fs-4 product-title"><b>Cursos mas recientes</b></div>
            <hr class="solid">
            <div id="miAlertCursosMasRecientes"></div>
            <section class="post-list">
                <div class="content" id="misCursosMasRecientes">
                </div>
            </section>


        </div>
    </div>
    <!--  >MODAL WINDOW LOGIN<-->
    <div class="modal fade" id="miModalLogin" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
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
                        <input type="text" class="form-control" id="correoLogin" name="correoLogin" placeholder="Correo"
                            aria-label="correo" aria-describedby="basic-addon1">
                    </div>
                    <div class="separador"></div>
                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Contraseña
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="login_password" name="password"
                            placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1">
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
    <div class="modal fade" id="miModal" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
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
                        <input type="file" onchange="vista_preliminar2(event)" accept="image/jpeg" class="form-control"
                            id="userIMG" name="userIMG" placeholder="Foto de perfil" aria-label="Username"
                            aria-describedby="basic-addon1">

                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Correo Electrónico
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Nombre(s)
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-person"></i></span>
                        <input type="text" class="form-control" id="names" name="names" placeholder="Nombre(s)"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Apellido Paterno
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>
                        <input type="text" class="form-control" id="lastNameP" name="lastNameP"
                            placeholder="Apellido Paterno" aria-label="Username" aria-describedby="basic-addon1">
                    </div>


                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Apellido Materno
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-file-person-fill"></i></span>
                        <input type="text" class="form-control" id="lastNameM" name="lastNameM"
                            placeholder="Apellido Materno" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Nombre de usuario
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="usuario" name="usuario"
                            placeholder="Nombre de usuario" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Contraseña
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" name="contrasenia"
                            placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <p style="font-size: small;">La contraseña debe de incluir 8 caracteres al menos, y debe incluir
                        una mayúscula, un carácter especial, y un número al menos.
                    <p>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Confirmar Contraseña
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="confirmar_password" name="confirmar_password"
                            placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
                        Fecha de nacimiento
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"> <i class="bi bi-calendar"></i></span>
                        <input type="date" class="form-control" id="Birthday" name="Birthday"
                            placeholder="Fecha de nacimiento" aria-label="Fecha de nacimiento"
                            aria-describedby="basic-addon1">
                    </div>

                    <div class="row fw-bold fs-6 ms-3 mb-2">
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
                        <input type="text" class="form-control" name="gender-user" id="gender-user" placeholder="Sexo"
                            aria-label="Sexo" aria-describedby="basic-addon1" required>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="ButtonRegistroEstudiante">Registrar
                        Alumno</button>
                    <button type="button" class="btn btn-success" id="ButtonRegistroInstructor">Registrar
                        Instructor</button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#miModalLogin">Regresar</button>
                </div>
            </div>
        </div>
    </div>

    <!--  >MODAL EDIT USER<-->
    <div class="modal fade" id="miModalEditUser" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
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
                            <input type="file" onchange="vista_preliminarEdit(event)" accept="image/jpeg"
                                class="form-control" id="E_userIMG" name="E_userIMG" placeholder="Foto de perfil"
                                aria-label="Username" aria-describedby="basic-addon1">


                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Correo Electrónico
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>

                            <input type="text" class="form-control" id="E_email" name="E_email"
                                placeholder="Correo Electrónico" aria-label="Username" aria-describedby="basic-addon1"
                                value="">

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Contraseña
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="E_contrasenia" name="E_contrasenia"
                                placeholder="Contraseña" aria-label="Username" aria-describedby="basic-addon1" value="">

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
                            <input type="password" class="form-control" id="E_confirmarContrasenia"
                                name="E_confirmarContrasenia" placeholder="Contraseña" aria-label="Username"
                                aria-describedby="basic-addon1" value="">

                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Descripción
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i
                                    class="bi bi-file-person-fill"></i></span>

                            <textarea rows="8" class="form-control" id="E_descripcion" name="E_descripcion"
                                placeholder="Describete" aria-label="Username" aria-describedby="basic-addon1"
                                value=""></textarea>

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Nombre(s)
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-person"></i></span>
                            <input type="text" class="form-control" id="E_names" name="E_names" placeholder="Nombre(s)"
                                aria-label="Username" aria-describedby="basic-addon1" value="">

                        </div>


                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Apellido Paterno
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i
                                    class="bi bi-file-person-fill"></i></span>

                            <input type="text" class="form-control" id="E_lastNameP" name="E_lastNameP"
                                placeholder="Apellido Paterno" aria-label="Username" aria-describedby="basic-addon1"
                                value="">

                        </div>



                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Apellido Materno
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i
                                    class="bi bi-file-person-fill"></i></span>

                            <input type="text" class="form-control" id="E_lastNameM" name="E_lastNameM"
                                placeholder="Apellido Materno" aria-label="Username" aria-describedby="basic-addon1"
                                value="">

                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Sexo:
                        </div>
                        <div class="input-group mb-3">
                            <div class="dropdown input-group-text" id="basic-addon1">
                                <button class="btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Selecciona aquí:
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Hombre</a></li>
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Mujer</a></li>
                                    <li><a href=" " class="dropdown-item E_SexoUsuario">Otro</a></li>
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="gender-user" id="E_generoUsuario"
                                placeholder="Sexo" aria-label="Sexo" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="row fw-bold fs-6 ms-3 mb-2">
                            Fecha de nacimiento
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"> <i
                                    class="bi bi-file-person-fill"></i></span>

                            <input type="date" class="form-control" id="E_FechaNacimiento" name="E_FechaNacimiento"
                                placeholder="Fecha de Nacimiento" aria-label="Fecha Nacimiento"
                                aria-describedby="basic-addon1" value="">

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="EditUser">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--  >MODAL WINDOW METODO PAGO<-->
    <div class="modal fade" id="miModalMetodoPago" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Escoge un método de pago:</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="misMetodosPagoComprar">


                </div>
                <div class="modal-footer" id="miFooterMetodoPago">
                </div>
            </div>
        </div>
    </div>

    <!--  >MODAL WINDOW METODO PAGO<-->
    <div class="modal fade" id="miModalMetodoPagoNivel" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Escoge un método de pago:</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="misMetodosPagoComprarNivel">


                </div>
                <div class="modal-footer" id="miFooterMetodoPagoNivel">
                </div>
            </div>
        </div>
    </div>


    <!--  >MODAL WINDOW DETALLE PAGO-->
    <div class="modal fade" id="miModalDetallePago" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content p-1">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ms-4" id="modalTitle">Detalle Pago</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="metodoPagoDetalle">
                    <input type="hidden" id="cursoPagoDetalle">
                    <div id="miContenidoDetalle">

                        <div class="d-flex justify-content-end">
                            <div class="d-flex flex-column">
                                <div class="ps-2 pb-4 pe-4 fs-5 fw-bold">Nombre Metodo Pago</div>
                                <div class="ps-2 pt-4 fs-6">Total a pagar: 255.50 MXN</div>
                            </div>
                            <div class="p-2"><img class="rounded" width="200px" height="200px"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="RegistrarCursoConfirmar">Confirmar Compra</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>

    </div>

    <!--  >MODAL WINDOW DETALLE PAGO-->
    <div class="modal fade" id="miModalDetallePagoNivel" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content p-1">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold ms-4" id="modalTitle">Detalle Pago</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="nivelPagoDetalleNivel">
                    <input type="hidden" id="cursoPagoDetalleNivel">
                    <input type="hidden" id="metodoPagoDetalleNivel">
                    <div id="miContenidoDetallePagoNivel">


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="RegistrarNivelConfirmar">Confirmar Compra</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>

    </div>

    <!--  >MODAL WINDOW MENSAJES<-->
    <div class="modal fade" id="miModalMensaje" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle"
        data-bs-backdrop="static">
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
                                <p>Aqui iran el contenido de tus mensajes selecciona un chat de el lado izquierdo para
                                    continuar</p>
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

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>