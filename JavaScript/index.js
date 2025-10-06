//// FELIPE SODRÉ ////

//IR PARA A PAGINA INDEX COM O BOTÃO INICIO
//document.getElementById("btnInicio").addEventListener("click", function() {
  //window.location.href = "index.html";
//});


document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById("btnInicio");

    btn.addEventListener("click", function() {
        // Vai para a página index.html
        window.location.href = "index.html";
    });
});







