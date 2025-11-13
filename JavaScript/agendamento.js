document.addEventListener("DOMContentLoaded", async () => {
  const selectProf = document.getElementById("profissional");
  const form = document.getElementById("formAgendamento");
  const msg = document.getElementById("msg");

  // 🔹 Carregar lista de profissionais
  try {
    const res = await fetch("PHP/getProfissionais.php");
    const profissionais = await res.json();

    selectProf.innerHTML = '<option value="">Selecione</option>';
    profissionais.forEach(p => {
      const opt = document.createElement("option");
      opt.value = p.id_profissional;
      opt.textContent = p.nome;
      selectProf.appendChild(opt);
    });
  } catch {
    selectProf.innerHTML = '<option value="">Erro ao carregar</option>';
  }

  // 🔹 Enviar agendamento
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
      profissional: selectProf.value,
      data: form.data.value,
      hora: form.hora.value,
      obs: form.obs.value
    };

    try {
      const res = await fetch("PHP/agendarAction.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const json = await res.json();
      msg.textContent = json.message;
      msg.style.color = json.success ? "green" : "red";

      if (json.success) {
        form.reset();
      }
    } catch {
      msg.textContent = "Erro na conexão com o servidor.";
      msg.style.color = "red";
    }
  });
});
