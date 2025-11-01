<?php
//Arquivo: model/logout.php

//Inicia a sessão.
session_start();

// 2. Limpa todas as variáveis da sessão
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//destrói a sessão
session_destroy();

//Redireciona o usuário. 
header("Location:Login.html"); 
exit();
?>



// fazerLogin(loginData);
