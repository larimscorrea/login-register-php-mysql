<?php
// Conexão com o banco de dados
$host = 'localhost';
$port = 5432;
$dbname = 'seu_banco_de_dados';
$user = 'seu_usuario';
$password = 'sua_senha';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
$client = new PDO($dsn);

$query = 'SELECT * FROM sua_tabela';
$result = $client->query($query);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);

$client = null;

// Validador de CPF
function testaCPF($strCPF) {
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
    if (($resto == 10) || ($resto == 11)) $resto = 0;
    if ($resto != intval(substr($strCPF, 9, 1))) return false;

    $soma = 0;
    for ($i = 1; $i <= 10; $i++) {
        $soma += intval(substr($strCPF, $i - 1, 1)) * (12 - $i);
    }

    $resto = ($soma * 10) % 11;
    if (($resto == 10) || ($resto == 11)) $resto = 0;
    if ($resto != intval(substr($strCPF, 10, 1))) return false;

    return true;
}

// Código restante...
// Chamada da função para validar CPF
$cpf = '12345678901';
if (testaCPF($cpf)) {
    echo "CPF válido";
} else {
    echo "CPF inválido";
}

?>

<?php
// Abre um campo extra para o preenchimento de informação em caso de ser selecionada a opção determinada.
echo "<script>";
echo "$(document).ready(function() {";
echo "  $('#inputOculto').hide();";
echo "  $('.mySelect').change(function() {";
echo "    if ($('.mySelect').val() == 'Teleatendimento psicossocial via SISGEP' || $('.mySelect').val() == 'Outro tipo de atendimento realizado') {";
echo "      $('#inputOculto').show();";
echo "    } else {";
echo "      $('#inputOculto').hide();";
echo "    }";
echo "  });";
echo "});";

echo "$(document).ready(function() {";
echo "  $('#inputOcultoAjuda').hide();";
echo "  $('.select-ajuda').change(function() {";
echo "    if ($('.select-ajuda').val() == 'Outras pessoas') {";
echo "      $('#inputOcultoAjuda').show();";
echo "    } else {";
echo "      $('#inputOcultoAjuda').hide();";
echo "    }";
echo "  });";
echo "});";

echo "$(document).ready(function() {";
echo "  $('#inputOculto-genero').hide();";
echo "  $('.select-outro').change(function() {";
echo "    if ($('.select-outro').val() == 'Outro') {";
echo "      $('#inputOculto-genero').show();";
echo "    } else {";
echo "      $('#inputOculto-genero').hide();";
echo "    }";
echo "  });";
echo "});";
echo "</script>";
?>


<?php
// Abre um input na questão do gênero
echo "<script>";
echo "var genero = document.getElementById('select-genero');";
echo "var gestante = document.getElementById('genero-gestante');";

echo "genero.addEventListener('change', function selectGenero(){";
echo "  if(genero.value == 'htrans') {";
echo "    gestante.textContent = 'Gestante?';"; 
echo "  } else if(genero.value == 'mcis') {";
echo "    gestante.textContent = 'Gestante?';";
echo "  } else {";
echo "    genero.textContent = 'Você não é gestante.';";
echo "  }";
echo "});";
echo "</script>";
?>

<?php
$locais = array(
    "aerolandia" => "Regional 6 e território 26",
    "aeroporto" => "Regional 4 e território 18",
    "aldeota" => "Regional 2 e território 7",
    // Adicione mais bairros e seus respectivos locais aqui...
);
?>

<form method="post">
    <label for="bairro">Selecione um bairro:</label>
    <select name="bairro" id="bairro">
        <option value="">Selecione</option>
        <?php foreach ($locais as $bairro => $local) { ?>
            <option value="<?php echo $bairro; ?>"><?php echo $bairro; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Obter Local">
</form>

<?php
if (isset($_POST['bairro'])) {
    $bairro = $_POST['bairro'];
    $local = isset($locais[$bairro]) ? $locais[$bairro] : "Bairro não encontrado";
    
    echo "<p>Local: $local</p>";
}
?>


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
                             <input class="input-text" id="field"/>
                         </div>
                         <div class="dados-iniciais">
                             <label for="input-inicial" class="question-objetiva">CPF:</label>
                             <input class="input-text input-cpf" id="field"/>
                         </div>
                    </div>

                </main>
        
        <section class="parte-um">
            <label class="question-objetiva">Qual é o tipo de atendimento realizado?</label>
            <select id="field" name="select-atendimento" class="select mySelect">
                <option></option>
                <option onclick="myInput()">Teleatendimento psicossocial via SISGEP</option> 
                <option>Teleatendimento psicossocial realizado via demanda espontânea</option>
                <option>Teleatendimento psicossocial presencial realizado externamente</option>
                <option>Outro tipo de atendimento realizado</option>
              </select>
              <div id="inputOculto"> Nº do protocolo:
                <input type="text" class="input-text" />
              </div>
            <label class="question-objetiva">Quem procurou ajuda/tratamento?</label>
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
            <div id="inputOcultoAjuda"> Qual(is)?
              <input type="text" class="input-text" />
            </div>
                <div class="box-conhecimento">
                <label class="question-objetiva">Como ficou sabendo do serviço?</label>
                <input type="text" class="input-text" id="field" >
                </div>  
                
        </section>
        <section class="parte-dois">
            <h3>Dados Sociodemográficos</h3>
          <div class="box-dados-iniciais">
            <div class="box-dados">
            <label class="question-objetiva">Gênero</label>
          <select id="select-genero" class="select select-outro" onclick="selectGenero()">
            <option value=""></option>
            <option value="hcis">Homem cis</option>
            <option value="htrans">Homem trans</option>
            <option value="mcis">Mulber cis</option>
            <option value="mtrans">Mulher trans</option>
            <option>Outro</option>
          </select>
          <div id="generogestante"></div>
          </div>
          <div id="inputOculto-genero"> Qual(is)?
            <input type="text" /></div>

        <div class="box-dados">
          <label class="question-objetiva">Idade</label>
          <input type="number" min="0" class="number-input" id="field"/> 
      </div>
          </div>
        <!-- Value pode ser a resposta para a distinção entre as opções do select -->
        </div>
       </div>
        <div class="box-local">
            <div class="box-bairro">
                <p class="questoes-3">Bairro:</p>
                <select class="select select-bairro" name="select" id="select-bairro"> 
                  <option value=""></option>
                  <option value="aerolandia">Aerolândia</option>
                  <option value="aeroporto">Aeroporto</option>
                  <option value="aldeota">Aldeota</option>
                  <option value="altodabalanca">Alto da Balança</option>
                  <option value="alvaroweyne">Álvaro Weyne</option>
                  <option value="amadeufurtado">Amadeu Furtado</option>
                  <option value="antoniobezerra">Antônio Bezerra</option>
                  <option value="barradoceara">Barra do Ceará</option>
                  <option value="belavista">Bela Vista</option>
                  <option value="benfica">Benfica</option>
                  <option value="bomfuturo">Bom Futuro</option>
                  <option value="boavista">Boa Vista</option>
                  <option value="bomjardim">Bom Jardim</option>
                  <option value="bonsucesso">Bonsucesso</option>
                  <option value="caisdoporto">Cais do Porto</option>
                  <option value="cajazeiras">Cajazeiras</option>
                  <option value="cambeba">Cambeba</option>
                  <option value="carlitopamplona">Carlito Pamplona</option>
                  <option value="centro">Centro</option>
                  <option value="cidade2">Cidade 2000 </option>
                  <option value="cidadedosf">Cidade dos Funcionários</option>
                  <option value="coac">Coaçu</option>
                  <option value="coco">Cocó</option>
                  <option value="conjuntoceara1">Conjunto Ceará</option>
                  <option value="conjuntoceara2">Conjunto Palmeiras</option>
                  <option value="cristoredentor">Cristo Redentor</option>
                  <option value="curio">Curió</option>
                  <option value="damas">Damas</option>
                  <option value="delourdes">De Lourdes</option>
                  <option value="democritorocha">Demócrito Rocha</option>
                  <option value="dende">Dendê</option>
                  <option value="dionisiotorres">Dionísio Torres</option>
                  <option value="domlustosa">Dom Lustosa</option>
                  <option value="dunas">Dunas</option>
                  <option value="edsonqueiroz">Edson Queiroz</option>
                  <option value="fariasbrito">Farias Brito</option>
                  <option value="floresta">Floresta</option>
                  <option value="genibau">Genibaú</option>
                  <option value="guajeru">Guajeru</option>
                  <option value="granjaportugal">Granja Portugal</option>
                  <option value="granjalisboa">Granja Lisboa</option>
                  <option value="henriquejorge">Henrique Jorge</option>
                  <option value="itaoca">Itaoca</option>
                  <option value="itaperi">Itaperi</option>
                  <option value="jacarecanga">Jacarecanga</option>
                  <option value="jardimamerica">Jardim América</option>
                  <option value="jardimguanabara">Jardim Guanabara</option>
                  <option value="jardimdasoliveiras">Jardim das Oliveiras</option>
                  <option value="jardimiracema">Jardim Iracema</option>
                  <option value="joaquimtavora">Joaquim Távora</option>
                  <option value="josebonifacio">José Bonifácio</option>
                  <option value="josedealencar">José de Alencar</option>
                  <option value="lagoaredonda">Lagoa Redonda</option>
                  <option value="maraponga">Maraponga</option>
                  <option value="meireles">Meireles</option>
                  <option value="messejana">Messejana</option>
                  <option value="montese">Montese</option>
                  <option value="mondubim">Mondubim</option>
                  <option value="montecastelo">Monte Castelo</option>
                  <option value="mourabrasil">Moura Brasil</option>
                  <option value="mucuripe">Mucuripe</option>
                  <option value="otaviobonfim">Otávio Bonfim </option>
                  <option value="olavooliveira">Olavo Oliveira</option>
                  <option value="padreandrade">Padre Andrade</option>
                  <option value="papicu">Papicu</option>
                  <option value="paupina">Paupina</option>
                  <option value="parangaba">Parangaba</option>
                  <option value="parreao">Parreão</option>
                  <option value="parquearaxa">Parque Araxá</option>
                  <option value="parqueiracema">Parque Iracema</option>
                  <option value="parquelandia">Parquelândia</option>
                  <option value="parquemanibura">Parque Manibura</option>
                  <option value="parquesantamaria">Parque Santa Maria</option>
                  <option value="parquesaojose">Parque São José</option>
                  <option value="passare">Passaré</option>
                  <option value="pedras">Pedras</option>
                  <option value="pici">Pici</option>
                  <option value="pirambu">Pirambu</option>       
                  <option value="praiadeiracema">Praia de Iracema</option>
                  <option value="praiadofuturoi">Praia do Futuro I</option>
                  <option value="praiadofuturoii">Praia do Futuro II</option>
                  <option value="prefeitojosewalter">Prefeito José Walter</option>
                  <option value="presidentekennedy">Presidente Kennedy</option>
                  <option value="quintinocunha">Quintino Cunha</option>
                  <option value="rodolfoteofilo">Rodolfo Teófilo</option>
                  <option value="sabiguaba">Sabiguaba</option>
                  <option value="salinas">Salinas</option>
                  <option value="saobento">São Bento</option>
                  <option value="saogerardo">São Gerardo</option>
                  <option value="saojoaodotauape">São João do Tauape</option>
                  <option value="serrinha">Serrinha</option>
                  <option value="siqueira">Siqueira</option>
                  <option value="varjota">Varjota</option>
                  <option value="vicentepizon">Vicente Pizón</option>
                  <option value="vilaellery">Vila Ellery</option>
                  <option value="vilaperi">Vila Peri</option>
                  <option value="vilavelha">Vila Velha</option>
                  <option value="vilauniao">Vila União</option>
              </select>
              <div id="local"></div>
            </div>
        <div class="box-rua">
            <label>Em situação de rua: </label>
            <div class="inputs-rua">
                <div class="input-radio">
                    <ul class="radio-list">
                        <li><input type="radio" class="radio-input" value="sim1" id="field" name='radio'/> Sim 
                        </li>
                        <li><input type="radio" class="radio-input" value="nao1" id="field" name='radio' /> Não</li>
                        <label id="question-objetiva">Em caso de sim, qual o endereço?
                        </label>                           
                        <li><input type="text" class="input-text" id="field" /></li>
                    </ul>
                </div>
                
            </div>
        </div>
        </div>
        <label>Número de crianças que residem na casa (usuário ou familiar): </label>
        <div class="inputs-numbers--kids">
        <input type="number" min="0" class="number-input" id="field"/> <p>Crianças de 0-5 anos</p>
        <input type="number" min="0" class="number-input" id="field"/> <p>Crianças de 6-11 anos</p>
        <input type="number" min="0" class="number-input" id="field"/> <p>Crianças de 12-17 anos</p>
        </div>

        </section>

        <section class="parte-tres">
            <h3>Dados de Atenção e Cuidado </h3>
            <div class="box-wrapper-subs">
                <label class="question-objetiva">Qual(is) tipo(s) de substâncias psicoativas já fez uso na vida?</label>
                <div class="checkbox-field">
                    <ul>
                        <li><input type="checkbox" id="field"> Álcool</li>
                        <li><input type="checkbox" id="field"> Tabaco, cigarro, vaping</li>
                        <li><input type="checkbox" id="field"> Crack(Mesclado, pitio, raspa)</li>
                        <li><input type="checkbox" id="field"> Maconha(Shank, haxixe, k2)</li>
                        <li><input type="checkbox" id="field"> Cocaína(Merla, oxi...)</li>
                        </ul>
                        
                        <ul>
                        <li><input type="checkbox" id="field"> Solventes(Cola, loló, lança perfume, anti-respingo de solda)</li> 
                        <li><input type="checkbox" id="field"> Tranquilizantes(Diazepam, rivotril, ripinol...)</li>
                        <li><input type="checkbox" id="field"> Anestésicos(Boa noite cinderela, ketamina)</li>
                        <li><input type="checkbox" id="field"> Alucinógenos sintéticos(LSD, Doce, DMT, aranha)</li> 
                        <li><input type="checkbox" id="field"> Alucinógenos naturais(Cogumelo, zabumba, Ahayuaska, Sto Daime, Ibogaína)</li>
                        </ul>
        
                        <ul>
                        <li><input type="checkbox" id="field"> Anfetaminas(Rebite, speed, ritalina)</li>
                        <li><input type="checkbox" id="field"> Opióides(Remédios para dor, morfina, metadona, tramal)</li>
                        <li><input type="checkbox" id="field"> Ecstasy(Bala, MDMA, MD, Mandy)</li>
                        <li><input type="checkbox" id="field"> Heroína</li>
                        <li><input type="checkbox" id="field"> Não sabe/Não respondeu</li>
                        <li>
                        </ul>
                        
                        <ul>
                        <input type="checkbox" id="field"> Outras(as) <strong>Quais?</strong> <input type="text" class="input-text" id="field"></li>
                        </ul>
                </div>

                <label class="question-objetiva">Qual é a primeira substância que você fez uso?</label>
                <input type="text" class="input-text" id="field">
                <label class="question-objetiva">Qual ou quais substâncias faz uso atualmente</label>
                <input type="text" class="input-text" id="field">
                <label class="question-objetiva">Usa há quanto tempo?</label>
                <input type="text" class="input-text" id="field">
                <label class="question-objetiva">Quanto tempo após iniciar o uso procurou tratamento pela primeira vez?</label>
                <input type="text" class="input-text" id="field">
                <label class="question-objetiva">Onde procurou ajuda/tratamento pela primeira vez?</label>
                <input type="text" class="input-text" id="field">

                <label class="question-objetiva">Qual ou quais órgãos/instituições que faz atendimento a usuários de álcool e/ou outras drogas você já foi atendido?</label>
                <div class="checkbox-field">
                    <ul><li><input type="checkbox" id="field"> CAPS AD</li>
                        <li><input type="checkbox" id="field"> Unidade básica de saúde</li>
                        <li><input type="checkbox" id="field"> SHR AD</li>
                        <li><input type="checkbox" id="field"> Hospital Psiquiátrico</li>
                        <li><input type="checkbox" id="field"> Comunidade terapêutica</li>
                        </ul>
                        <ul>
                        <li><input type="checkbox" id="field"> Instituições religiosas</li>
                        <li><input type="checkbox" id="field"> Atendimento Psicológico</li>
                        <li><input type="checkbox" id="field"> Atendimento Psiquiátrico</li>
                        <li><input type="checkbox" id="field"> Grupos de ajuda mutua</li>
                        <li><input type="checkbox" id="field"> Unidade de acolhimento</li>
                        </ul>
                        <ul>
                            <li><input type="checkbox"> Outro(s)
                                <strong>Qual(is)</strong>
                                <input type="text" class="input-text" id="field"></li> 
                        </ul>
                </div>
                <label class="question-objetiva">Já pensou em suicídio alguma vez</label>
                <div class="input-radio">
                    <ul class="radio-list">
                        <li><input type="radio" class="radio-input" value="sim" id="field" name='radio'/> Sim
                        </li>
                    <li><input type="radio" class="radio-input" value="nao" id="field" name='radio'/>
                        Não</li>
                        <li><input type="radio"  class="radio-input" value="nao-responder" id="field" name='radio'/>
                            Prefiro não responder.</li>
                    </ul>
                </div>
                

                <label class="question-objetiva">Qual é a expectativa do usuário e/ou da família em relação a esse atendimento?</label>
                <div class="checkbox-field">
                    <ul> <strong>Internação</strong>
                        <li> <input type="checkbox" id="field"/> Internação voluntária</li>
                        <li><input type="checkbox" id="field"/> Internação involuntária</li>
                        <li><input type="checkbox" id="field"/> Internação compulsória</li>
                    </ul>
                    <ul>
                        <li> <input type="checkbox" id="field"/> Orientação</li>
                        <li> <input type="checkbox" id="field"/> Suporte Psicológico</li>
                        <li> <input type="checkbox" id="field"/> Tratamento na rede intersetorial álcool e drogas municipal</li>
                    </ul>

                    <ul>
                        <li> <input type="checkbox" id="field"/> Outra</li> <strong>Qual?(is)</strong> <input type="text" class="input-text" id="field">

                    </ul>
                </div>
                <label class="question-objetiva">Gostaria de atendimento presencial na CPDrogas?</label>
                <ul class="radio-list">
                    <li><input type="radio" class="radio-input" value="sim" id="field" name='radio'/> Sim
                    </li>
                <li><input type="radio"  class="radio-input" value="nao" id="field" name='radio'/> Não</li>
                
                </ul>

                <h5 class="question-objetiva">Relato do atendimento</h5>
                <input type="text" class="input-text" id="field">
                
                <h5 class="question-objetiva">Encaminhamento</h5>
                <input type="text" class="input-text" id="field">

                <p class="question-objetiva">Fortaleza</p> <input type="datetime-local" class="input-text"/>
                <p class="question-objetiva">Profissional responsável pelo acolhimento/encaminhamento</p> <input type="text" class="input-text" id="field">

               <div class="button">
                <!-- Html de animação do button sucess -->
                <div class="buttons">

                <button class="button-sucess">Enviar ficha de atendimento</button>
                <button class="button-remove" onclick="myRemove()">Remover dados da ficha de atendimento</button>

               </div>
            </div>
        </section>

</body>
</html>