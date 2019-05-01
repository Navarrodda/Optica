<?php 

include (URL_VISTA . 'navbar.php');

if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
    </div>
  <?php } 

if(isset($error)){ ?>
    <div class="container" style="margin-top:50px; margin-bottom: 30px;">

        <div class="alert alert-warning">
            <strong>Error!</strong>  <?= $error ?>
        </div>

    </div>
<?php } 


include (URL_VISTA . 'footer.php');
die();