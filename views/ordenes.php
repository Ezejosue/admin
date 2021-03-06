<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Ordenes');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-12 col-md-10 recent-report2 text-center">
                <h3 class="title-3 text-center">Seleccione una mesa</h3>
                <br>
                <form action="post" id="data-mesas">
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
<!-- Modal de Agregar -->
<div class="modal fade" id="modal-orden">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ORDEN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-orden">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <a href="#modal-agregar" class="btn btn-success modal-trigger" data-toggle="modal"
                                style="border-radius: 20px; margin: 15px;" data-tooltip="tooltip" data-placement="right"
                                title="Agregar productos"><i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-sm-2 col-md-2" id="boton-modificar-mesa" name="boton-modificar-mesa">
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <input type="text" id="pre-pedido" name="pre-pedido">
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="row">
                                <h6 class="">MESA: #</h6>
                                <h6 id="mesa"> </h6>
                            </div>

                            <div class="row">
                                <h6 class="">TOTAL A PAGAR: $</h6>
                                <h6 id="total"> </h6>
                            </div>
                            <div class="row" id="boton-pago">

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>SUBTOTAL</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody id="prepedido">
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>

<div class="modal fade" id="modal-agregar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PRODUCTOS A AGREGAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-agregar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div id="lista-categorias" class="list-group">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div data-spy="scroll" data-target="#lista">
                                <div class="row" id="productos">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-modificar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MODIFICAR CANTIDAD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-modificar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <input type="text" class="form-control" id="nueva_cantidad" name="nueva_cantidad">
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 text-center" id="ingresar_cantidad">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-modificar-mesa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MOVER ORDEN A OTRA MESA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h3 class="title-3 text-center">Seleccione una mesa</h3>
            <br>
            <form action="post" id="data-modificar-mesas">
            </form>
        </div>
    </div>
</div>

<?php
Dashboard::footerTemplate('ordenes.js', '');
?>
</body>

</html>