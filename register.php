<?php

    if(isset($_POST['register'])) {
        require('./config/db.php');

        // $userName = $_POST["userName"];
        // $userEmail = $_POST["userEmail"];
        // $password = $_POST["password"];
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
        $stmt -> execute([$userEmail]);
        $totalUsers = $stmt -> rowCount();

        // echo $totalUsers . '<br >';

            if( $totalUsers > 0) {
                // echo "E-mail já foi  adicionado <br>";
                $emailTaken = "Email já foi adicionado";
                } else {
                $stmt = $pdo -> prepare('INSERT into user(name, email, password) VALUES(?, ?, ?)');
                $stmt -> execute( [ $userName, $userEmail, $passwordHashed]);
            } 
        }

        // echo $userEmail . " " . $userName . " " . $password;

    }
?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">

        <div class="card-header bg-light mb-3">Registre-se
            
        <div class="card-body">
            <form action="login.php" method="POST">

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
                    <?php } $emailTaken ?>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="password" class="form-control" />
                </div>

                <button name="login" type="submit" class="bt btn-primary">Login</button>
            </form>
        </div>
        </div>

    </div>

    <?php require('./inc/footer.html') ?>