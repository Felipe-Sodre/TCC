<?php
require 'conexao.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$token = $input['token'] ?? null;
$novaSenha = $input['senha'] ?? null;

if (!$token || !$novaSenha) {
  echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
  exit();
}

$stmt = $pdo->prepare("SELECT id_usuario FROM usuario WHERE token_recuperacao = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo json_encode(['success' => false, 'message' => 'Token inválido ou expirado.']);
  exit();
}

// Atualiza senha e remove token
$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE usuario SET senha = ?, token_recuperacao = NULL WHERE id_usuario = ?");
$stmt->execute([$senhaHash, $user['id_usuario']]);

echo json_encode(['success' => true, 'message' => 'Senha redefinida com sucesso!']);
