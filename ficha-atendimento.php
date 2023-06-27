<?php
try {
    if (isset($_POST['ficha-atendimento'])) {
        require('.config/db.php');

        $stmt = $pdo->prepare('SELECT * from datas WHERE id = ?');

        $stmt->execute([$_POST['ficha-atendimento']]);
        $user = $stmt->fetch();
    }

    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'cpdrogas-project';

    // Conexão com o banco de dados
    try {
        $pdo = new PDO("mysql:host=$host;cpdrogas-project=$banco, $usuario, $senha");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão estabelecida com sucesso.";

        if (isset($_POST['nomeusuario']) && isset($_POST['useremail']) && isset($_POST['senha'])) {
            $nome = $_POST['nomeusuario'];
            $email = $_POST['useremail'];
            $senha = $_POST['senha'];

            // Validação dos campos
            if (empty($nome) || empty($email) || empty($senha)) {
                throw new Exception("Todos os campos devem ser preenchidos.");
            } else {
                // Melhoria: Use uma função de hash para armazenar a senha no banco de dados
                $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

                // Inserção no banco de dados
                $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $hashSenha]);

                if ($stmt->rowCount() > 0) {
                    echo "Cadastro feito com sucesso!";
                } else {
                    throw new Exception("Erro ao inserir dados.");
                }
            }
        } else {
            throw new Exception("Campos de formulário não estão definidos.");
        }
    } catch (PDOException $e) {
        throw new Exception("Falha na conexão: " . $e->getMessage());
    }

    if (isset($_POST['numero_da_ficha'])) {
        $numero_da_ficha = $_POST['numero_da_ficha'];

        // Inserção de dados na tabela "fichaatendimentos"
        try {
            $query = 'INSERT INTO fichaatendimentos (numero_da_ficha) VALUES (?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$numero_da_ficha]);

            if ($stmt->rowCount() > 0) {
                echo "Dados inseridos na tabela 'fichaatendimentos'.";
            } else {
                throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir dados: " . $e->getMessage());
        }
    } else if (isset($_POST['cpf'])) {
        $cpf = $_POST['cpf'];

        //Validador de CPF
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

        // Validação do CPF
        if (testaCPF($cpf)) {
            echo "<p style='color: green'>CPF válido</p>";
        } else {
            echo "<p style='color: red'>CPF inválido</p>";
        }

        // Inserção de dados na tabela "fichaatendimentos"
        try {
            $query = 'INSERT INTO fichaatendimentos (cpf) VALUES (?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$cpf]);

            if ($stmt->rowCount() > 0) {
                echo "Dados inseridos na tabela 'fichaatendimentos'.";
            } else {
                throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir dados: " . $e->getMessage());
        }
    } else if(isset($_POST['quem_procurou_ajuda'])) {
        $quem_procurou_ajuda = $_POST['$quem_procurou_ajuda'];

        function quemAjuda() {
                switch ($_POST['$quem_procurou_ajuda']) {
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

    // Inserção de dados na tabela "fichaatendimentos"
    try {
        $query = 'INSERT INTO fichaatendimentos (quem_procurou_atendimento) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quem_procurou_ajuda]);

        if ($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'.";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['como_ficou_sabendo'])) {
    $como_ficou_sabendo = $_POST['como_ficou_sabendo'];
    
    // Inserção de dados na tabela
    try {
        $query = 'INSERT INTO fichaatendimentos (como_ficou_sabendo) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$como_ficou_sabendo]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['genero'])) {
    $genero = $_POST['genero'];

    // Inserção de dados na tabela
    try {
        $query = 'INSERT INTO fichaatendimentos (genero) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$genero]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['gestante'])) {
    $gestante = $_POST['gestante'];

    try {
        $query = 'INSERT INTO fichaatendimentos (gestante) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$gestante]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['endereco'])) { 
    $endereco = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (endereco) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$endereco]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
    
} else if(isset($_POST['bairro'])) {
    $bairro = $pdo->prepare($query);

    $locais = array(
        "nãodefinido" => array("Regional" => "", "Território" => ""), 
        "aerolandia" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "aeroporto" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "aldeota" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "altodabalanca" => array("Regional" => "Regional 6", "Território" => "Território 27"),
        "alvaroweyne" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "amadeufurtado" => array("Regional" => "Regional 1", "Território" => "Território 4"),
        "antoniobezerra" => array("Regional" => "Regional 3", "Território" => "Território 13"),
        "barradoceara" => array("Regional" => "Regional 1", "Território" => "Território 2"),
        "belavista" => array("Regional" => "Regional 6", "Território" => "Território 27"),
        "benfica" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "bomfuturo" => array("Regional" => "Regional 3", "Território" => "Território 13"),
        "boavista" => array("Regional" => "Regional 3", "Território" => "Território 11"),
        "bomjardim" => array("Regional" => "Regional 3", "Território" => "Território 12"),
        "bonsucesso" => array("Regional" => "Regional 3", "Território" => "Território 12"),
        "caisdoporto" => array("Regional" => "Regional 1", "Território" => "Território 1"),
        "cajazeiras" => array("Regional" => "Regional 3", "Território" => "Território 12"),
        "cambeba" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "carlitopamplona" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "centro" => array("Regional" => "Regional 1", "Território" => "Território 1"),
        "cidade2" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "cidadedosf" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "coac" => array("Regional" => "Regional 5", "Território" => "Território 20"),
        "coco" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "conjuntoceara1" => array("Regional" => "Regional 5", "Território" => "Território 20"),
        "conjuntoceara2" => array("Regional" => "Regional 5", "Território" => "Território 20"),
        "cristoredentor" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "curio" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "damas" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "delourdes" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "democritorocha" => array("Regional" => "Regional 5", "Território" => "Território 21"),
        "dende" => array("Regional" => "Regional 6", "Território" => "Território 25"),
        "dionisiotorres" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "domlustosa" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "dunas" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "edsonqueiroz" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "fariasbrito" => array("Regional" => "Regional 1", "Território" => "Território 2"),
        "floresta" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "genibau" => array("Regional" => "Regional 5", "Território" => "Território 21"),
        "guajeru" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "granjaportugal" => array("Regional" => "Regional 5", "Território" => "Território 21"),
        "granjalisboa" => array("Regional" => "Regional 5", "Território" => "Território 20"),
        "henriquejorge" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "itaoca" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "itaperi" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "jacarecanga" => array("Regional" => "Regional 1", "Território" => "Território 1"),
        "jardimamerica" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "jardimguanabara" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "jardimdasoliveiras" => array("Regional" => "Regional 5", "Território" => "Território 19"),
        "jardimiracema" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "joaquimtavora" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "josebonifacio" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "josedealencar" => array("Regional" => "Regional 5", "Território" => "Território 21"),
        "lagoaredonda" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "maraponga" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "meireles" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "messejana" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "montese" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "mondubim" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "montecastelo" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "mourabrasil" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "mucuripe" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "otaviobonfim" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "olavooliveira" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "padreandrade" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "papicu" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "paupina" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "parangaba" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "parreao" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "parquearaxa" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "parqueiracema" => array("Regional" => "Regional 2", "Território" => "Território 6"),
        "parquelandia" => array("Regional" => "Regional 1", "Território" => "Território 3"),
        "parquemanibura" => array("Regional" => "Regional 6", "Território" => "Território 25"),
        "parquesantamaria" => array("Regional" => "Regional 5", "Território" => "Território 19"),
        "parquesaojose" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "passare" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "pedras" => array("Regional" => "Regional 2", "Território" => "Território 7"),
        "pici" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "pirambu" => array("Regional" => "Regional 1", "Território" => "Território 1"),
        "praiadeiracema" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "praiadofuturoi" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "praiadofuturoii" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "prainha" => array("Regional" => "Regional 2", "Território" => "Território 5"),
        "presidentekennedy" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "quintinocunha" => array("Regional" => "Regional 3", "Território" => "Território 13"),
        "rodrigotorres" => array("Regional" => "Regional 1", "Território" => "Território 2"),
        "sabia" => array("Regional" => "Regional 6", "Território" => "Território 25"),
        "salinasaerolandia" => array("Regional" => "Regional 6", "Território" => "Território 26"),
        "santafelicidade" => array("Regional" => "Regional 5", "Território" => "Território 19"),
        "santamaria" => array("Regional" => "Regional 6", "Território" => "Território 25"),
        "serrinha" => array("Regional" => "Regional 6", "Território" => "Território 27"),
        "silvionor" => array("Regional" => "Regional 4", "Território" => "Território 17"),
        "sitioconde" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "sitioverde" => array("Regional" => "Regional 4", "Território" => "Território 18"),
        "tancredoneves" => array("Regional" => "Regional 3", "Território" => "Território 14"),
        "vilaellery" => array("Regional" => "Regional 3", "Território" => "Território 13"),
        "vilalobos" => array("Regional" => "Regional 4", "Território" => "Território 16"),
        "vilamanuelsatiro" => array("Regional" => "Regional 3", "Território" => "Território 13"),
        "vilarodrigues" => array("Regional" => "Regional 3", "Território" => "Território 13")
    );
    
    if (isset($_POST['bairro'])) {
        $bairro = $_POST['bairro'];
    
        if (isset($locais[$bairro])) {
            $regional = $locais[$bairro]['Regional'];
            $territorio = $locais[$bairro]['Território'];
    
            echo "O bairro $bairro está localizado na $regional e $territorio.";
    
            try {
                $query = 'INSERT INTO fichaatendimentos (bairro, regional, territorio) VALUES (?, ?, ?)';
                $stmt = $pdo->prepare($query);
                $stmt->execute([$bairro, $regional, $territorio]);
    
                if ($stmt->rowCount() > 0) {
                    echo "Dados inseridos na tabela 'fichaatendimentos'.";
                } else {
                    throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
                }
            } catch (PDOException $e) {
                throw new Exception("Erro ao inserir dados: " . $e->getMessage());
            }
        } else {
            echo "Não há informações disponíveis para o bairro $bairro.";
        }
    }

} else if(isset($_POST['regional'])) {
    $regional = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (regional) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$regional]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }


} else if(isset($_POST['territorio'])) {
    $territorio = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (regional) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$regional]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['em_situacao_de_rua'])) {
    $em_situacao_de_rua = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (em_situacao_de_rua) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$em_situacao_de_rua]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['pessoa_com_deficiencia'])) {
    $pessoa_com_deficiencia = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (pessoa_com_deficiencia) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pessoa_com_deficiencia]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['criancas_faixa_etaria_0_5'])) {
    $criancas_faixa_etaria_0_5 = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (criancas_faixa_etaria_0_5) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$criancas_faixa_etaria_0_5]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['criancas_faixa_etaria_6_11'])) {
    $criancas_faixa_etaria_6_11 = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (criancas_faixa_etaria_6_11) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$criancas_faixa_etaria_6_11]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
}  else if(isset($_POST['criancas_faixa_etaria_12_17'])) {
    $criancas_faixa_etaria_12_17 = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (criancas_faixa_etaria_12_17) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$criancas_faixa_etaria_12_17]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['substancias_usadas'])) {
    $substancias_usadas = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (substancias_usadas) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$substancias_usadas]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['primeira_substancia'])) {
    $primeira_substancia = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (primeira_substancia) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$primeira_substancia]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['quais_substancias_usa'])) {
    $quais_substancias_usa = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (quais_substancias_usa) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quais_substancias_usa]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['quanto_tempo_usa'])) {
    $quanto_tempo_usa = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (quanto_tempo_usa) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quanto_tempo_usa]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['quanto_tempo_apos_tratamento_procurou_ajuda_primeira_vez'])) {
    $quanto_tempo_apos_tratamento_procurou_ajuda_primeira_vez = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (quanto_tempo_apos_tratamento_procurou_ajuda_primeira_vez) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quanto_tempo_apos_tratamento_procurou_ajuda_primeira_vez]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['onde_procurou_ajuda_primeira_vez'])) {
    $onde_procurou_ajuda_primeira_vez = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (onde_procurou_ajuda_primeira_vez) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$onde_procurou_ajuda_primeira_vez]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['orgaos_atendimentos'])) {
    $orgaos_atendimentos = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (orgaos_atendimentos) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$orgaos_atendimentos]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['pensou_em_suicidio'])) {
    $pensou_em_suicidio = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (pensou_em_suicidio) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pensou_em_suicidio]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['tentou_sucidicio'])) {
    $tentou_sucidicio = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (tentou_sucidicio) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$tentou_sucidicio]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['há_quanto_tempo'])) {
    $há_quanto_tempo = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (há_quanto_tempo) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$há_quanto_tempo]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['expectativa_relacao_esse_atendimento'])) {
    $expectativa_relacao_esse_atendimento = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (expectativa_relacao_esse_atendimento) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$expectativa_relacao_esse_atendimento]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['atendimento_presencial_cpdrogas'])) {
    $atendimento_presencial_cpdrogas = $pdo->prepare($query); 

    try {
        $query = 'INSERT INTO fichaatendimentos (atendimento_presencial_cpdrogas) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$atendimento_presencial_cpdrogas]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['motivo_caso_negativa_atendimento_cpdrogas'])) {
    $motivo_caso_negativa_atendimento_cpdrogas = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (motivo_caso_negativa_atendimento_cpdrogas) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$motivo_caso_negativa_atendimento_cpdrogas]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['relato_atendimento'])) {
    $relato_atendimento = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (relato_atendimento) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$relato_atendimento]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['encaminhamento'])) {
    $encaminhamento = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (encaminhamento) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$encaminhamento]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }

} else if(isset($_POST['data_atendimento'])) {
    $data_atendimento = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (data_atendimento) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data_atendimento]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else if(isset($_POST['profissional'])) {
    $profissional = $pdo->prepare($query);

    try {
        $query = 'INSERT INTO fichaatendimentos (profissional) VALUES (?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$profissional]);

        if($stmt->rowCount() > 0) {
            echo "Dados inseridos na tabela 'fichaatendimentos'. ";
        } else {
            throw new Exception("Falha ao inserir dados na tabela 'fichaatendimentos'.");
        }
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir dados: " . $e->getMessage());
    }
} else {
        throw new Exception("<p style='color: red'>Alguns campos da ficha de atendimento não estão preenchidos.</p>");
    }
    // Fechar a conexão
    $pdo = null;
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>


<!-- Implementações próximas: -->
<!-- Teste: verificar se o dado está ficando armazenado no banco de dados na tabela específica. -->

<!-- Implementação futura:
Sistema gerar um número de ficha baseado em um algoritmo criado para o próprio sistema. -->


<!-- Implementações próximas:
Teste: verificar se o dado está ficando armazenado no banco de dados na tabela específica. -->




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

<!-- Espaço para chamar as funções -->

<?php 
quemAjuda(); 
possivelGestante($genero, $gestante);

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
    <form action="/config/db.php" method="POST">
        <main>
            <h1>Ficha de Acolhimento Individual</h1>
            <div class="box-dados-iniciais">
                <div class="dados-iniciais">
                    <label for="input-inicial" class="question-objetiva">Nº da ficha:</label>
                    <input class="input-text" id="field" name="numero_da_ficha"/>
                </div>
                <div class="dados-iniciais">
                    <label for="input-inicial" class="question-objetiva">CPF:</label>
                    <input class="input-text input-cpf" id="field" name="cpf" />
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
                        <option value="masculino">Homem</option>
                        <option value="feminino">Mulher</option>
                        <option value="outrogenero"> Outro </option>
                    </select>

                    <div id="outroGenero" style="display: none;">
                        <label for="input-outro-genero">Qual gênero?</label>
                        <input type="text" id="input-outro-genero" class="input-text" />
                    </div>
                </div>

                <div class="box-dados">
                    <label class="question-objetiva" required>Você é gestante?</label>
                    <input type="radio" name="sim"> Sim
                    <input type="radio" name="nao"> Não
                    <input type="radio" name="naosei">Não sabe/não informou
                </div>
                
                <div class="box-dados">
                    <label class="question-objetiva" required>Idade</label>
                    <input type="number" class="input-number" min="0" max="150" id="field" name="idade" required />
                </div>

                <div class="box-dados">
                    <label class="question-objetiva" required>Você é uma pessoa com deficiência</label>
                    <input type="radio" name="sim"> Sim
                    <input type="radio" name="nao"> Não
                    <input type="radio" name="naosei">Não sabe/não informou
                </div>

                <div class="box-dados">
                    <label class="question-objetiva" required>Endereço:</label>
                    <input type="text" class="input-number" id="field" name="endereco" required />
                </div>


            <div class="box-dados">
                <select id="city">
                    <option value="aerolandia">Aerolândia</option>
                    <option value="aeroporto">Aeroporto</option>
                    <option value="aldeota">Aldeota</option>
                    <option value="altodabalanca">Alto da Balança</option>
                    <option value="alvaroweyne">Álvaro Weyne</option>
                    <option value="ancuri">Ancuri</option>
                    <option value="amadeufurtado">Amadeu Furtado</option>
                    <option value="antoniobezerra">Antonio Bezerra</option>
                    <option value="aracape">Aracapé</option>
                    <option value="austrannunes">Austran Nunes</option>
                    <option value="barradoceara">Barra do Ceará</option>
                    <option value="barroso">Barroso</option>
                    <option value="belavista">Bela Vista</option>
                    <option value="benfica">Benfica</option>
                    <option value="bomfuturo">Bom Futuro</option>
                    <option value="boavista">Boa Vista</option>
                    <option value="bomjardim">Bom Jardim</option>
                    <option value="bonsucesso">Bonsucesso</option>
                    <option value="caisdoporto">Cais do Porto</option>
                    <option value="cajazeiras">Cajazeiras</option>
                    <option value="cambeba">Cambeba</option>
                    <option value="canindezinho">Canindezinho</option>
                    <option value="carlitopamplona">Carlito Pamplona</option>
                    <option value="centro">Centro</option>
                    <option value="cidade2">Cidade 2</option>
                    <option value="cidadedosf">Cidade dos Funcionários</option>
                    <option value="coac">Coacu</option>
                    <option value="coco">Coco</option>
                    <option value="coite">Coité</option>
                    <option value="conjuntoceara1">Conjunto Ceará 1</option>
                    <option value="conjuntoceara2">Conjunto Ceará 2</option>
                    <option value="conjuntoesperanca">Conjunto Esperança</option>
                    <option value="conjuntopalmeiras">Conjunto Palmeiras</option>
                    <option value="coutofernandes">Couto Fernandes</option>
                    <option value="cristoredentor">Cristo Redentor</option>
                    <option value="curio">Curió</option>
                    <option value="damas">Damas</option>
                    <option value="delourdes">De Lourdes</option>
                    <option value="democritorocha">Demócrito Rocha</option>
                    <option value="dende">Dendê</option>
                    <option value="diasmacedo">Dias Macedo</option>
                    <option value="dionisiotorres">Dionísio Torres</option>
                    <option value="domlustosa">Dom Lustosa</option>
                    <option value="dunas">Dunas</option>
                    <option value="edsonqueiroz">Edson Queiroz</option>
                    <option value="fariasbrito">Farias Brito</option>
                    <option value="fatima">Fátima</option>
                    <option value="floresta">Floresta</option>
                    <option value="genibau">Genibaú</option>
                    <option value="guajeru">Guajeru</option>
                    <option value="guararapes">Guararapes</option>
                    <option value="granjaportugal">Granja Portugal</option>
                    <option value="granjalisboa">Granja Lisboa</option>
                    <option value="henriquejorge">Henrique Jorge</option>
                    <option value="itaoca">Itaoca</option>
                    <option value="itaperi">Itaperi</option>
                    <option value="jacarecanga">Jacarecanga</option>
                    <option value="jangurussu">Jangurussu</option>
                    <option value="jardimamerica">Jardim América</option>
                    <option value="jardimcearense">Jardim Cearense</option>
                    <option value="jardimguanabara">Jardim Guanabara</option>
                    <option value="jardimdasoliveiras">Jardim das Oliveiras</option>
                    <option value="jardimiracema">Jardim Miracema</option>
                    <option value="joaquimtavora">Joaquim Távora</option>
                    <option value="joaoxxiii">João XXIII</option>
                    <option value="josebonifacio">José Bonifácio</option>
                    <option value="josedealencar">José de Alencar</option>
                    <option value="lagoaredonda">Lagoa Redonda</option>
                    <option value="lucianocavalcante">Luciano Cavalcante</option>
                    <option value="maraponga">Maraponga</option>
                    <option value="manueldiasbranco">Manuel Dias Branco</option>
                    <option value="meireles">Meireles</option>
                    <option value="messejana">Messejana</option>
                    <option value="montese">Montese</option>
                    <option value="mondubim">Mondubim</option>
                    <option value="montecastelo">Monte Castelo</option>
                    <option value="mourabrasil">Moura Brasil</option>
                    <option value="mucuripe">Mucuripe</option>
                    <option value="novomondubim">Novo Mondubim</option>
                    <option value="otaviobonfim">Otávio Bonfim</option>
                    <option value="olavooliveira">Olavo Oliveira</option>
                    <option value="padreandrade">Padre Andrade</option>
                    <option value="panamericano">Panamericano</option>
                    <option value="papicu">Papicu</option>
                    <option value="paupina">Paupina</option>
                    <option value="parangaba">Parangaba</option>
                    <option value="parreao">Parreão</option>
                    <option value="parquearaxa">Parque Araxá</option>
                    <option value="parquedoisirmaos">Parque Dois Irmãos</option>
                    <option value="parqueiracema">Parque Iracema</option>
                    <option value="parquelandia">Parquelândia</option>
                    <option value="parquemanibura">Parque Manibura</option>
                    <option value="parquesantamaria">Parque Santa Maria</option>
                    <option value="parquesaojose">Parque São José</option>
                    <option value="passare">Passaré</option>
                    <option value="pedras">Pedras</option>
                    <option value="pici">Pici</option>
                    <option value="pirambu">Pirambu</option>
                    <option value="planaltoayrtonsenna">Planalto Ayrton Senna</option>
                    <option value="praiadeiracema">Praia de Iracema</option>
                    <option value="praiadofuturoi">Praia do Futuro I</option>
                    <option value="praiadofuturoii">Praia do Futuro II</option>
                    <option value="prefeitojosewalter">Prefeito José Walter</option>
                    <option value="presidentekennedy">Presidente Kennedy</option>
                    <option value="presidentevargas">Presidente Vargas</option>
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
                    <option value="vicentepizon">Vicente Pizon</option>
                    <option value="vilaellery">Vila Ellery</option>
                    <option value="vilamanuelsatiro">Vila Manuel Sátiro</option>
                    <option value="vilaperi">Vila Peri</option>
                    <option value="vilavelha">Vila Velha</option>
                    <option value="vilauniao">Vila União</option>
                </select>

                <div class="box-dados">
                    <label class="question-objetiva" required>Em situação de rua</label>
                    <input type="radio" name="sim"> Sim
                    <input type="radio" name="nao"> Não
                    <input type="radio" name="naosei">Não sabe/não informou
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
            <div class="box-wrapper-subs">
                <label class="question-objetiva">Qual(is) tipo(s) de substâncias psicoativas já fez uso na vida?</label>
                <div class="checkbox-field">
                    <ul>
                        <li><input type="checkbox" id="field"> Álcool</li>
                        <li><input type="checkbox" id="field"> Tabaco, cigarro, vaping</li>
                        <li><input type="checkbox" id="field"> Crack(Mesclado, pitio, raspa)</li>
                        <li><input type="checkbox" id="field"> Macoha(Shank, haxixe, k2)</li>
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

        
        <button type="submit" class="btn-submit">Enviar</button>
    </form>
</body>
</html>
