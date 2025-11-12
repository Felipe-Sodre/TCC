<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="CSS/.css">
  <script src="JavaScript/recuperar.js" defer></script>
</head>
<body>
  <main class="">
    <h2>Recuperar Senha</h2>

    <form id="formRecuperar">
      <label for="email">Digite seu e-mail cadastrado:</label>
      <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>

      <button type="submit">Enviar código</button>
    </form>

    <p id="msg"></p>
  </main>
</body>
</html>
