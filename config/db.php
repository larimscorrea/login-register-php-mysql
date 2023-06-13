<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cpdrogas-project';

$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;


$sql = 'SELECT * FROM register';

$connection = mysqli_connect($host, $username, $password, $dbname);
if(!$connection) {
    die("Houve um erro: ".mysqli_connect_error());
} 

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connect successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>