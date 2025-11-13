<?php
require 'conexao.php';
header('Content-Type: application/json');

try {
  $stmt = $pdo->query("
    SELECT profissional.id_profissional, usuario.nome 
    FROM profissional
    INNER JOIN usuario
    ON profissional.id_usuario = usuario.id_usuario
    WHERE usuario.tipo = 'Profissional'
    ORDER BY usuario.nome
  ");

  $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($profissionais);

} catch (Exception $e) {
  echo json_encode([]);
}
