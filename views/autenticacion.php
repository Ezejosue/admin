<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificar</title>
    <link href="../resources/img/logo.ico" rel="icon">

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/extras/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/extras/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/extras/animsition/animsition.min.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-logo">
                        <img src="../resources/img/logo.png" alt="PizzaNova" />
                    </div>
                    <div class="login-content">
                        <div class="login-form text-center">
                            <h4>VERIFICACIÓN DE DOS PASOS</h4>
                            <br>
                            <div class="row">
                                <div class="col-sm-4 md-4">
                                    <img src="../resources/img/phone.png" style="height: 100px">
                                </div>
                                <div class="col-sm-8 md-8">
                                    <p class="text-left">Introduce el código de verificación que ha sido enviado a tu
                                        correo electrónico.</p>
                                </div>
                            </div>
                            <br>
                            <form method="post" id="form-autenticacion">
                                <div class="row">
                                    <div class="col-sm-12 md-12">
                                        <input type="text" class="form-control" placeholder="Introduce el código"
                                            autofocus id="codigo" name="codigo">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-block btn-signin" type="submit">VERIFICAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/jquery-3.2.1.min.js"></script>
    <script src="../resources/extras/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
    <script src="../resources/extras/animsition/animsition.min.js"></script>
    <script type="text/javascript" src="../core/helpers/functions.js"></script>
    <script type="text/javascript" src="../core/controllers/autenticacion.js"></script>

</body>

</html>