<nav id="mainNav primary_nav_wrap" class="navbar navbar-default navbar-fixed-top" style="background-color:black;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand page-scroll" href="/">Optica Santa Rita</a>
            <?php if(isset($_SESSION['rol'])) {?>
                <div class="flexsearch">
                    <div class="flexsearch--wrapper">
                        <form class="flexsearch--form" action="#" method="post">
                            <div class="flexsearch--input-wrapper">
                                <input class="flexsearch--input" type="search" placeholder="search">
                            </div>
                            <input class="flexsearch--submit" type="submit" value="&#10140;">
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php if(isset($_SESSION['rol'])) {?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <nav id="primary_nav_wrap">
                    <ul class="nav navbar-nav navbar-right " >
                        <li>
                            <a class="page-scroll" style="color:white" href="/">Inicio</a>
                        </li>
                        <li>
                            <a class="page-scroll" style="color:orange" href="/"><?= $_SESSION['nombre'],' ', $_SESSION['apellido'] ?> </a>
                            <ul>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/vista/clientes/">Clientes</a>
                                </li>
                            </ul>   
                        </li>
                        <li>
                            <a class="page-scroll" style="color:white" href="">Facturacion</a>
                            <ul>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/pdf/pdfplantilla"  target="_blank">PDF Plantilla</a>
                                </li>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/pdf/pdfvista"  target="_blank">PDF <?= $_SESSION['nombre'],' ', $_SESSION['apellido']?></a>
                                </li>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/vista/facturasimple/">Simple</a>
                                </li>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/pdf/pdfsimple">Simple1</a>
                                </li>
                                <li>
                                    <a class="page-scroll" style="color:white" href="">Cliente Registrado</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="page-scroll botonimagen" style="background-image: url(<?= URL_IMG . 'Iconos/menu.png' ?>);" href=""></a>
                            <ul>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/vista/registrar/">Registrar Cliente</a>
                                </li>
                                <li>
                                    <a class="page-scroll" style="color:white" href="/vista/registrlente/">Registrar Lente Del Cliente </a>
                                </li>
                            </ul>
                        </li>               
                        <li>
                            <a class="page-scroll" style="color:white" href="/sesion/terminar">salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php }else{ ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" id="primary_nav_wrap">
                <nav id="primary_nav_wrap">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" style="color:white" href="/">Inicio</a>
                        </li>
                        <li>
                            <a class="page-scroll" style="color:white" href="/vista/iniciar">Iniciar Sesion</a>
                        </li>
                        <li>
                        </ul>
                    </nav>
                </div>


            <?php } ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <?php if(isset($notifiaciones)) { ?>
        <!-- Modal -->

        <div class="modal fade" id="notiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">NOTIFICACIONES</h4>
                    </div>
                    <div class="modal-body">
                        <?php foreach($notifiaciones as $notificacion){ ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            MENSAJE
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-chico">
                                            <?= $notificacion->getMensaje() ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <form method="post" action="/notificacion/eliminar">
                                <input type="hidden" name="id" value=<?= $notificacion->getId() ?>>
                                <button type="submit" style="border-color: black" class="btn btn-danger">ELIMINAR NOTIFICACION</button>
                            </form>
                        <?php } ?>

                    </div>
                    <div class="modal-footer">

                        <button type="button" style="border-color: black" class="btn btn-success" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>