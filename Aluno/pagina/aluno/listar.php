




<div class="container-aluno">
    <!-- Perfil do Aluno -->
    <div class="perfil-aluno">
        <div class="info-perfil">
            <h2><?php echo $cliente->nomeCliente ?>; </h2>
            <p><strong>Idade:</strong> 25 anos</p>
            <p><strong>Email:</strong> joao.silva@email.com</p>
            <p><strong>Objetivo:</strong> Ganho de massa muscular</p>
        </div>
    </div>

    <!-- Agendamentos de Aulas -->
    <div class="agenda">
        <h2>Agendamentos de Aulas</h2>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Aula</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>15/08/2024</td>
                    <td>10:00</td>
                    <td>Yoga</td>
                    <td>Confirmado</td>
                </tr>
                <!-- Mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>

    <!-- Planos de Treino -->
    <div class="planos-treino">
        <h2>Planos de Treino</h2>
        <div class="plano">
            <h3>Plano 1: Ganho de Massa Muscular</h3>
            <ul>
                <li>Segunda-feira: Peito e Tríceps</li>
                <li>Quarta-feira: Costas e Bíceps</li>
                <li>Sexta-feira: Pernas e Ombros</li>
            </ul>
        </div>
        <!-- Mais planos conforme necessário -->
    </div>



    <!-- Notificações e Mensagens -->
    <div class="notificacoes">
        <h2>Notificações</h2>
        <ul>
            <li>Seu agendamento para a aula de Yoga foi confirmado.</li>
            <li>Seu plano de treino foi atualizado.</li>
        </ul>
    </div>

    <!-- Conteúdo Educativo -->
    <div class="conteudo-educativo">
        <h2>Conteúdo Educativo</h2>
        <div class="artigo">
            <h3>Dicas para uma Alimentação Balanceada</h3>
            <p>Manter uma alimentação equilibrada é crucial para o seu desempenho na academia. Aqui estão algumas dicas...</p>
        </div>
        <!-- Mais artigos conforme necessário -->
    </div>
</div>


<script>
    // Relatórios e Estatísticas
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('graficoDesempenho').getContext('2d');
        var graficoDesempenho = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
                datasets: [{
                    label: 'Peso (kg)',
                    data: [70, 72, 74, 73, 75],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    // Calendário (exemplo de uso do FullCalendar)
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'pt-br',
            editable: true,
            selectable: true,
            eventClick: function(info) {
                alert('Evento: ' + info.event.title + '\nData: ' + info.event.start.toDateString() + '\nDetalhes: ' + info.event.extendedProps.details);
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch('listar_evento.php') // Caminho para o arquivo PHP que retorna os eventos em JSON
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
            }
        });
        calendar.render();
    });
</script>