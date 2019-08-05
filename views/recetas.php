<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Recetas');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-3">
                <a href="#modal-create" class="btn btn-success tooltipped modal-trigger" data-toggle="modal"
                    data-tooltip="Agregar">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="container">
                <table class="display" id="tabla-recetas">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>TIEMPO</th>
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
                    <h5 class="modal-title">AGREGAR RECETAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-create">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="col-sm-11">
                                <input placeholder="Nombre de receta" class="form-control" id="create_nombre"
                                    name="create_nombre" for="nombre_receta" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="col-sm-11">
                                <input placeholder="Tiempo de elaboración" class="form-control" id="create_tiempo"
                                    name="create_tiempo" for="tiempo" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Modal de agregar materias primas -->
    <div id="modal-materiasprimas" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">AGREGAR MATERIAS PRIMAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-materiasprimas">
                    <input type="hidden" id="id_receta" name="id_receta" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="col-sm-11">
                                <select id="id_materias" name="id_materias" class="form-control" required>

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
                                <input id="cantidad_materia" type="number" max="9999" min="1" name="cantidad_materia"
                                    class="validate form-control" placeholder="Cantidad" required>
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
    <!-- Modal de Eliminar -->
    <div class="modal fade" id="ventana3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ELIMINAR CATEGORÍA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>¿Está seguro de que desea eliminar esta categoría?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
Dashboard::footerTemplate('recetas.js', '#tabla-recetas');
?>

<script>
        bootstrapValidate("#create_nombre", "min:9:Campo obligatorio (solo letras)");

        bootstrapValidate("#create_tiempo", "min:9:Campo obligatorio (solo letras)");

        bootstrapValidate("#id_materias", "min:1:Seleccione una opción");

        bootstrapValidate("#cantidad_materia", "min:1:Ingrese la cantidad de materia");
        bootstrapValidate("#cantidad_materia", "max:4:Ingrese la cantidad de correctamente");

    </script>