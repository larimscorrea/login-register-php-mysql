<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'cpdrogas-project';

try {
    $conn = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão estabelecida com sucesso.";

    if (isset($_POST['nomeusuario']) && isset($_POST['useremail']) && isset($_POST['senha'])) {
        $nome = $_POST['nomeusuario'];
        $email = $_POST['useremail'];
        $senha = $_POST['senha'];

        // Validação dos campos
        if (empty($nome) || empty($email) || empty($senha)) {
            echo "Todos os campos devem ser preenchidos.";
        } else {
            // Melhoria: Use uma função de hash para armazenar a senha no banco de dados
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

            // Inserção no banco de dados
            $stmt = $conn->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hashSenha]);

            if ($stmt->rowCount() > 0) {
                echo "Cadastro feito com sucesso!";
            } else {
                echo "Erro ao inserir dados.";
            }
        }
    } else {
        echo "Campos de formulário não estão definidos.";
    }
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
?>
