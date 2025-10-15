//// FELIPE SODRÉ / MELISSA ////
// JavaScript - Navegação do site Apoio Conecta
document.addEventListener("DOMContentLoaded", function() {

    // =====================
    // BOTÕES PRINCIPAIS
    // =====================
    const btnApoio = document.querySelector(".cta-button-blue");
    const btnAjudar = document.querySelector(".cta-button-green");

    if (btnApoio) {
        btnApoio.addEventListener("click", function(event) {
            event.preventDefault();
            window.location.href = "HTML/Login.html";
        });
    }

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
            event.preventDefault();
            const destino = this.getAttribute("href");
            if (destino && destino !== "#") {
                window.location.href = destino;
            }
        });
    });

    // =====================
    // MENU DE NAVEGAÇÃO
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

    // =====================
    // SLIDES DE DEPOIMENTOS
    // =====================
    const slides = document.querySelectorAll(".slide-texto p");
    let index = 0;

    function mostrarSlide() {
        slides.forEach(slide => slide.classList.remove("slide-ativo"));
        slides[index].classList.add("slide-ativo");
        index = (index + 1) % slides.length;
    }

    // Troca o slide a cada 4 segundos
    if (slides.length > 0) {
        setInterval(mostrarSlide, 4000);
    }
});
