/* --- MINI CALENDÁRIO --- */

function updateSimpleCalendar() {
    const today = new Date();
    const currentMonth = today.getMonth();
    const currentYear = today.getFullYear();

    const monthNames = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    // 1. Atualiza o título (Mês e Ano)
    const calendarTitle = document.getElementById('calendarTitle');
    if (calendarTitle) {
        calendarTitle.innerHTML = `<i class="fas fa-calendar-alt"></i> ${monthNames[currentMonth]} ${currentYear}`;
    }

    // 2. Prepara a grade dos dias
    const daysContainer = document.getElementById('calendarGrid');
    if (!daysContainer) return; // Se o elemento não for encontrado, para a função
    
    daysContainer.innerHTML = '';

    const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    const startingDay = firstDayOfMonth.getDay(); // 0 (Dom) a 6 (Sáb)
    const totalDaysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // 3. Adiciona as células vazias para alinhamento
    for (let i = 0; i < startingDay; i++) {
        const emptyDay = document.createElement('span');
        emptyDay.classList.add('empty');
        daysContainer.appendChild(emptyDay);
    }

    // 4. Adiciona os dias do mês
    for (let day = 1; day <= totalDaysInMonth; day++) {
        const dayElement = document.createElement('span');
        dayElement.classList.add('day');
        dayElement.textContent = day;

        // Se for o dia de hoje, adiciona a classe 'today'
        if (day === today.getDate()) {
            dayElement.classList.add('today');
        }

        // Exemplo de marcação de dia com consulta (baseado no seu HTML anterior)
        // Isso é apenas um exemplo visual, você precisa adaptar à sua lógica real de agendamento.
        if (day === 6 || day === 9 || day === 17) {
             dayElement.classList.add('has-appointment');
        }

        daysContainer.appendChild(dayElement);
    }
}

// Executa a função quando a página for carregada
document.addEventListener('DOMContentLoaded', updateSimpleCalendar);
