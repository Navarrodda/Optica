

<!-- Section Intro Slider
  ================================================== -->
  <?php  include(URL_VISTA . 'navbar.php') ?>

  <div id="tm-wrap">
    <div class="tm-main-content">
      <div class="container tm-site-header-container" >
       <?php if(isset($this->mensaje)) {?>
        <div class="container">
          <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
        </div>
      <?php } ?>
      <div class="row">
        <div class="col-sm-12 col-md-11 col-lg-9 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-col">
          <?php if(isset($_SESSION['rol'])) {?>
            <?php if(($_SESSION['rol'] == 'Administrador')) {?>
              <div class="tm-site-header">
                <div class="container lower-box box-primary" style="text-align: center;">
                  <h1 class="section-heading h1 h1.a">Buscador de Datos</h1>
                  <div class="flexsearch">
                    <div class="flexsearch--wrapper">
                      <form class="flexsearch--form" action="" method="post">
                        <div class="flexsearch--input-wrapper">
                          <input class="flexsearch--input" type="search" placeholder="search">
                        </div>          
                      </form>
                    </div>
                  </div>
                  
                  <img src="/img/underline.png" class="img-fluid mb-1">
                  
                </div>
              </div>
              <?php } ?>
              <?php if(($_SESSION['rol'] == 'Usuario')) {?>
                <div class="tm-site-header">
                  <div class="container lower-box box-primary" style="text-align: center;">
                    <h1 class="section-heading">Buscador de Datos</h1>
                  </div>
                  <div class="flexsearch">
                    <div class="flexsearch--wrapper">
                      <form class="flexsearch--form" action="#" method="post">
                        <div class="flexsearch--input-wrapper">
                          <input class="flexsearch--input" type="search" placeholder="search">
                        </div>          
                      </form>
                    </div>
                  </div>
                  <h2 style="color:black" class="mb-12">Bienvenido</h2>
                  <img src="/img/underline.png" class="img-fluid mb-1">
                  <p style="color:black"><?= $_SESSION['nombre'],' ', $_SESSION['apellido']?></p> 
                </div> 
              <?php } ?>
            <?php }else{ ?>
              <div class="tm-site-header">
                <h1 style="color:black" class="mb-12">Programación‎</h1>
                <img src="/img/underline.png" class="img-fluid mb-1">
                <p style="color:black">David Navarro &copy;GC</p>        
              </div> 
            <?php } ?>                       
          </div>                
        </div>
      </div>  
    </div>
  </div>




  <script type="text/javascript">

    $(".alert").delay(200).addClass("in").fadeOut(3500);

  </script>
  <script src="js/jquery-3.2.1.slim.min.js"></script>         <!-- https://jquery.com/ -->    
  <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->  
  <script src="js/anime.min.js"></script>                     <!-- http://animejs.com/ -->
  <script src="js/main.js"></script>  
  <script>  


    function setupFooter() {
      var pageHeight = $('.tm-site-header-container').height() + $('footer').height() + 100;

      var main = $('.tm-main-content');

      if($(window).height() < pageHeight) {
        main.addClass('tm-footer-relative');
      }
      else {
        main.removeClass('tm-footer-relative');   
      }
    }

        /* DOM is ready
        ------------------------------------------------*/
        $(function(){

          setupFooter();

          $(window).resize(function(){
            setupFooter();
          });

            $('.tm-current-year').text(new Date().getFullYear());  // Update year in copyright           
          });

        </script>        

