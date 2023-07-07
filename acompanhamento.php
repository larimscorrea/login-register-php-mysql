<?php require('./inc/header.html'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/config/db.php" method="POST">
        <h1>Acompanhamento itirinerário terapêutico do usuário</h1>

        <input type="text" name="user" id="" />
        <p>nome | cpf | nº da ficha </p>
        <button type="submit" class="btn btn-danger">pesquisar</button>


        <h3>Você está na ficha de x</h3>

        <label for="">Semana que você deseja editar ou adicionar:</label>
            <select name="" id="">
                <option value=""></option>
                <option value="ficha">ficha</option>
                <option value="1semana">1º semana</option>
                <option value="2semana">2º semana</option>
                <option value="3semana">3º semana</option>
                <option value="4semana">4º semana</option>
                <option value="5semana">5º semana</option>
                <option value="6semana">6º semana</option>
                <option value="7semana">7º semana</option>
                <option value="8semana">8º semana</option>
                <option value="9semana">9º semana</option>
                <option value="10semana">10º semana</option>
                <option value="11semana">11º semana</option>
                <option value="12semana">12º semana</option>
            </select>

            <label for="">O contato foi realizado: </label>
            <input type="radio" name="usuario" id=""> Com o usuário
            <input type="radio" name="familiar" id=""> Com o familiar
            <input type="radio" name="ambos" id=""> Com ambos
            <input type="radio" name="naorealizado" id=""> Não realizado
            <label for="">Motivo</label>
            <input type="text" name="motivoContato" id="">

            <label for="">Qual é a situação do tratamento? </label>
            <input type="radio" name="emtratamento" id=""> Em tratamento
            <input type="radio" name="desistiutratamento" id=""> Desistiu do tratamento
            <input type="radio" name="naoiniciou" id=""> Não iniciou o tratamento
            <label for="">Motivo</label>
            <input type="text" name="" id="">

            <label for="">Qual é a relação com o uso de substâncias? </label>
            <input type="radio" name="abstinencia" id=""> Está em abstinência
            <input type="radio" name="usonocivo" id=""> Continua em uso nocivo
            <input type="radio" name="reduzuso" id=""> Reduziu o uso

            <label for="">Observações do atendimento</label>
            <input type="text" name="observacoes" id="">
            
            <input type="datetime" name="data" id="" />

        
            <button type="submit" class="btn btn-primary">enviar</button>
    </form>
</body>
