<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=cpdrogas-project", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['register'])) {
        $nomeusuario = filter_var($_POST["nomeusuario"], FILTER_SANITIZE_STRING);
        $useremail = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
        $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
        $passwordHashed = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->bindParam(1, $useremail);
            $stmt->execute();
            $totalUsers = $stmt->rowCount();

            echo $totalUsers . '<br>';

            if ($totalUsers > 0) {
                $emailTaken = "Email já foi adicionado";
            } else {
                $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
                $stmt->bindParam(1, $nomeusuario);
                $stmt->bindParam(2, $useremail);
                $stmt->bindParam(3, $passwordHashed);
                if ($stmt->execute()) {
                    echo "Cadastro feito com sucesso!";
                } else {
                    echo "Erro ao inserir dados: " . $stmt->errorInfo()[2];
                }
            }
        }
    }
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
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

