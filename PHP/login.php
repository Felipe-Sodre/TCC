<?php
//Arquivo: login.php

session_start();

//arquivos necessários

require_once '../config/config.php';
require_once '../model/Database.php';
require_once '../model/Usuario.php'; 


header('Content-Type: application/json');

//resposta padrão de erro
$response = ['success' => false, 'message' => 'Erro interno do servidor.'];

try {
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = trim($input['email'] ?? '');
    $senha = trim($input['senha'] ?? '');
    
   
    if (empty($email) || empty($senha)) {
        $response = ['success' => false, 'message' => 'Preencha todos os campos.'];
        echo json_encode($response);
        exit();
    }

    //Inicializa a conexão com o banco de dados e a classe Usuario
    $db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET);
  
    
    $usuarioModel = new Usuario($db);

    //Busca o usuário pelo e-mail
 
    $user = $usuarioModel->buscarPorEmail($email);
    
    
    if ($user) {
       
        if (password_verify($senha, $user['senha_hash'])) {
            
            //LOGIN BEM-SUCEDIDO
            $_SESSION['user_id'] = $user['id']; //Usando 'id' conforme definido na classe Usuario.php
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_tipo'] = $user['tipo_usuario']; //Usando 'tipo_usuario'
            
            //Envia a resposta de sucesso
            $response = [
                'success' => true, 
                'tipo_perfil' => $user['tipo_usuario'], 
                'nome' => $user['nome']
            ];
            
        } else {
            //Senha incorreta
            $response = ['success' => false, 'message' => 'Email ou senha incorretos.'];
        }
    } else {
        //Usuário não encontrado
        $response = ['success' => false, 'message' => 'Email ou senha incorretos.'];
    }

} catch (Exception $e) {
  
    error_log("Login Error: " . $e->getMessage());
    $response = ['success' => false, 'message' => 'Ocorreu um erro no processamento do login.'];
}

// 10. Envia a resposta final (de sucesso ou falha)
echo json_encode($response);

// 11. Finaliza o script
exit();
?>
