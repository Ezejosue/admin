<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Empleados');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-1 col-3">
                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tabla-empleados" width="100%">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>DUI</th>
                                <th>DIRECCIÓN</th>
                                <th>FECHA</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-read">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals-->
    <!-- Modal de Agregar -->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR EMPLEADO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-create" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_nombre" type="text" name="create_nombre" class="validate form-control"
                                    placeholder="Nombre De Empleado" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_apellido" type="text" name="create_apellido"
                                    class="validate form-control" placeholder="Apellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_dui" type="text" name="create_dui" class="validate form-control"
                                    validate min="00000000" placeholder="00000000-0" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-street-view"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_direccion" type="text" name="create_direccion"
                                    class="validate form-control" placeholder="Dirección" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_telefono" type="text" name="create_telefono"
                                    class="validate form-control" placeholder="0000-0000" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-venus-mars"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_genero" type="text" name="create_genero" class="validate form-control"
                                    placeholder="M/F" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_fecha" type="date" min="01/01/1952" max="01/01/2001" name="create_fecha" class="validate form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fab fa-font-awesome-flag"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_nacionalidad" type="text" name="create_nacionalidad"
                                    class="validate form-control" placeholder="Nacionalidad" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-at"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_email" type="text" name="create_email" class="validate form-control"
                                    placeholder="@mail.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-male"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_cargo" name="create_cargo" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_usuario" name="create_usuario" class="form-control">
                                </select>
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
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR EMPLEADO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-update" enctype="multipart/form-data">
                    <input type="hidden" id="id_empleado" name="id_empleado" />
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_nombre" type="text" name="update_nombre"
                                        class="validate form-control" placeholder="Nombre De Empleado" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_apellido" type="text" name="update_apellido"
                                        class="validate form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_dui" type="text" name="update_dui" class="validate form-control"
                                        placeholder="00000000-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-street-view"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_direccion" type="text" name="update_direccion"
                                        class="validate form-control" placeholder="Dirección" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_telefono" type="text" name="update_telefono"
                                        class="validate form-control" validate placeholder="0000-0000" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_genero" type="text" name="update_genero"
                                        class="validate form-control" placeholder="M/F" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_fecha" type="date" name="update_fecha"
                                        class="validate form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fab fa-font-awesome-flag"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_nacionalidad" type="text" name="update_nacionalidad"
                                        class="validate form-control" placeholder="Nacionalidad" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-at"></i>
                                </div>
                                <div class="col-sm-11">
                                    <input id="update_email" type="text" name="update_email"
                                        class="validate form-control" placeholder="@mail.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="update_cargo" name="update_cargo" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="col-sm-11">
                                    <select id="update_usuario" name="update_usuario" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary tooltipped"
                                data-tooltip="Crear">Aceptar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <?php
Dashboard::footerTemplate('empleados.js', '#tabla-empleados');
?>
    <!-- validaciones del lado del cliente en el modal de agregar empleados -->

    <script>
        bootstrapValidate("#create_dui", "min:9:Ingrese su DUI completo.", "max:9:Ingrese su DUI completo.")
    </script>
    <script>
        bootstrapValidate("#create_direccion", "min:5:Ingrese una dirección mayor a 5 caracteres",
            "max:30:Ingrese una dirección menor de 30 caracteres")
    </script>
    <script>
        bootstrapValidate("#create_telefono", "min:8:Ingrese un telefono mayor a 8 caracteres",
            "max:12:Ingrese un telefono menor de 12 caracteres")
    </script>
    <script>        
        bootstrapValidate("#create_nacionalidad", "min:3:Ingrese una nacionalidad mayor a 3 caracteres",
            "max:80:Ingrese una nacionalidad menor de 80 caracteres")
    </script>
    <script>
        bootstrapValidate('#create_email', 'email:Ingrese un email valido')
    </script>



    <!-- validaciones del lado del cliente en el modal de modificar empleados -->
    <script>
        bootstrapValidate("#update_nombre", "min:3:Ingrese un nombre mayor a 3 caracteres",
            "max:30:Ingrese un nombre menor de 30 caracteres")
    </script>

    <script>
        bootstrapValidate("#update_dui", "min:9:Ingrese su DUI completo.", "max:9:Ingrese su DUI completo.")
    </script>
   
    <script>
        bootstrapValidate("#update_telefono", "min:8:Ingrese un telefono mayor a 8 caracteres",
            "max:12:Ingrese un telefono menor de 12 caracteres")
    </script>
    <script>
        bootstrapValidate("#update_nacionalidad", "min:3:Ingrese una nacionalidad mayor a 3 caracteres",
            "max:80:Ingrese una nacionalidad menor de 80 caracteres")
    </script>
    <script>
        bootstrapValidate("#update_email", "email:Ingrese un email valido")
    </script>

    </body>

    </html>