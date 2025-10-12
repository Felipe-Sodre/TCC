document.addEventListener("DOMContentLoaded", () =>{
  const form = document.getElementById("formLogin");
                                       form.addEventListener("submit", async (e) => {
                                         e.preventDefault();
                                         const data = {
                                           email: form.email.value,
                                           senha: form.senha.value
                                         };
                                         try{
                                           const res = await fetch("../PHP/LoginAction.php", {
                                             method: "POST",
                                             headers: {"Content-Type":"application/json"},
                                             body: JSON.stringify(data)
                                           });
                                           const json = await res.json();
                                           if(json.success){
                                             switch(json.tipo_perfil){
                                               case "paciente":
                                                 window.location.href = "HTML/PacientePage.html";
                                                 break;
                                               case "familiar":
                                                 window.location.href = "HTML/Responsaveis.html";
                                                 break;
                                               case "profissional":
                                                 window.location.href = "HTML/ProfissionalPage.html";
                                               case "admin":
                                                 window.location.href " "HTML/AdminPage.html";
                                                 break;
                                               default:
                                                 alert("Tipo de usuário desconhecido.");
                                             }
                                           }else{
                                             alert(json.message);
                                           }
                                         }catch(err){
                                           console.error(err);
                                           alert("Erro na conexão com o servidor.");
                                         }
                                       });
});






