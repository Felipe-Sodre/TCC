<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Apoio Conecta</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="../CSS/Login.css">
    <script src="../JavaScript/Login.js" defer></script>
</head>
<body>

    <div class="login-container">
        
        <div class="logo">
            <i class="fas fa-brain"></i>
            <span>Apoio Conecta</span>
        </div>

        <div class="login-box">
            <h1>Acesso ao Portal</h1>
            <p class="description">Entre com seu e-mail e senha para continuar.</p>
            
            <form id="formLogin" class="login-form">
                
                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                    <input type="email" name="email" id="email" placeholder="seu.email@exemplo.com" required>
                </div>

                <div class="input-group">
                    <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>

            <div class="recovery-link">
                <a href="RecuperarSenha.html">Esqueceu sua senha?</a>
            </div>
            
            <p id="msg"></p>
        </div>
    </div>

</body>
</html>
