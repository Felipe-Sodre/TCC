<?php
require 'conexao.php';
session_start();
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$id_paciente = $_SESSION['Usuario']['id_usuario'] ?? null;
$id_profissional = $input['profissional'] ?? null;
$data = $input['data'] ?? null;
$hora = $input['hora'] ?? null;
$obs = $input['obs'] ?? '';

if (!$id_paciente || !$id_profissional || !$data || !$hora) {
  echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
  exit;
}

$dataHora = $data . ' ' . $hora . ':00';
$duracao = 60; // tempo padrão em minutos
$status = 'Pendente';

$stmt = $pdo->prepare("INSERT INTO atendimento (id_profissional, id_paciente, data_hora, duracao_minutos, observacoes, status)
                       VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$id_profissional, $id_paciente, $dataHora, $duracao, $obs, $status]);

echo json_encode(['success' => true, 'message' => 'Atendimento agendado com sucesso!']);
