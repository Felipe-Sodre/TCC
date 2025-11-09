document.addEventListener('DOMContentLoaded', function() {
    const feedback = document.getElementById('feedback');
    const statusBtn = document.getElementById('statusBtn');
    const agendarParaPacienteBtn = document.getElementById('agendarParaPacienteBtn');
    const materiaisBtn = document.getElementById('materiaisBtn');
    const suporteBtn = document.getElementById('suporteBtn');
    const logoutBtn = document.getElementById('logoutBtn');

    function showFeedback(message) {
        feedback.textContent = message;
        feedback.style.display = 'block';
        setTimeout(() => {
            feedback.style.display = 'none';
        }, 5000); 
    }

    // Eventos de clique para simular ações
    statusBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Buscando o status atual e informações do seu familiar/paciente...");
    });

    agendarParaPacienteBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Iniciando o agendamento de consultas para o paciente...");
    });
    
    materiaisBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Acessando conteúdos e guias de apoio para responsáveis e cuidadores.");
    });
    
    suporteBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Conectando ao canal de suporte emergencial. Mantenha a calma.");
    });

    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        alert("Sessão encerrada com sucesso. Redirecionando para a tela de Login.");
        window.location.href = "Login.html"; 
    });
});