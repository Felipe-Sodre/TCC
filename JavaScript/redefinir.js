document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formRedefinir");
  const msg = document.getElementById("msg");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
      token: document.getElementById("token").value,
      senha: document.getElementById("senha").value
    };

    const res = await fetch("PHP/redefinirSenhaAction.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });

    const json = await res.json();
    msg.textContent = json.message;
    msg.style.color = json.success ? "green" : "red";

    if (json.success) {
      setTimeout(() => window.location.href = "Login.php", 1500);
    }
  });
});
