<?php 

include (URL_VISTA . 'navbar.php');

if(isset($error)){ ?>
    <div class="container" style="margin-top:50px; margin-bottom: 30px;">

        <div class="alert alert-warning">
            <strong>Error!</strong>  <?= $error ?>
        </div>

    </div>
<?php }else{ 

header("Location: " . URL_VISTA . 'inicio.php');
}

include (URL_VISTA . 'footer.php');
die();