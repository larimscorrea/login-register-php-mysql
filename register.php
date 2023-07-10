<?php

if(isset( $_POST['register.php'])) {
    require('./config/db.php');

    $userName = filter_var( $_POST["userName"], FILTER_SANITIZE_STRING);
    $userEmail = filter_var( $_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var( $_POST["password"], FILTER_SANITIZE_STRING);
    $passwordHashed = filter_var( $_POST["password"], PASSWORD_DEFAULT);

    if( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
        $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ? ');
        $stmt -> execute([$userEmail]);
        $totalUsers = $stmt -> rowCount();

        if( $totalUsers > 0 ) {
            $emailTaken = "E-mail já adicionado";
        } else {
            $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(? , ? , ? )');
            $stmt -> execute( [ $userName, $userEmail, $passwordHashed] );

            header('Location: http://localhost/cpdrogas/index.php');
        }
    }
}

?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Registre-se</div>
        <div class="card-body">
            <form action="/config/db.php" method="POST">
                <div class="form-group">
                    <label for="userName">Usuário</label>
                    <input required type="text" name="userName" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="userEmail">E-mail</label>
                    <input required type="email" name="userEmail" class="form-control" />
                    <br />
                    <?php if(isset($emailTaken)) { ?>
                        <p style="background-color: red"><?php echo $emailTaken ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="password" class="form-control" />
                </div>
                <br />
                <button name="register" type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>
    
</div>

<?php require('./inc/footer.html') ?>

