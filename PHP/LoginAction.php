<?php
require 'conexao.php';
header('Content-Type: application/json');

//recebe os dados enviados pelo Login.js
$input = json_decode(file_get_contents('php://input'), true);
$email = trim($input['email'] ?? '');
$senha = trim($input['senha'] ?? '');

//verifica se os dados foram preenchidos
if (empty($email) || empty($senha)){
  echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
  exit();
}

//Função genérica para autenticar usuário em tabela
function autenticar ($pdo, $tabela, $email, $senha){
    $stmt = $pdo->prepare("SELECT id_usuario, nome, email, senha FROM $tabela WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

  if($user && password_verify($senha,$user['senha'])){
    return['id_usuario' => $user['id_usuario'], 'nome' => $user['nome'], 'tipo_perfil' => $tabela];
  }
  return false;
}
//Tabela que o sistema pode verificar
$table = ['usuario'];

$login = null;

//Percorre a tabela até encontrar o usuário
foreach($table as $tabela){
  $login = autenticar($pdo, $tabela, $email, $senha);
  if($login) break;
}

//Se o login for bem sucedido
if($login){
    $_SESSION['user_id'] = $login['id_usuario'];
    $_SESSION['user_name'] = $login['nome'];
    $_SESSION['user_tipo'] = $login['tipo_perfil'];

  echo json_encode([ 'success' => true, 'tipo_perfil' => $login['tipo_perfil'], 'nome' => $login['nome']]);
}else{
  echo json_encode(['success' => false, 'message' => 'Email ou senha incorretos.']);
}
?>


