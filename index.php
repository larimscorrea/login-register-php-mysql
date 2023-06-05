<?php 
    session_start();

    if( isset($_SESSION['userId'])) {
        require('./config/db.php');

        $userId = $_SESSION['userId'];

        echo $userId . "<br />";
    }

?> 
<?php require('./inc/header.html'); ?>

<div class="container">

    <div class="card bg-light mb-3">

    <div class="card-header">
    <h5>Seja bem-vindo, visitante</h5>
    </div>

    <div class="card-body">
    <h5>Por favor faça seu login ou registre-se</h5>
    </div>

    </div>

</div>

<?php require('./inc/footer.html'); ?>