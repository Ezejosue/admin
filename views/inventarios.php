<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Proveedores');
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
            <div class="col-sm-1 col-3">
                <a href="#modal-create-factura" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        AGREGAR FACTURA
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tabla-inventarios" width="100%">
                        <thead>
                            <tr>
                                <th>FACTURA</th>
                                <th>MATERIA PRIMA</th>
                                <th>CANTIDAD</th>
                                <th>PROVEEDOR</th>
                                <th>FECHA DE INGRESO</th>
                                <th>RESPONSABLE</th>
                                <th>ACCIONES</th>
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
    <!-- Modal de Agregar facturas -->
    <div class="modal fade" id="modal-create-factura">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR FACTURA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="tyrue">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-create-factura" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_correlativo" type="text" name="create_correlativo"
                                    class="validate form-control" placeholder="Correlativo Ej.(000000001)" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_proveedor" name="create_proveedor" class="form-control" required>
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
    <!-- Modal de Agregar productos al inventario -->
    <div id="modal-create" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">INGRESO AL INVENTARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-create" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_factura" name="create_factura" class="form-control" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="create_materia" name="create_materia" class="form-control" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="create_cantidad" type="number" name="create_cantidad"
                                    class="validate form-control" placeholder="Cantidad"required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                            <input id="create_precio" type="number" name="create_precio"
                                    class="validate form-control" placeholder="0.00" max="999.99" min="0.01" required />
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
    <div id="modal-update" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR PROVEEDOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="was-validated" method="post" id="form-update" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" id="id_proveedor" name="id_proveedor" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_proveedor" type="text" name="update_proveedor"
                                    class="validate form-control" placeholder="Proveedor" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_contacto" type="text" name="update_contacto"
                                    class="validate form-control" placeholder="Nombre de contacto" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <input id="update_telefono" type="text" name="update_telefono"
                                    class="validate form-control" placeholder="Teléfono Ej.(2222-2222)"required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-eye-slas    h"></i>
                            </div>
                            <div class="col-sm-11">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="update_estado"
                                        name="update_estado">
                                    <label class="custom-control-label" for="update_estado">
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
    <?php
Dashboard::footerTemplate('inventarios.js', '#tabla-inventarios');
?>

    <!-- validaciones del lado de cliente para agregar materias primas -->
    <script>
        bootstrapValidate("#create_nombre_materia", "min:3:Ingrese un nombre mayor a 3 caracteres");
        bootstrapValidate("#create_nombre_materia", "max:10:Ingrese un nombre menor a 10 caracteres");

        bootstrapValidate("#create_descripcion_materia", "min:6:Ingrese una descripción mayor de 6 caracteres");
        bootstrapValidate("#create_descripcion_materia", "max:80:Ingrese una descripción menor a 80 caracteres");

        bootstrapValidate("#create_cantidad", "min:1:Ingrese una cantidad válida");
        bootstrapValidate("#create_cantidad", "max:6:Ingrese una cantidad válida");

        bootstrapValidate("#nombre_materia", "min:3:Ingrese un nombre mayor a 3 caracteres");
        bootstrapValidate("#nombre_materia", "max:10:Ingrese un nombre menor a 10 caracteres");

        bootstrapValidate("#descripcion_materia", "min:6:Ingrese una descripción mayor de 6 caracteres");
        bootstrapValidate("#descripcion_materia", "max:80:Ingrese una descripción menor a 80 caracteres");

        bootstrapValidate("#cantidad", "min:1:Ingrese una cantidad válida");
        bootstrapValidate("#cantidad", "max:6:Ingrese una cantidad válida");
    </script>

    </body>

    </html>