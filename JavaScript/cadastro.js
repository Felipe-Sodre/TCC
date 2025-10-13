document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formCadastro");
  const msg = document.getElementById("msg");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
      nome: form.nome.value,
      email: form.email.value,
      senha: form.senha.value,
      tipo_perfil: form.tipo_perfil.value
    };

    try {
      const res = await fetch("PHP/cadastrarAction.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const json = await res.json();
      msg.textContent = json.message || "";

      if (json.success) {
        msg.style.color = "green";
        setTimeout(() => {
          window.location.href = json.redirect;
        }, 1500);
      } else {
        msg.style.color = "red";
      }

    } catch (err) {
      console.error(err);
      msg.textContent = "Erro ao conectar com o servidor.";
      msg.style.color = "red";
    }
  });
});
