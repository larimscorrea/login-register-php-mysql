<?php
if (isset($_POST['ficha'])) {
    require('.config/db.php');

    $stmt = $pdo->prepare('SELECT * from datas WHERE id = ?');

    $stmt->execute([$_POST['ficha']]);
    $user = $stmt->fetch();
}
?>

<?php require('./inc/header.html'); ?>

<?php

$query = 'SELECT * FROM datas WHERE ';
$result = $client->query($query);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);

$client = null;

if (isset($_POST['numberFicha'])) {
    $fichaNumber = $_POST['numberFicha'];
} else {
    echo "<p style='color: red'>Campo Nº da ficha não está definido.</p>";


    // Conexão com o banco de dados
    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
    }

    // Inserir dados no banco de dados
    $query = 'INSERT INTO datas (ficha_number) VALUES (?)';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$fichaNumber]);

    // Verificar se a inserção foi bem-sucedida
    if ($stmt->rowCount() > 0) {
    echo "Dados inseridos no banco de dados.";
    } else {
    echo "Falha ao inserir dados no banco de dados.";
    }

}
// Implementações próximas:
// - Teste: verificar se o dado está ficando armazenado no banco de dados na tabela específica.

//Implementação futura:
//Sistema gerar um número de ficha baseado em um algoritmo criado para o próprio sistema.

if (isset($_POST['cpfNumber'])) {
    $cpfNumber = $_POST['cpfNumber'];

    //Validador de cpf
    function testaCPF($strCPF)
    {
        $soma = 0;

        if ($strCPF == "00000000000") return false;
        if ($strCPF == "11111111111") return false;
        if ($strCPF == "22222222222") return false;
        if ($strCPF == "33333333333") return false;
        if ($strCPF == "44444444444") return false;
        if ($strCPF == "55555555555") return false;
        if ($strCPF == "66666666666") return false;
        if ($strCPF == "77777777777") return false;
        if ($strCPF == "88888888888") return false;
        if ($strCPF == "99999999999") return false;

        for ($i = 1; $i <= 9; $i++) {
            $soma += intval(substr($strCPF, $i - 1, 1)) * (11 - $i);
        }

        $resto = ($soma * 10) % 11;
        if ($resto == 10 || $resto == 11) $resto = 0;
        if ($resto != intval(substr($strCPF, 9, 1))) return false;

        $soma = 0;
        for ($i = 1; $i <= 10; $i++) {
            $soma += intval(substr($strCPF, $i - 1, 1)) * (12 - $i);
        }

        $resto = ($soma * 10) % 11;
        if ($resto == 10 || $resto == 11) $resto = 0;
        if ($resto != intval(substr($strCPF, 10, 1))) return false;

        return true;
    }

    // Chamada da função para validar CPF
    if (testaCPF($cpfNumber)) {
        echo "<p style='color: green'> CPF válido</p>";
    } else {
        echo "<p style='color: red'> CPF inválido</p>";
    }
} else {
    echo "Campo CPF não está definido.";
}

// Implementações próximas:
// - Teste: verificar se o dado está ficando armazenado no banco de dados na tabela específica.

//Implementações.
?>

<?php

$ajuda = $_POST['ajuda'];

function quemAjuda() {
    if(isset($_POST['ajuda'])) {
        $ajuda = $_POST['ajuda'];

        switch ($ajuda) {
        case "Usuário":
            break;
        
        case "Usuário e família":
            break;
        
        case "Família":
            break;
        
        case "Amigos e conhecidos":
            break;
        
        case "Promotorias de Justiça":
            break;
        
        case "Técnicos de instituições":
            break;

        default: 
        break;

        } 
    }
}

quemAjuda();

?>

<?php 

if(isset($_POST['comoSoube'])) {
    $comoSoube = $_POST['comoSoube'];
} else {
    echo "";
}

?>

<?php
// Abre um input na questão do gênero
$genero = $_POST['genero'] ?? '';
$gestante = $_POST['gestante'] ?? '';

function possivelGestante($genero, $gestante) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $selectOption = $_POST['genero']; 
        $opcaoSelecionada = $_POST['opcao'] ?? ''; //Correção do erro com atribuição da variável
        echo "Opção selecionada: " . $selectOption;
        echo "<p>Gestante?</p>";
        echo "<label><input type='radio' name='opcao' value='Sim' " . ($opcaoSelecionada == 'sim' ? 'checked' : '') . " /> Sim</label> 
            <label><input type='radio' name='opcao' value='Nao' " . ($opcaoSelecionada == 'nao' ? 'checked' : '') . " /> Não</label>";
    } else {
        echo "<p>Você não é gestante.</p>";
    }
}

// Chamada da função
possivelGestante($genero, $gestante);
?>


<?php
$locais = array(
    "nãodefinido" => "Bairro ainda não selecionado",
    "aerolandia" => "Regional 6 e território 26",
    "aeroporto" => "Regional 4 e território 18",
    "aldeota" => "Regional 2 e território 7",
    "altodabalanca" => "Regional 6 e território 27",
    "alvaroweyne" => "Regional 2 e território 7",
    "amadeufurtado" => "Regional 1 e território 4",
    "antoniobezerra" => "Regional 3 e território 13",
    "barradoceara" => "Regional 1 e território 2",
    "belavista" => "Regional 6 e território 27",
    "benfica" => "Regional 1 e território 3",
    "bomfuturo" => "Regional 3 e território 13",
    "boavista" => "Regional 3 e território 11",
    "bomjardim" => "Regional 3 e território 12",
    "bonsucesso" => "Regional 3 e território 12",
    "caisdoporto" => "Regional 1 e território 1",
    "cajazeiras" => "Regional 3 e território 12",
    "cambeba" => "Regional 4 e território 18",
    "carlitopamplona" => "Regional 2 e território 7",
    "centro" => "Regional 1 e território 1",
    "cidade2" => "Regional 2 e território 6",
    "cidadedosf" => "Regional 4 e território 17",
    "coac" => "Regional 5 e território 20",
    "coco" => "Regional 4 e território 17",
    "conjuntoceara1" => "Regional 5 e território 20",
    "conjuntoceara2" => "Regional 5 e território 20",
    "cristoredentor" => "Regional 2 e território 6",
    "curio" => "Regional 6 e território 26",
    "damas" => "Regional 2 e território 6",
    "delourdes" => "Regional 1 e território 3",
    "democritorocha" => "Regional 5 e território 21",
    "dende" => "Regional 6 e território 25",
    "dionisiotorres" => "Regional 2 e território 7",
    "domlustosa" => "Regional 4 e território 17",
    "dunas" => "Regional 4 e território 17",
    "edsonqueiroz" => "Regional 4 e território 18",
    "fariasbrito" => "Regional 1 e território 2",
    "floresta" => "Regional 1 e território 3",
    "genibau" => "Regional 5 e território 21",
    "guajeru" => "Regional 6 e território 26",
    "granjaportugal" => "Regional 5 e território 21",
    "granjalisboa" => "Regional 5 e território 20",
    "henriquejorge" => "Regional 4 e território 17",
    "itaoca" => "Regional 6 e território 26",
    "itaperi" => "Regional 4 e território 16",
    "jacarecanga" => "Regional 1 e território 1",
    "jardimamerica" => "Regional 2 e território 6",
    "jardimguanabara" => "Regional 4 e território 17",
    "jardimdasoliveiras" => "Regional 5 e território 19",
    "jardimiracema" => "Regional 2 e território 6",
    "joaquimtavora" => "Regional 2 e território 7",
    "josebonifacio" => "Regional 1 e território 3",
    "josedealencar" => "Regional 5 e território 21",
    "lagoaredonda" => "Regional 4 e território 17",
    "maraponga" => "Regional 4 e território 16",
    "meireles" => "Regional 2 e território 5",
    "messejana" => "Regional 6 e território 26",
    "montese" => "Regional 4 e território 16",
    "mondubim" => "Regional 4 e território 17",
    "montecastelo" => "Regional 1 e território 3",
    "mourabrasil" => "Regional 2 e território 5",
    "mucuripe" => "Regional 2 e território 5",
    "otaviobonfim" => "Regional 2 e território 5",
    "olavooliveira" => "Regional 4 e território 16",
    "padreandrade" => "Regional 1 e território 3",
    "papicu" => "Regional 2 e território 5",
    "paupina" => "Regional 6 e território 26",
    "parangaba" => "Regional 4 e território 17",
    "parreao" => "Regional 4 e território 17",
    "parquearaxa" => "Regional 6 e território 26",
    "parqueiracema" => "Regional 2 e território 6",
    "parquelandia" => "Regional 1 e território 3",
    "parquemanibura" => "Regional 6 e território 25",
    "parquesantamaria" => "Regional 5 e território 19",
    "parquesaojose" => "Regional 6 e território 26",
    "passare" => "Regional 4 e território 17",
    "pedras" => "Regional 2 e território 7",
    "pici" => "Regional 4 e território 16",
    "pirambu" => "Regional 1 e território 1",
    "praiadeiracema" => "Regional 2 e território 5",
    "praiadofuturoi" => "Regional 2 e território 5",
    "praiadofuturoii" => "Regional 2 e território 5",
    "prainha" => "Regional 2 e território 5",
    "presidentekennedy" => "Regional 4 e território 18",
    "quintinocunha" => "Regional 3 e território 13",
    "rodrigotorres" => "Regional 1 e território 2",
    "sabia" => "Regional 6 e território 25",
    "salinasaerolandia" => "Regional 6 e território 26",
    "santafelicidade" => "Regional 5 e território 19",
    "santamaria" => "Regional 6 e território 25",
    "serrinha" => "Regional 6 e território 27",
    "silvionor" => "Regional 4 e território 17",
    "sitioconde" => "Regional 4 e território 18",
    "sitioverde" => "Regional 4 e território 18",
    "tancredoneves" => "Regional 3 e território 14",
    "vilaellery" => "Regional 3 e território 13",
    "vilalobos" => "Regional 4 e território 16",
    "vilamanuelsatiro" => "Regional 3 e território 13",
    "vilarodrigues" => "Regional 3 e território 13"
);

$bairro = 'naodefinido';
if (isset($locais[$bairro])) {
    echo "O bairro $bairro está localizado na região " . $locais[$bairro];
} else {
    echo "Não há informações disponíveis para o bairro $bairro.";
};
?>

<!-- Não entendi código abaixo -->
<label for="bairro">Selecione um bairro:</label>
    <select name="bairro" id="bairro">
        <option value="">Selecione</option>
        <?php foreach ($locais as $bairro => $local) { ?>
            <option value="<?php echo $bairro; ?>"><?php echo $bairro; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Obter Local" />
</form>
<?php
if (isset($_POST['bairro'])) {
    $bairro = $_POST['bairro'];
    $local = isset($locais[$bairro]) ? $locais[$bairro] : "Bairro não encontrado";
    echo "<p>Local: $local</p>";
}
?>
<!-- Não entendi código acima -->

<!-- Situação de rua -->

<?php
function emRua() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['emrua'])) {
            $opcao = $_POST['emrua']; // obter o valor do input de rádio 'emrua'
            if($opcao == 'sim1') {
                // ação a ser executada quando a opção 'Sim' for selecionada
                if(isset($_POST['endereco'])) {
                    $endereco = $_POST['endereco']; // obter o valor do campo de texto 'endereco'
                    // realizar alguma lógica com o endereço
                    echo "Endereço em situação de rua: " . $endereco;
                }
            } elseif($opcao == 'nao1') {
                // ação a ser executada quando a opção 'Não' for selecionada
                echo "Não está em situação de rua.";
            }
        }
    }
}
?>
<!-- Situação de rua -->

<!-- Quantidades de crianças -->

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['kidscasa'])) {
        $criancas_0_5_anos = $_POST['kidscasa'][0];
        $criancas_6_11_anos = $_POST['kidscasa'][1];
        $criancas_12_17_anos = $_POST['kidscasa'][2];
        
        // Preparar e executar a consulta SQL de inserção
        $sql = "INSERT INTO tabela (criancas_0_5, criancas_6_11, criancas_12_17) VALUES ('$criancas_0_5_anos', '$criancas_6_11_anos', '$criancas_12_17_anos')";
        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso.";
        } else {
            echo "Erro ao inserir dados: " . $conn-> error;
        }
    }
}

?>

<?php
// Substancias utilizadas: 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['subsusadas'])) {
        $substancias = $_POST['subsusadas'];
        
        // Transforma o array de substâncias em uma string separada por vírgulas
        $substanciasString = implode(', ', $substancias);
        
        // Preparar e executar a consulta SQL de inserção
        $sql = "INSERT INTO tabela (substancias_psicoativas) VALUES ('$substanciasString')";
        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso.";
        } else {
            echo "Erro ao inserir dados: " . $conn->error;
        }
    }
}

// Substancias utilizadas: 

?> 

<?php 

// Perguntas objetivas: 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstSubstance = $_POST['firstsub'];
    $substancesInUse = $_POST['subsemuso'];
    $timeOfUse = $_POST['timeuso'];
    $timeAfterUseForTreatment = $_POST['timeposuso'];
    $helpLocation = $_POST['ajudalocal'];
    
    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (primeira_substancia, substancias_em_uso, tempo_de_uso, tempo_ate_tratamento, local_de_ajuda) 
            VALUES ('$firstSubstance', '$substancesInUse', '$timeOfUse', '$timeAfterUseForTreatment', '$helpLocation')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php 
// Órgãos de atendimento:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['orgaoatendimento'])) {
        $atendimentoOrgaos = $_POST['orgaoatendimento'];
        $atendimentoOrgaos = implode(', ', $atendimentoOrgaos);
    } else {
        $atendimentoOrgaos = "";
    }
    
    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (orgaos_atendimento) VALUES ('$atendimentoOrgaos')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php 
// Suicidio 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pensarsuicidio'])) {
        $pensarSuicidio = $_POST['pensarsuicidio'];
    } else {
        $pensarSuicidio = "";
    }

    if ($pensarSuicidio === 'sim') {
        if (isset($_POST['formasuicidio'])) {
            $formaSuicidio = $_POST['formasuicidio'];
        } else {
            $formaSuicidio = "";
        }

        if (isset($_POST['timesuicidio'])) {
            $tempoSuicidio = $_POST['timesuicidio'];
        } else {
            $tempoSuicidio = "";
        }
    } else {
        $formaSuicidio = "";
        $tempoSuicidio = "";
    }

    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (pensar_suicidio, forma_suicidio, tempo_suicidio) VALUES ('$pensarSuicidio', '$formaSuicidio', '$tempoSuicidio')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php 
// Expectativa tratamento

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['expectativatratamento'])) {
        $expectativaTratamento = $_POST['expectativatratamento'];
    } else {
        $expectativaTratamento = array();
    }

    // Converter o array de expectativas em uma string separada por vírgulas
    $expectativaTratamentoString = implode(", ", $expectativaTratamento);

    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (expectativa_tratamento) VALUES ('$expectativaTratamentoString')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php

// Atendimento presencial
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['atendimentopresencial'])) {
        $atendimentoPresencial = $_POST['atendimentopresencial'];
    } else {
        $atendimentoPresencial = '';
    }

    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (atendimento_presencial) VALUES ('$atendimentoPresencial')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar os valores fornecidos pelo usuário
    $relatoAtendimento = isset($_POST['relatoatendimento']) ? $_POST['relatoatendimento'] : '';
    $encaminhamento = isset($_POST['encaminhamento']) ? $_POST['encaminhamento'] : '';
    $dataHoraAtendimento = isset($_POST['datetimeatendimento']) ? $_POST['datetimeatendimento'] : '';
    $profissionalAtendimento = isset($_POST['profissionalatendimento']) ? $_POST['profissionalatendimento'] : '';

    // Preparar e executar a consulta SQL de inserção
    $sql = "INSERT INTO tabela (relato_atendimento, encaminhamento, data_hora_atendimento, profissional_atendimento) 
            VALUES ('$relatoAtendimento', '$encaminhamento', '$dataHoraAtendimento', '$profissionalAtendimento')";
    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}
?>

<?php
// Botões
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você pode adicionar o código que processa os dados do formulário
    // por exemplo, salvar os dados em um banco de dados

    // Exemplo: salvar os dados em um banco de dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Código para salvar os dados no banco de dados

    // Redirecionar para uma página de sucesso
    header('Location: sucesso.php');
    exit;
}

if (isset($_POST['remove'])) {
    // Aqui você pode adicionar o código que remove os dados do formulário
    // por exemplo, limpar as variáveis de sessão ou reiniciar as variáveis

    // Exemplo: limpar as variáveis de sessão
    session_start();
    session_unset();
    session_destroy();

    // Redirecionar para a mesma página (ou outra página)
    header('Location: index.php');
    exit;
}
?>
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
    <form action="">
        <main>
            <h1>Ficha de Acolhimento Individual</h1>
            <div class="box-dados-iniciais">
                <div class="dados-iniciais">
                    <label for="input-inicial" class="question-objetiva">Nº da ficha:</label>
                    <input class="input-text" id="field" />
                </div>
                <div class="dados-iniciais">
                    <label for="input-inicial" class="question-objetiva">CPF:</label>
                    <input class="input-text input-cpf" id="field" />
                </div>
            </div>
        </main>
        
        <section class="parte-um">
            <label class="question-objetiva">Qual é o tipo de atendimento realizado?</label>
            <select id="field" name="select-atendimento" class="select mySelect" required>
                <option></option>
                <option>Teleatendimento psicossocial via SISGEP</option>
                <option>Teleatendimento psicossocial realizado via demanda espontânea</option>
                <option>Teleatendimento psicossocial presencial realizado externamente</option>
                <option>Outro tipo de atendimento realizado</option>
            </select>
            <div id="inputOculto">
                Nº do protocolo do atendimento SISGEP:
                <input type="text" class="input-text" />
            </div>
            
            <label class="question-objetiva" required>Quem procurou ajuda/tratamento?</label>
            <select id="field" class="select select-ajuda">
                <option></option>
                <option>Usuário</option>
                <option>Usuário e família</option>
                <option>Família</option>
                <option>Amigos e conhecidos</option>
                <option>Promotorias de Justiça</option>
                <option>Técnicos de instituições</option>
                <option>Outras pessoas</option>
            </select>
            <div id="inputOcultoAjuda" required>
                Qual(is) outras pessoas procuraram ajuda/tratamento?
                <input type="text" class="input-text" />
            </div>
            
            <div class="box-conhecimento">
                <label class="question-objetiva" required>Como ficou sabendo do serviço?</label>
                <input type="text" class="input-text" id="field" />
            </div>  
        </section>
        
        <section class="parte-dois">
            <h3>Dados Sociodemográficos</h3>
            <div class="box-dados-iniciais">
                <div class="box-dados">
                    <label class="question-objetiva" required>Gênero</label>
                    <select id="select-genero" class="select select-outro" onclick="selectGenero()" name="genero">
                        <option value=""></option>
                        <option value="hcis">Homem cis</option>
                        <option value="htrans">Homem trans</option>
                        <option value="mulhercis">Mulher cis</option>
                        <option value="mulhertrans">Mulher trans</option>
                        <option value="outrogenero">Outro</option>
                    </select>
                </div>
                
                <div class="box-dados">
                    <label class="question-objetiva" required>Idade</label>
                    <input type="number" class="input-number" min="0" max="150" id="field" name="idade" required />
                </div>
            </div>
            
            <label class="question-objetiva" required>Estado civil</label>
            <select id="field" class="select select-outro" onclick="selectEstadoCivil()" name="estadocivil" required>
                <option value=""></option>
                <option value="solteiro">Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viuvo">Viúvo</option>
                <option value="outroestadocivil">Outro</option>
            </select>
            
            <div id="inputOcultoEstadoCivil">
                Qual(is) outro(s) estado(s) civil(is)?
                <input type="text" class="input-text" />
            </div>
            
            <label class="question-objetiva" required>Escolaridade</label>
            <select id="field" class="select select-outro" onclick="selectEscolaridade()" name="escolaridade" required>
                <option value=""></option>
                <option value="fundamentalincompleto">Fundamental incompleto</option>
                <option value="fundamentalcompleto">Fundamental completo</option>
                <option value="medioincompleto">Médio incompleto</option>
                <option value="mediocompleto">Médio completo</option>
                <option value="superiorincompleto">Superior incompleto</option>
                <option value="superiorcompleto">Superior completo</option>
                <option value="posgraduacao">Pós-graduação</option>
                <option value="outroescolaridade">Outro</option>
            </select>
            
            <div id="inputOcultoEscolaridade">
                Qual(is) outro(s) nível(is) de escolaridade?
                <input type="text" class="input-text" />
            </div>
            
            <div class="box-dados">
                <label class="question-objetiva">Ocupação</label>
                <input type="text" class="input-text" id="field" name="ocupacao" />
            </div>
            
            <label required>Número de crianças que residem na casa (usuário ou familiar): </label>
            <div class="inputs-numbers--kids" name="kidscasa">
                <input type="number" min="0" class="number-input" id="field" /> <p>Crianças de 0-5 anos</p>
                <input type="number" min="0" class="number-input" id="field" /> <p>Crianças de 6-11 anos</p>
                <input type="number" min="0" class="number-input" id="field" /> <p>Crianças de 12-17 anos</p>
            </div>
        </section>
        
        <section class="parte-tres">
            <h3>Caracterização do Usuário e da Situação Problema</h3>
            <div class="box-dados-iniciais">
                <div class="box-dados">
                    <label class="question-objetiva" required>Usa álcool?</label>
                    <select id="field" class="select select-outro" onclick="selectAlcool()" name="alcool" required>
                        <option value=""></option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                        <option value="naosabe">Não sabe</option>
                    </select>
                </div>
                
                <div id="inputOcultoAlcool" required>
                    Há quanto tempo faz uso de álcool?
                    <input type="text" class="input-text" />
                </div>
            </div>
            
            <div class="box-dados-iniciais">
                <div class="box-dados">
                    <label class="question-objetiva" required>Usa drogas?</label>
                    <select id="field" class="select select-outro" onclick="selectDrogas()" name="drogas" required>
                        <option value=""></option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                        <option value="naosabe">Não sabe</option>
                    </select>
                </div>
                
                <div id="inputOcultoDrogas" required>
                    Quais drogas utiliza?
                    <input type="text" class="input-text" />
                </div>
            </div>
            
            <div class="box-dados-iniciais">
                <div class="box-dados">
                    <label class="question-objetiva" required>Problema de saúde</label>
                    <select id="field" class="select select-outro" onclick="selectSaude()" name="saude" required>
                        <option value=""></option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                        <option value="naosabe">Não sabe</option>
                    </select>
                </div>
                
                <div id="inputOcultoSaude" required>
                    Qual é o problema de saúde?
                    <input type="text" class="input-text" />
                </div>
            </div>
            
            <div class="box-dados-iniciais">
                <div class="box-dados">
                    <label class="question-objetiva" required>Problema de saúde mental</label>
                    <select id="field" class="select select-outro" onclick="selectSaudeMental()" name="saudemental" required>
                        <option value=""></option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                        <option value="naosabe">Não sabe</option>
                    </select>
                </div>
                
                <div id="inputOcultoSaudeMental" required>
                    Qual é o problema de saúde mental?
                    <input type="text" class="input-text" />
                </div>
            </div>
            
            <label class="question-objetiva">Qual é a situação problema?</label>
            <textarea id="field" class="textarea" required></textarea>
            
            <label class="question-objetiva">Quanto tempo o problema perdura?</label>
            <input type="text" class="input-text" id="field" required />
            
            <div class="box-dados">
                <label class="question-objetiva">O problema já ocorreu anteriormente?</label>
                <select id="field" class="select select-outro" onclick="selectProblemaAnterior()" name="problemaanterior">
                    <option value=""></option>
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
                    <option value="naosabe">Não sabe</option>
                </select>
            </div>
            
            <div id="inputOcultoProblemaAnterior">
                Qual é o histórico do problema?
                <input type="text" class="input-text" />
            </div>
        </section>
        
        <section class="parte-quatro">
            <h3>Encaminhamentos</h3>
            <div class="box-dados">
                <label class="question-objetiva">Encaminhado para:</label>
                <select id="field" class="select select-outro" onclick="selectEncaminhado()" name="encaminhado">
                    <option value=""></option>
                    <option value="servicosocial">Serviço Social</option>
                    <option value="psicologia">Psicologia</option>
                    <option value="psiquiatria">Psiquiatria</option>
                    <option value="nutricao">Nutrição</option>
                    <option value="terapiaocupacional">Terapia Ocupacional</option>
                    <option value="outroencaminhamento">Outro</option>
                </select>
            </div>
            
            <div id="inputOcultoEncaminhado">
                Qual(is) outro(s) encaminhamento(s)?
                <input type="text" class="input-text" />
            </div>
            
            <label class="question-objetiva">Data do encaminhamento:</label>
            <input type="date" class="input-date" id="field" name="dataencaminhamento" />
            
            <label class="question-objetiva">Observações:</label>
            <textarea id="field" class="textarea"></textarea>
        </section>
        
        <button type="submit" class="btn-submit">Enviar</button>
    </form>
</body>
</html>
