document.addEventListener('DOMContentLoaded', function() {
    const feedback = document.getElementById('feedback');
    const agendarBtn = document.getElementById('agendarBtn');
    const historicoBtn = document.getElementById('historicoBtn');
    const conteudosBtn = document.getElementById('conteudosBtn');
    const escutaBtn = document.getElementById('escutaBtn');
    const logoutBtn = document.getElementById('logoutBtn');

    // Função para mostrar uma mensagem de feedback
    function showFeedback(message) {
        feedback.textContent = message;
        feedback.style.display = 'block';
        setTimeout(() => {
            feedback.style.display = 'none';
        }, 5000); // Esconde a mensagem após 5 segundos
    }

    // Eventos de clique para simular ações
    agendarBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // Em um sistema real, aqui iria para a página de agendamento
        showFeedback("Você será redirecionado para a página de agendamento em breve.");
    });

    historicoBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Carregando seu histórico de atendimentos...");
    });
    
    conteudosBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Acessando a biblioteca de conteúdos. Prepare-se para aprender!");
    });
    
    escutaBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showFeedback("Iniciando o Canal de Escuta. Mantenha a calma, estamos aqui por você.");
    });

    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        alert("Sessão encerrada com sucesso. Redirecionando para a tela de Login.");
        // Em um sistema real, aqui haveria uma chamada para limpar a sessão no servidor.
        window.location.href = "../HTML/Login.html"; 
    });
});
