--java script para a pagina ProfissionalRelatorios--

// ProfissionalRelatorios.js
document.addEventListener('DOMContentLoaded', function() {
    // Verifica se Chart.js carregou
    if (typeof Chart === 'undefined') {
        console.error('Chart.js não carregou!');
        showChartFallbacks();
        return;
    }
    
    // Se Chart.js carregou, criar gráficos
    createCharts();
    
    // Configurar botões
    setupButtons();
});

function createCharts() {
    // Gráfico de Consultas por Mês
    const consultationsCtx = document.getElementById('consultationsChart');
    if (consultationsCtx) {
        new Chart(consultationsCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Consultas Realizadas',
                    data: [18, 22, 25, 20, 23, 28, 26, 30, 28, 24, 20, 15],
                    backgroundColor: 'rgba(67, 97, 238, 0.7)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    }

    // Gráfico de Tipo de Consulta
    const typeCtx = document.getElementById('consultationTypeChart');
    if (typeCtx) {
        new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Online', 'Presencial', 'Híbrida'],
                datasets: [{
                    data: [65, 30, 5],
                    backgroundColor: [
                        'rgba(67, 97, 238, 0.7)',
                        'rgba(114, 9, 183, 0.7)',
                        'rgba(76, 201, 240, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Gráfico de Progresso
    const progressCtx = document.getElementById('progressChart');
    if (progressCtx) {
        new Chart(progressCtx, {
            type: 'line',
            data: {
                labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6'],
                datasets: [
                    {
                        label: 'Melissa A.',
                        data: [45, 52, 68, 74, 82, 85],
                        borderColor: 'rgba(67, 97, 238, 1)',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Giovani',
                        data: [30, 42, 55, 60, 68, 72],
                        borderColor: 'rgba(114, 9, 183, 1)',
                        backgroundColor: 'rgba(114, 9, 183, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Carlos',
                        data: [25, 35, 48, 52, 58, 65],
                        borderColor: 'rgba(76, 201, 240, 1)',
                        backgroundColor: 'rgba(76, 201, 240, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    }
}

function setupButtons() {
    const actionButtons = document.querySelectorAll('.btn-outline, .btn-download');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const buttonText = this.textContent.trim();
            if (buttonText.includes('Exportar')) {
                alert('Relatório exportado com sucesso!');
            } else if (buttonText.includes('Visualizar')) {
                alert('Abrindo relatório detalhado...');
            }
        });
    });
}

function showChartFallbacks() {
    // Código de fallback caso Chart.js não carregue
    const charts = ['consultationsChart', 'consultationTypeChart', 'progressChart'];
    charts.forEach(chartId => {
        const element = document.getElementById(chartId);
        if (element) {
            element.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #666;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 15px;"></i>
                    <p>Gráfico não pôde ser carregado</p>
                    <small>Verifique a conexão com a internet</small>
                </div>
            `;
        }
    });
}
