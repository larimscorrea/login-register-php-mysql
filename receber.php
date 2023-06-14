<?php
$host = 'localhost';
$usuario = 'root';
$seha = '';
$data = 'teste-project';

$conn = mysqli_connect('localhost','root', '', 'teste-project');

if($conn) {
    echo "Deu certo a conexão";
}
else {
    echo "Falha na conexão";
}

$sql = "SELECT * from cadastro";
mysqli_query($conn, $sql);

?>