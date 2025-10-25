<?php
// Inclui o arquivo de conexão PDO para reutilizar a conexão com o banco de dados.
require_once 'conexao.php'; 

// --- Lógica de Segurança (simulada) ---
// Em um cenário real, você verificaria se o usuário está logado
// if (!isset($_SESSION['paciente_logado'])) {
//     header('Location: login.html');
//     exit;
// }

// Obtém o ID do paciente logado (simulação)
$paciente_id = 1; // ID fixo para exemplo

// --- Lógica de Busca de Dados ---
$nome_paciente = "Usuário Teste"; // Valor padrão caso a busca falhe

try {
    // 1. Prepara a consulta para obter o nome do paciente
    $stmt = $pdo->prepare("SELECT nome FROM pacientes WHERE id = :id");
    
    // 2. Vincula o ID à consulta
    $stmt->bindParam(':id', $paciente_id, PDO::PARAM_INT);
    
    // 3. Executa a consulta
    $stmt->execute();
    
    // 4. Busca o resultado
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nome_paciente = $row['nome'];
    }

} catch (PDOException $e) {
    // Em caso de erro, apenas registra ou usa o nome padrão
    error_log("Erro ao buscar dados do paciente: " . $e->getMessage());
}

// O restante do código PHP processaria requisições de agendamento, histórico, etc.

/*
Abaixo, o PHP poderia carregar e exibir o PacientePage.html com dados dinâmicos.
Exemplo de como o nome seria injetado no HTML:

$html = file_get_contents('PacientePage.html');
$html = str_replace('[Nome do Paciente]', $nome_paciente, $html);
echo $html;

*/

// Por simplicidade, este arquivo PHP simplesmente define o nome para uso futuro.
// Em uma arquitetura MVC, esta seria a camada Model/Controller.
?>
