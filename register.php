<?php
if (isset($_POST['register'])) {
    // require('./config/db.php');
    include('./config/db.php');

    $nomeusuario = filter_var($_POST["nomeusuario"], FILTER_SANITIZE_STRING);
    $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
    $passwordHashed = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param("s", $useremail);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalUsers = $result->num_rows;

        echo $totalUsers . '<br>';

        if ($totalUsers > 0) {
            $emailTaken = "Email já foi adicionado";
        } else {
            $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $stmt->bind_param("sss", $nomeusuario, $useremail, $passwordHashed);
            if ($stmt->execute()) {
                echo "Cadastro feito com sucesso!";
            } else {
                echo "Erro ao inserir dados: " . $stmt->error;
            }
        }
    }
    $stmt->close();
    $conn->close();
}
?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Registre-se</div>
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
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="senha" class="form-control" />
                </div>
                <button name="register" type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>

<?php require('./inc/footer.html') ?>
