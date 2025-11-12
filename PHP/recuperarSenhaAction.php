<?php
require 'conexao.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$email = trim($input['email'] ?? '');

if (!$email) {
  echo json_encode(['success' => false, 'message' => 'Informe o e-mail!']);
  exit();
}

// Verifica se o e-mail existe
$stmt = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo json_encode(['success' => false, 'message' => 'E-mail não encontrado.']);
  exit();
}

// Gera token (simulação de link de redefinição)
$token = bin2hex(random_bytes(16));

// Armazena token no banco (ou em uma tabela separada)
$stmt = $pdo->prepare("UPDATE usuario SET token_recuperacao = ? WHERE id_usuario = ?");
$stmt->execute([$token, $user['id_usuario']]);

$link = "http://localhost/TCC/redefinir.php?token=" . $token;

echo json_encode([
  'success' => true,
  'message' => 'Um link de redefinição foi gerado (simulação).',
  'link' => $link
]);
