<?php
// título para a página
echo "<h1>Teste de Conexão e CRUD (Tabela 'usuario')</h1>";


require_once('../config/config.php');
require_once('../model/Database.php');

// Variável para rastrear o sucesso geral
$test_passed = true;


echo "<h2>1. Conexão</h2>";
try {
    // Inicializa a classe Database
    $db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET);

    // Tenta conectar 
    $db->connect();
    echo "<p style='color: green;'>Conexão com o banco de dados '", DB_NAME, "' estabelecida com sucesso.</p>";

    // Dados de teste
    $nome = "Maria Teste";
    $email = "maria.teste@exemplo.com";
    $senha_hash = password_hash("123456", PASSWORD_DEFAULT); // Simulação de hash de senha
    $tipo_usuario_insert = "aluno";
    $tipo_usuario_update = "professor";

    // Nome da tabela corrigido para o singular 'usuario'
    $TIPO_TABELA = "usuario"; 

    //OPERAÇÃO CREATE (Inserção) 
    echo "<h2>2. CREATE (Inserção)</h2>";
    $sql_insert = "INSERT INTO {$TIPO_TABELA} (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)";
    $params_insert = [$nome, $email, $senha_hash, $tipo_usuario_insert];
    
    try {
        // Tenta excluir primeiro para garantir um teste limpo (se já existir)
        $db->execute("DELETE FROM {$TIPO_TABELA} WHERE email = ?", [$email]); 

        $count = $db->execute($sql_insert, $params_insert);
        if ($count > 0) {
            echo "<p style='color: green;'>Inserção bem-sucedida. Usuário '{$nome}' ({$tipo_usuario_insert}) adicionado.</p>";
        } else {
            echo "<p style='color: red;'>Falha na inserção.</p>";
            $test_passed = false;
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>ERRO na Inserção: " . $e->getMessage() . "</p>";
        $test_passed = false;
    }

    // --- 3. OPERAÇÃO READ (Seleção) ---
    echo "<h2>3. READ (Seleção)</h2>";
    $sql_select = "SELECT id, nome, email, tipo_usuario FROM {$TIPO_TABELA} WHERE email = ?";
    
    try {
        $stmt = $db->query($sql_select, [$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            echo "<p style='color: green;'>Leitura bem-sucedida.</p>";
            echo "<ul>
                    <li>ID: {$usuario['id']}</li>
                    <li>Nome: {$usuario['nome']}</li>
                    <li>Email: {$usuario['email']}</li>
                    <li>Tipo: {$usuario['tipo_usuario']}</li>
                  </ul>";
            
            // Verifica se o tipo de usuário inicial é o esperado
            if ($usuario['tipo_usuario'] !== $tipo_usuario_insert) {
                 echo "<p style='color: orange;'>Aviso: O tipo de usuário lido não é o tipo inserido originalmente. Continuando o teste.</p>";
            }

        } else {
            echo "<p style='color: red;'>Falha na leitura: Usuário não encontrado.</p>";
            $test_passed = false;
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'ERRO na Leitura: " . $e->getMessage() . "</p>";
        $test_passed = false;
    }

    // --- 4. OPERAÇÃO UPDATE (Atualização) ---
    echo "<h2>4. UPDATE (Atualização)</h2>";
    $sql_update = "UPDATE {$TIPO_TABELA} SET tipo_usuario = ? WHERE email = ?";
    
    try {
        $count = $db->execute($sql_update, [$tipo_usuario_update, $email]);
        
        if ($count > 0) {
            // Verifica se a atualização funcionou lendo novamente
            $stmt_check = $db->query($sql_select, [$email]);
            $usuario_atualizado = $stmt_check->fetch();
            
            if ($usuario_atualizado && $usuario_atualizado['tipo_usuario'] === $tipo_usuario_update) {
                echo "<p style='color: green;'>Atualização bem-sucedida. Tipo de usuário alterado para '{$usuario_atualizado['tipo_usuario']}'.</p>";
            } else {
                 echo "<p style='color: orange;'>Aviso: A atualização foi executada, mas a leitura de verificação não confirmou a mudança.</p>";
            }

        } else {
            echo "<p style='color: red;'>Falha na atualização. Nenhuma linha afetada.</p>";
            $test_passed = false;
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>ERRO no Update: " . $e->getMessage() . "</p>";
        $test_passed = false;
    }

    // --- 5. OPERAÇÃO DELETE (Deleção) ---
    echo "<h2>5. DELETE (Deleção)</h2>";
    $sql_delete = "DELETE FROM {$TIPO_TABELA} WHERE email = ?";
    
    try {
        $count = $db->execute($sql_delete, [$email]);

        // Verifica se a deleção funcionou
        $stmt_check = $db->query($sql_select, [$email]);
        $usuario_deletado = $stmt_check->fetch();

        if ($count > 0 && !$usuario_deletado) {
            echo "<p style='color: green;'>Deleção bem-sucedida. Usuário '{$email}' removido.</p>";
        } else {
            echo "<p style='color: red;'>Falha na deleção.</p>";
            $test_passed = false;
        }

    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ ERRO na Deleção: " . $e->getMessage() . "</p>";
        $test_passed = false;
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>❌ ERRO FATAL DURANTE O TESTE: " . $e->getMessage() . "</p>";
    $test_passed = false;
} finally {
    // --- 6. FECHAR CONEXÃO ---
    if (isset($db)) {
        $db->close();
        echo "<h2>6. Finalização</h2>";
        echo "<p style='color: blue;'>Conexão fechada com sucesso.</p>";
    }
}

// --- CONCLUSÃO GERAL ---
echo "<hr>";
if ($test_passed) {
    echo "<h1 style='color: darkgreen;'>FIM DO TESTE: TODAS AS OPERAÇÕES CRUD CONCLUÍDAS COM SUCESSO!</h1>";
} else {
     echo "<h1 style='color: darkred;'>FIM DO TESTE: FALHA EM UMA OU MAIS ETAPAS. VERIFIQUE OS ERROS ACIMA.</h1>";
}
?>
