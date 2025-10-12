//// FELIPE SODRÉ/MELISSA ////
// JavaScript - Navegação do site Apoio Conecta
document.addEventListener("DOMContentLoaded", function() {

    // =====================
    // BOTÕES PRINCIPAIS
    // =====================
    const btnApoio = document.querySelector(".cta-button-blue");
    const btnAjudar = document.querySelector(".cta-button-green");

    // "Preciso de Apoio"
    if (btnApoio) {
        btnApoio.addEventListener("click", function(event) {
            event.preventDefault();
            window.location.href = "HTML/Login.html"; // Página destino
        });
    }

    // "Quero Ajudar"
    if (btnAjudar) {
        btnAjudar.addEventListener("click", function(event) {
            event.preventDefault();
            window.location.href = "HTML/Cadastro.html";
        });
    }

    // =====================
    // ÍCONES DA SEÇÃO "SOBRE"
    // =====================
    const icones = document.querySelectorAll(".icones-sobre .icone-item a");

    icones.forEach(icone => {
        icone.addEventListener("click", function(event) {
            event.preventDefault(); // Evita comportamento padrão
            const destino = this.getAttribute("href");
            if (destino && destino !== "#") {
                window.location.href = destino; // Navega até a página do ícone
            }
        });
    });

    // =====================
    // MENU DE NAVEGAÇÃO (opcional)
    // =====================
    const menuLinks = document.querySelectorAll(".navbar nav ul li a");

    menuLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            const destino = this.getAttribute("href");
            if (destino && destino !== "#") {
                event.preventDefault();
                window.location.href = destino;
            }
        });
    });
});








