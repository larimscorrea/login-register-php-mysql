<?php 
    session_start();

    if( isset($_SESSION['userId'])) {
        require('./config/db.php');

        $userId = $_SESSION['userId'];

        $stmt = $pdo -> prepare('SELECT * FROm users WHERE id = ? ');

        $stmt->execute ([ $userId ]);

        $user = $stmt ->fetch();

        if( $user->role == 'guest') {
            $message = "Seu acesso é de visitante";
        }
    }


?> 
<?php require('./inc/header.html'); ?>

<div class="container">

    <div class="card bg-light mb-3">

    <div class="card-header">
        <?php if(isset($user)) { ?> 
    <h5>Seja bem-vindo, <?php echo $user->name ?></h5>
    <?php } else { ?>
        <h5>Seja bem-vindo, visitante </h5>
        <?php }  ?>
    </div>

    <?php if(isset($user)) { ?>
    <div class="card-body">
        <h5>Este é um super conteúdo secreto que só pessoas logadas podem ter acesso </h5>
        <?php } else { ?>
    <h4>Por favor faça seu <a href="login.php"> login </a> ou <a href="register.php">registre-se</a></h4>
    <?php } ?> 
</div>

    </div>

</div>

<?php require('./inc/footer.html'); ?>