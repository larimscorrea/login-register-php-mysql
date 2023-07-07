<?php
session_start();

if (isset($_POST['login'])) {
    require('./config/db.php');

    $userEmail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$userEmail]);
    $user = $stmt->fetch();

    if ($user !== false) {
        if (password_verify($password, $user['password'])) {
            echo "A senha está correta";
            $_SESSION['userId'] = $user['id'];
            header('Location: http://localhost/cpdrogas/index.php');
            exit;
        } else {
            $wrongLogin = "O e-mail ou a senha do login está errado!";
        }
    } else {
        $wrongLogin = "O e-mail ou a senha do login está errado!";
    }
}
?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Registre-se</div>
        <div class="card-body">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="userEmail">E-mail</label>
                    <input required type="email" name="email" class="form-control" />
                    <br />
                    <?php if (isset($wrongLogin)) { ?>
                        <p style="color: red"><?php echo $wrongLogin ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="senha" class="form-control" />
                </div>
                <br />
                <button name="login" type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require('./inc/footer.html') ?>
