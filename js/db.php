<?php
$host = 'localhost';
$usuario = 'root';
$email = '';
$senha = '';
$data = 'cpdrogas-project';
$conn = mysqli_connect($host, $usuario, $senha, $data);

if($conn) {
    echo "Conexão estabelecida com sucesso";

    if(isset($_POST['nomeusuario']) && isset($_POST['email']) && isset($_POST['senha'])) {
        $nome = $_POST['nomeusuario'];
        $email = $_POST['useremail'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO cadastro (nome, email, senha) VALUES('$nome', '$email', '$senha')";
        if(mysqli_query($conn, $sql)) {
            echo "Cadastro feito com sucesso!";
        } else {
            echo "Erro ao inserir dados:  " . mysqli_error($conn);
        } 
    } else {
        echo "Campos de formulário não estão definidos.";
    }

    mysqli_close($conn);
} else {
    echo "Falha na conexão: " . mysqli_connect_error();
}

?>