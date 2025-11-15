document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formCadastro");
  const msg = document.getElementById("msg");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Coleta os dados do formulário
    const data = {
      nome: form.nome.value.trim(),
      email: form.email.value.trim(),
      senha: form.senha.value.trim(),
      tipo_perfil: form.tipo_perfil.value.trim()
    };

    // (Opcional) validação simples no front
    if (!data.nome || !data.email || !data.senha || !data.tipo_perfil) {
      msg.textContent = "Preencha todos os campos!";
      msg.style.color = "red";
      return;
    }

    try {
      // IMPORTANTE: ajuste esse caminho de acordo com a pasta onde seu HTML está
      const res = await fetch("../PHP/cadastrarAction.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const json = await res.json();

      msg.textContent = json.message || "";
      msg.style.color = json.success ? "green" : "red";

      if (json.success) {
        // Dá um tempinho pro usuário ver a mensagem
        setTimeout(() => {
          window.location.href = json.redirect;
        }, 1500);
      }

    } catch (err) {
      console.error("Erro no fetch:", err);
      msg.textContent = "Erro na conexão com o servidor.";
      msg.style.color = "red";
    }
  });
});
