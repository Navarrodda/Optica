<?php
 include(URL_VISTA . 'navbar.php') ; 
?>

  <?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
    </div>
  <?php } ?>