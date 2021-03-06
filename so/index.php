<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>M5E</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">



</head>

<body id="page-top">



    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navegador</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Modelo de 5 Estados</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Leer</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Resultado</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Lista</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Grupo</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
<?php

?>
<div id="resultado"></div>
        
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">
                   <?php echo "Modelo de 5 estados"; ?></h1>
                <hr>
                <!-- <p>Ingrese un archivo con extensión .txt y la cantidad de ciclos que desea ejecutar</p> -->
                <a href="#about" class="btn btn-primary btn-xl page-scroll" id="a-comencemos">¡Comencemos!</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
          
        <div class="container">
            
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <table>
                        <tr>
                            <td>
                               <p> Ingrese url de archivo con extensión .txt:</p>
                            </td>
                            <td>
                                <input type="text" id="txt-archivo"   style="color: #F05F40; font-size:20px;">
                            </td>   
                        </tr>
                        <tr>
                            <td>
                                <p>Ingrese la cantidad de ciclos que ejecutará:</p>
                            </td>
                            <td>
                                <input type="text" id="txt-ciclos"   style="color: #F05F40; font-size:20px;">
                            </td>   
                        </tr>
                       
                    </table>
                    
                     
                    <!-- <h2 class="section-heading">We've got what you need!</h2> -->
                    <!-- <hr class="light"> -->
                    <!-- <p class="text-faded">Start Bootstrap has everything you need to get your new website up and running in no time! All of the templates and themes on Start Bootstrap are open source, free to download, and easy to use. No strings attached!</p> -->
                    <a href="#services" id="btn-procesar" class="page-scroll btn btn-primary btn-xl sr-button">¡Procesa!</a>

                          

                </div>
            </div>
        </div>
    </section>

       
        

    <section id="services">

         <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Resultado</h2>
                    <hr class="secundary"> <!-- linea horizontal roja -->
                </div>
            </div>
        </div>

        <div class="container" id="resultaditos">
            <div class="row">

                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box" >
                        <a  href="#" data-toggle="modal" data-target="#bloque-control" aria-hidden="true" id="a-bcp">
                                  <i class="fa fa-4x fa-newspaper-o sr-icons"></i>
                       
                                   <h3> Bloque de Control de Procesos</h3> 
                                  </a>

                        <p class="text-muted">Puedes conocer la información de todos los procesos</p>
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <a href="#" data-toggle="modal" data-target="#modal-listos" id="a-listos">
                            <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                            <h3>Listos</h3>
                        </a>
                            <p class="text-muted">Conoce los procesos listos</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                       <a href="#" data-toggle="modal" data-target="#modal-ejecutando" id="a-ejecutando"> 
                            <i class="fa fa-4x fa-car text-primary sr-icons"></i>
                            <h3>Ejecutando</h3>
                        </a>
                        <p class="text-muted">Proceso que está ejecutandose</p>
                   </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <a href="#" data-toggle="modal" data-target="#modal-bloqueado" id="a-bloqueado">
                            <i class="fa fa-4x fa-times text-primary sr-icons"></i>
                            <h3>Bloqueado</h3>
                        </a>
                        <p class="text-muted">Procesos bloqueados, y su razón</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <a href="#" data-toggle="modal" data-target="#modal-salida" id="a-salida">
                            <i class="fa fa-4x fa-check text-primary sr-icons"></i>
                            <h3>Salida</h3>
                        </a>
                        <p class="text-muted">Procesos que han terminado</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 text-center">
                    <div class="service-box">
                        <a href="#" data-toggle="modal" data-target="#modal-informacion" id="a-informacion">
                            <i class="fa fa-4x fa-question-circle-o text-primary sr-icons"></i>
                            <h3>Explicación</h3>
                        </a>
                          <p class="text-muted">Información básica sobre el proyecto</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery" >
                <div class="col-lg-4 col-sm-6" id="BCP">
                    <a href="img/portfolio/fullsize/bcp.png" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/bcp.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">

                                <div class="project-category text-faded">
                                    BLoque de Control de procesos
                                </div>
                                <div class="project-name">
                                    Información general de los procesos que han estado en el archivo
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6" id="nuevo">
                    <a href="img/portfolio/fullsize/nuevo.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/nuevo.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Nuevo
                                </div>
                                <div class="project-name">
                                    Procesos que han sido creados
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6" id="listo">
                    <a href="img/portfolio/fullsize/listo.png" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/listo.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Listo
                                </div>
                                <div class="project-name">
                                    Procesos que están listos esperando su turno para poder entrar en ejecutando según su prioridad
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6" id="ejecutando">
                    <a href="img/portfolio/fullsize/ejecutando.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/ejecutando.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Ejecutando
                                </div>
                                <div class="project-name">
                                    Proceso que está siendo leído por el procesador y siendo ejecutado el mismo
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6" id="bloqueado">
                    <a href="img/portfolio/fullsize/bloqueado.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/bloqueado.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Bloqueado
                                </div>
                                <div class="project-name">
                                    Proceso que ha sido detenido por un evento externo.
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6" id="salida">
                    <a href="img/portfolio/fullsize/clipboard.png" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/clipboard.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Salida
                                </div>
                                <div class="project-name">
                                    Lista de procesos que han sido terminados
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="row">
                
                <div class="col-lg-12 col-md-6 text-center">
                    <h2>Proyecto de Sistemas Operativos I</h2>
                    <div class="service-box">
                        <i style="color:#FFFFFF" class="fa fa-4x fa-graduation-cap text-primary sr-icons"></i>
                        <!-- <h3>Explicación</h3> -->
                        <!-- <p class="text-muted">Información básica sobre el proyecto</p> -->
                    </div>
                </div>
                <!-- <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Download Now!</a> -->
            </div>
        </div>
    </aside>
    
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Grupo #6</h2>
                    <hr class="primary">
                    <p>Lidis Stephanie Cordón Hernández 20141002866</p>
                    <p>Ana Raquel Andino Medina 20141002866</p>
                    <p>Ana Iris Padilla Maradiaga 20141006787</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-university fa-3x sr-contact"></i>
                    <p>Sección: 14000</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-calendar-check-o fa-3x sr-contact"></i>
                    <p>I Periodo 2017</p>
                </div>
            </div>
        </div>
    </section>
     
<div id="div-modales">
    
    <div style="padding:50px 50px 50px 50px">
    <!-- modal para el bloque de control--> 
    <div class="modal fade" tabindex="-1" role="dialog" id="bloque-control" style="padding: 10px 10px 10px 10px">
      <div class="modal-dialog" role="document" style="width:45%">
        <div class="modal-content" style="padding: 10px 10px 10px 10px">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Bloque De Control De Proceso</h4>
          </div>
          <div class="modal-body table-responsive" style="padding: 10px 20px 20px 20px">
            <!-- <section> -->

            <div style="padding: 20px 20px 20px 20px">
                  <table>
                    <tr>
                        <td>Proceso aceptado:  </td>
                        <td><i class="fa fa-check" style="color:#009900" aria-hidden="true"></i></td>

                    </tr>
                    <tr>
                        <td>Proceso rechazado: </td>
                        <td><i class='fa fa-exclamation-triangle' style='color:#F5CB03' aria-hidden='true'></i></td>
                        
                    </tr>
                    <tr>
                        <td> Procesos excluidos </td>
                        <td><i class="fa fa-close" style="color:#CC0000" aria-hidden="true"></i></td>
                    </tr>

                </table>
                <br>
                <table>
                    <tr>
                        <td> NOTA: existen procesos excluidos cuando el número de procesos excede de 10</td>
                    </tr>
                </table>
            </div>
            <!-- </section> -->
            

            <div id="tr-bcp" style="width:100%">



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

    <!-- modal listos--> 
   <div style="padding:50px 50px 50px 50px">
       
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-listos" aria-hidden="true" style="padding: 10px 10px 10px 10px">
      <div class="modal-dialog" role="document" style="width:45%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Listos</h4>
          </div>
          <div class="modal-body table-responsive" style="padding: 10px 20px 20px 20px">

            <div style="padding: 30px 30px 30px 30px">
            <div id="tr-listo" style="width:100%"></div>
            <div id="div-listos"></div>
              
            </div>
            <!-- </section> -->
            

            


          </div>
          <div class="modal-footer">
            <button type="button" id='btn-ejecutar' style="display: inline; " class="btn btn-default" data-dismiss="modal">Ejecutar</button>
          
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   </div>

    <!-- modal Ejecutando--> 
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-ejecutando" aria-hidden="true" style="padding: 10px 10px 10px 10px">
      <div class="modal-dialog" role="document" style="width:45%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ejecutando</h4>
          </div>
          <div class="modal-body">

                 <div style="padding: 30px 30px 30px 30px">

                    <div id="duv-ejec" style="width:100%"></div>
                    <div id="div-ejecutando"></div>
                      
                    </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal Bloqueado--> 
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-bloqueado" aria-hidden="true" style="padding: 10px 10px 10px 10px">
      <div class="modal-dialog" role="document" style="width:45%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Bloqueado</h4>
          </div>
          <div class="modal-body">
                        <div style="padding: 30px 30px 30px 30px">

                                <div id="" style="width:100%"></div>
                                <div id="div-bloqueado"></div>
                                  
                                </div>
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!-- modal Terminado--> 


<!-- <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Esto es un modal</h4>
            </div>
            <div class="modal-body">
                Texto del modal
            </div>
        </div>
    </div>
</div>
 -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modal-salida" aria-hidden="true" tyle="padding: 10px 10px 10px 10px">
      <div class="modal-dialog" role="document" style="width:45%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Salida</h4>
          </div>
          <div class="modal-body">
            <div style="padding: 30px 30px 30px 30px">

                                <div id="" style="width:100%"></div>
                                <div id="div-salida"></div>
                                  
                                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
<!-- modal informacion--> 
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-informacion">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Informacion</h4>
          </div>
          <div class="modal-body">
            <p>
                ¡GRACIAS POR SU VISITA!
                
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="js/acciones.js"></script>
   
    <script src="js/creative.min.js"></script>
    




</body>

</html>
