

<!-- Section Intro Slider
  ================================================== -->
  <?php  include(URL_VISTA . 'navbar.php') ?>

  <?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
    </div>
  <?php } ?>

  <div id="tm-wrap">
    <div class="tm-main-content">
      <div class="container tm-site-header-container" >
        <div class="row">
          <div class="col-sm-12 col-md-11 col-lg-9 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-col">
            <div class="tm-site-header">
              <h1 style="color:black" class="mb-12">Programación‎</h1>
              <img src="img/underline.png" class="img-fluid mb-1">
              <p style="color:black">David Navarro &copy;GC</p>        
            </div>                        
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

