document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formRecuperar");
  const msg = document.getElementById("msg");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = { email: form.email.value };

    try {
      const res = await fetch("PHP/recuperarSenhaAction.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const json = await res.json();
      msg.textContent = json.message;
      msg.style.color = json.success ? "green" : "red";

      if (json.success) {
        msg.innerHTML += `<br><a href="${json.link}">Clique aqui para redefinir (teste)</a>`;
      }
    } catch (err) {
      console.error(err);
      msg.textContent = "Erro ao conectar com o servidor.";
      msg.style.color = "red";
    }
  });
});
