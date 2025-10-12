<?php
session_start();
require 'conexao.php';
header ('Content-Type: application/json');

//Recebe dados do fetch
$input = json_decode(file_get_contents('php://input'), true);

$nome = trim($input['nome'] ?? '');
$email = trim($input['email'] ?? '');
$senha = trim($input['senha'] ?? '');
$tipo_perfil = trim($input['tipo_perfil'] ?? '');

if(!$nome || !$email || !$senha || !$tipo_perfil){
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos!']);
    exit();
}

//Verifica se o email já existe

$stmt = $pdo->prepare("SELECT COUNT (*) FROM usuario WHERE email = ?");
$stmt-> execute([$email]);
if($stmt->fetchColumn() > 0 ){
    echo json_encode(['success' => false, 'message' => 'Esse e-mail já está cadastrado!']);
    exit();
}
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha, tipo_perfil) VALUES (?, ?, ?, ?)");
$stmt->execute([$nome, $email, $senhaHash, $tipo_perfil]);
//Pega o id do novo usuario
$id_usuario = $pdo->lastInsertId();

//cria sessão
$_SESSION['user_id'] = $id_usuario;
$_SESSION['user_nome'] = $nome;
$_SESSION['user_tipo'] = $tipo_perfil;

// Redireciona de acordo com o tipo
switch ($tipo_perfil) {
  case 'paciente':
    $pagina = 'HTML/PacientePage.html';
    break;
  case 'profissional':
    $pagina = 'HTML/ProfissionalPage.html';
    break;
  case 'familiar':
    $pagina = 'HTML/Responsaveis.html';
    break;
  default:
    $pagina = 'HTML/Login.php';
}
echo json_encode(['success' => true, 'redirect' => $pagina]);
?>