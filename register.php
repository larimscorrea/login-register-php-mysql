<?php

    if(isset($_POST['register'])) {
        // require('./config/db.php');
        include("/config/db.php");
        // $userName = $_POST["userName"];
        // $userEmail = $_POST["userEmail"];
        // $password = $_POST["password"];
        $nomeusuario = filter_var($_POST["nomeusuario"], FILTER_SANITIZE_STRING);
        $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
        $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        $sql="INSERT into users(id, name, email, password, role) 
            VALUES (?, '$nomeusuario', '$useremail', '$senha', '?')";

            
            if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
            $stmt -> execute([$userEmail]);
            $totalUsers = $stmt -> rowCount();

        echo $totalUsers . '<br >';

            if( $totalUsers > 0) {
                // echo "E-mail já foi  adicionado <br>";
                $emailTaken = "Email já foi adicionado";
                } else {
                $stmt = $pdo -> prepare('INSERT into users(name, email, password) VALUES(?, ?, ?)');
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
            <form action="/config/db.php" method="POST">

                <div class="form-group">
                    <label for="nomeusuario">Usuário</label>
                    <input required type="text" name="nomeusuario" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="useremail">E-mail</label>
                    <input required type="email" name="useremail" class="form-control" />
                    <br />
                    <?php if(isset($emailTaken)) { ?>
                        <p style="background-color: red"><?php echo $emailTaken ?></p>
                    <?php } $emailTaken ?>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="senha" class="form-control" />
                </div>

                <button name="login" type="submit" class="bt btn-primary">Login</button>
            </form>
        </div>
        </div>

    </div>

    <?php require('./inc/footer.html') ?>