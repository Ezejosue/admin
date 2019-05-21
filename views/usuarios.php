<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/extras/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../resources/extras/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../resources/extras/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../resources/css/imagen.css" rel="stylesheet" media="all">
    <link href="../resources/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="all">
    <link href="../resources/css/jquery.dataTables.min.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- SIDEBAR-->
        <?php
                require "../core/helpers/menu.php";
                sitepack::menu();
        ?>
            <!-- Fin SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container2">
                <!-- Menu Responsive-->
                <header class="header-desktop2">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap2">
                                <div class="logo d-block d-lg-none">
                                    <a href="inicio.php">
                                        <img src="../resources/img/logo.png" alt="PizzaNova" />
                                    </a>
                                </div>

                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                    <div class="logo">
                        <a href="#">
                            <img src="../resources/img/logo.png" alt="PizzaNova" />
                        </a>
                    </div>
                    <div class="menu-sidebar2__content js-scrollbar2">
                        <div class="account2">
                            <div class="image img-cir img-120">
                                <img src="../resources/img/icon/avatar-big-01.jpg" alt="John Doe" />
                            </div>
                            <h4 class="name">john doe</h4>
                            <a href="index.php">Cerrar Sesión</a>
                        </div>
                        <nav class="navbar-sidebar2">
                            <ul class="list-unstyled navbar__list">
                                <li>
                                    <a href="inicio.php">
                                        <i class="fas fa-tachometer-alt"></i>Vista General
                                        <span class="arrow">

                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="perfil.php">
                                        <i class="fas fa-user-circle"></i>Perfil</a>

                                </li>
                                <li>
                                    <a href="categorias.php">
                                        <i class="fas fa-list"></i>Categorías</a>
                                </li>
                                <li>
                                    <a href="productos.php">
                                        <i class="fas fa-shopping-basket"></i>Productos</a>
                                </li>
                                <li>
                                    <a href="usuarios.php">
                                        <i class="fas fa-users"></i>Usuarios</a>
                                </li>
                                <li>
                                    <a href="empleados.php">
                                        <i class="fas fa-id-card"></i>Empleados</a>
                                </li>
                                </li>
                                <li>
                                    <a href="reportes.php">
                                        <i class="fas fa-chart-bar"></i>Reportes</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <!-- Fin Menu Responsive-->
                <br>
                <!-- Contenido-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="row">
                            <div class="col-sm-1 col-3">
                                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal" data-tooltip="Agregar">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="container">
                                <table class="display" id="tabla-usuarios">
                                    <thead>
                                        <tr>
                                            <th>NOMBRES</th>
                                            <th>APELLIDOS</th>
                                            <th>CORREO</th>
                                            <th>USUARIO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-read">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modals-->
                    <!-- Modal de Agregar -->
                    <div class="modal fade" id="modal-create">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">AGREGAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="form-create">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_nombres" type="text" name="create_nombres" class="validate form-control" placeholder="Nombres" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_apellidos" type="text" name="create_apellidos" class="validate form-control" placeholder="Apellidos" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-user-shield"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_alias" type="text" name="create_alias" class="validate form-control" placeholder="Nombre De Usuario" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_clave1" type="password" name="create_clave1" class="validate form-control" placeholder="Contraseña" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <input id="create_clave2" type="password" name="create_clave2" class="validate form-control" placeholder="Repetir contraseña"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-box-open"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <select id="create_tipo" name="create_tipo" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-image"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="create_archivo" name="create_archivo">
                                                    <label class="custom-file-label" for="create_archivo">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa fa-eye-slash"></i>
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="create_estado" name="create_estado">

                                                    <label class="custom-control-label" for="create_estado">
                                                        <i class="fa fa-eye"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body text-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary tooltipped" data-tooltip="Crear">Aceptar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Modificar -->
                    <div class="modal fade" id="ventana2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">MODIFICAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="preview1">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    <button id="triggerUpload1" class="btn btn-primary">
                                                        <i class="fa fa-magic"></i>
                                                        Subir imagen</button>
                                                    <input type="file" id="filePicker1" />
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input type="email" id="inputEmail" class="form-control" placeholder="Correo" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input type="date" min="1950-01-01" max="2001-01-01" placeholder="Fecha de nacimiento" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Nombre de usuario" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Teléfono" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <select class="custom-select" id="inlineFormCustomSelectPref">
                                                <option selected>Género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa fa-map-marker-alt"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <input placeholder="Dirección" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Eliminar -->
                    <div class="modal fade" id="ventana3">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ELIMINAR USUARIO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Está seguro de que desea eliminar este usuario?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Jquery JS-->
                    <script src="../resources/js/jquery-3.2.1.min.js"></script>
                    <!-- Bootstrap JS-->
                    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
                    <!-- Vendor JS-->
                    <script src="../resources/extras/animsition/animsition.min.js"></script>
                    <script src="../resources/extras/perfect-scrollbar/perfect-scrollbar.js"></script>
                    <!-- Main JS-->
                    <script src="../core/helpers/table.js"></script>
                    <script src="../resources/js/main.js"></script>
                    <script src="../resources/js/jquery.dataTables.min.js"></script>
                    <script src="../resources/js/dataTables.bootstrap4.min.js"></script>

                    <script src="../resources/js/sweetalert.min.js"></script>
                    <script type="text/javascript" src="../core/helpers/functions.js"></script>
                    <script type="text/javascript" src="../core/controllers/account.js"></script>
                    <script type="text/javascript" src="../core/controllers/usuarios.js"></script>
</body>

</html>