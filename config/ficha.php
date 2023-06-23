<?php
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'cpdrogas-project';
    
    $connection = mysqli_connect($host, $usuario, $senha, $banco);
    
    if (!$connection) {
        die("Falha na conexão: " . mysqli_connect_error());
    }
    
    $host = 'localhost';
    $cpfNumber = '';
    $generoSelecionado = '';
    $gestante = '';
    $locais = ''; 
    $emrua = '';
    $kidscasa = '';
    $subsusadas = '';
    $firstsubs = '';
    $subemuso = '';
    $timeuso = '';
    $timepos = '';
    $ajudalocal = '';
    $orgaoatendimento = '';
    $pensarsuicidio = '';
    $formasuicidio = '';
    $timesuicidio = '';
    $expectativatratamento = '';
    $atendimentopresencial = '';
    $relatoatendimento = '';
    $encaminhamento = '';
    $datetimeatendimento = '';
    $profissionalatendimento = '';

    $connection = mysqli_connect($host, $cpfNumber, $generoSelecionado, $gestante, $emrua, $kidscasa, $subsusadas, $firstsubs, $subemuso, $timeuso, $timeposuso, $ajudalocal, $orgaoatendimento, $pensarsuicidio, $formasuicidio, $timesuicidio, $expecativatratamento, $atendimentopresencial, $relatoatendimento, $encaminhamento, $datetimeatendimento, $profissionalatendimento);
?>