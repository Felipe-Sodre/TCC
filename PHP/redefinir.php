<?php
require 'PHP/conexao.php';

$token = $_GET['token'] ?? null;
if (!$token) {
  echo "<h3>Token inválido ou expirado.</h3>";
  exit();
}

// Verifica se o token é válido
$stmt = $pdo->prepare("SELECT id_usuario FROM usuario WHERE token_recuperacao = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo "<h3>Token inválido ou expirado.</h3>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
  <link rel="stylesheet" href="CSS/.css">
  <script src="JavaScript/redefinir.js" defer></script>
</head>
<body>
  <main class="recuperar-container">
    <h2>Redefinir Senha</h2>

    <form id="formRedefinir">
      <input type="hidden" id="token" value="<?= htmlspecialchars($token) ?>">

      <label for="senha">Nova senha:</label>
      <input type="password" id="senha" placeholder="Digite sua nova senha" required>

      <button type="submit">Atualizar Senha</button>
    </form>

    <p id="msg"></p>
  </main>
</body>
</html>
