<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$data = 'cpdrogas-project';
$conn = mysqli_connect($host, $usuario, $senha, $data);

if ($conn) {
    echo "Conexão estabelecida com sucesso.";

    if (isset($_POST['nomeusuario']) && isset($_POST['email']) && isset($_POST['senha'])) {
        $nome = $_POST['nomeusuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Melhoria: Use uma função de hash para armazenar a senha no banco de dados
        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cadastro (nome, email, senha) VALUES ('$nome', '$email', '$hashSenha')";
        
        if (mysqli_query($conn, $sql)) {
            echo "Cadastro feito com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($conn);
        }
    } else {
        echo "Campos de formulário não estão definidos.";
    }

    // Preparar a consulta SQL para inserir os dados na tabela
    $query = "INSERT INTO usuarios (cpfNumber, generoSelecionado, gestante, emrua, kidscasa, subsusadas, firstsubs, subemuso, timeuso, timeposuso, ajudalocal, orgaoatendimento, pensarsuicidio, formasuicidio, timesuicidio, expectativatratamento, atendimentopresencial, relatoatendimento, encaminhamento, datetimeatendimento, profissionalatendimento) 
              VALUES ('$cpfNumber', '$generoSelecionado', '$gestante', '$emrua', '$kidscasa', '$subsusadas', '$firstsubs', '$subemuso', '$timeuso', '$timeposuso', '$ajudalocal', '$orgaoatendimento', '$pensarsuicidio', '$formasuicidio', '$timesuicidio', '$expectativatratamento', '$atendimentopresencial', '$relatoatendimento', '$encaminhamento', '$datetimeatendimento', '$profissionalatendimento')";

    // Executar a consulta
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Dados armazenados com sucesso!";
    } else {
        echo "Erro ao armazenar os dados: " . mysqli_error($conn);
    }

    // Fechar a conexão
    mysqli_close($conn);
} else {
    echo "Falha na conexão: " . mysqli_connect_error();
}
?>
