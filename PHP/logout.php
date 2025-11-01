<?php
// Arquivo: model/logout.php

// 1. Inicia a sessão. É NECESSÁRIO para poder manipular a sessão existente.
session_start();

// 2. Limpa todas as variáveis da sessão
$_SESSION = array();

// 3. Verifica se um cookie de sessão foi usado e destrói
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Finalmente, destrói a sessão
session_destroy();

// 5. Redireciona o usuário. 
// A localização deste arquivo é em 'model/logout.php'. 
// Se a página de login estiver na RAIZ do projeto (e não dentro de 'model/'),
// o '../' é necessário para subir um nível.
// Altere 'login.html' para a sua página de login real.
header("Location:Login.html"); 
exit();
?>

// URL do seu script PHP de login
const LOGIN_URL = 'http://localhost/neuro_apoio_conecta_bd/model/login.php';

// Os dados que o usuário digitou
const loginData = {
    email: 'seu_email_aqui@exemplo.com', // Mude para o valor do campo de e-mail
    senha: 'sua_senha_aqui'             // Mude para o valor do campo de senha
};

async function fazerLogin(data) {
    try {
        const response = await fetch(LOGIN_URL, {
            method: 'POST',
            
            // ESSENCIAL: Diz ao PHP que o corpo é JSON
            headers: {
                'Content-Type': 'application/json' 
            },
            
            // ESSENCIAL: Converte o objeto JS para uma string JSON
            body: JSON.stringify(data) 
        });

        // Tenta ler a resposta JSON
        const result = await response.json();

        if (result.success) {
            console.log("Login bem-sucedido! Redirecionando...");
            console.log("Tipo de Perfil:", result.tipo_perfil);
            // Aqui você faria o redirecionamento (ex: window.location.href = 'dashboard.html')
        } else {
            // Exibe a mensagem de erro que veio do PHP
            console.error("Falha no Login:", result.message);
            // Exibe o erro para o usuário na tela de login
        }

    } catch (error) {
        console.error('Erro na comunicação com o servidor:', error);
    }
}

// Exemplo de chamada:
// fazerLogin(loginData);