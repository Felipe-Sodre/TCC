<?php
// Inclui o arquivo de conexão PDO
require_once 'conexao.php'; 

// --- Lógica de Segurança (simulada) ---
// Em um cenário real, você verificaria se o usuário está logado e se é um responsável
// if (!isset($_SESSION['responsavel_logado'])) {
//     header('Location: login.html');
//     exit;
// }

// Obtém o ID do responsável logado (simulação)
$responsavel_id = 2; // ID fixo para exemplo

// Valor padrão caso a busca falhe
$nome_responsavel = "Responsável Exemplo"; 

try {
    // 1. Prepara a consulta para obter o nome do responsável (assumindo uma tabela 'responsaveis')
    $stmt = $pdo->prepare("SELECT nome FROM responsaveis WHERE id = :id");
    
    // 2. Vincula o ID à consulta
    $stmt->bindParam(':id', $responsavel_id, PDO::PARAM_INT);
    
    // 3. Executa a consulta
    $stmt->execute();
    
    // 4. Busca o resultado
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nome_responsavel = $row['nome'];
    }

} catch (PDOException $e) {
    // Em caso de erro, apenas registra
    error_log("Erro ao buscar dados do responsável: " . $e->getMessage());
}

/*
Para exibir o nome na página: 
Você usaria um sistema de templates ou buffer para substituir [Nome do Responsável]
no HTML pelo valor da variável $nome_responsavel antes de enviar a página ao navegador.
*/

?>