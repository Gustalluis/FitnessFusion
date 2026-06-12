<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadoras</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="calculadoras">
        <div class="cont">
            <h1>Calculadora de IMC</h1>
            <div class="calculator">
                <label for="peso-imc">Peso (kg):</label>
                <input type="number" id="peso-imc" min="0" step="0.1" placeholder="Digite seu peso">
                <label for="altura-imc">Altura (m):</label>
                <input type="number" id="altura-imc" min="0" step="0.01" placeholder="Digite sua altura">
                <button onclick="calcularIMC()">Calcular IMC</button>
                <div id="resultado-imc"></div>
            </div>
        </div>

        <div class="cont">
            <h1>Calculadora de Calorias</h1>
            <div class="calculator">
                <label for="idade-calorias">Idade:</label>
                <input type="number" id="idade-calorias" min="1" placeholder="Digite sua idade">
                <label for="peso-calorias">Peso (kg):</label>
                <input type="number" id="peso-calorias" min="0" step="0.1" placeholder="Digite seu peso">
                <label for="altura-calorias">Altura (m):</label>
                <input type="number" id="altura-calorias" min="0" step="0.01" placeholder="Digite sua altura">
                <label for="genero">Gênero:</label>
                <select id="genero">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>
                <label for="nivel-atividade">Nível de Atividade:</label>
                <select id="nivel-atividade">
                    <option value="1.2">Sedentário (pouco ou nenhum exercício)</option>
                    <option value="1.375">Levemente ativo (exercício leve/1-3 dias por semana)</option>
                    <option value="1.55">Moderadamente ativo (exercício moderado/3-5 dias por semana)</option>
                    <option value="1.725">Muito ativo (exercício pesado/6-7 dias por semana)</option>
                    <option value="1.9">Extra ativo (exercício muito pesado/dia e trabalho físico)</option>
                </select>
                <button onclick="calcularCalorias()">Calcular Calorias</button>
                <div id="resultado-calorias"></div>
            </div>
        </div>

        <div class="cont">
            <h1>Calculadora de Repetição Máxima</h1>
            <div class="calculator">
                <label for="unidade">Unidade de Peso:</label>
                <select id="unidade">
                    <option value="kg">Kg</option>
                    <option value="libras">Libras</option>
                </select>
                <label for="repeticoes">Número de Repetições:</label>
                <input type="number" id="repeticoes" min="1" placeholder="Número de repetições">
                <label for="peso-rm">Levantamento de Peso:</label>
                <input type="number" id="peso-rm" min="0" step="0.1" placeholder="Peso levantado">
                <button onclick="calcularRM()">Calcular Repetição Máxima</button>
                <div id="resultado-rm"></div>
            </div>
        </div>
    </main>
    <script>
        function calcularIMC() {
            // Obter o peso e altura digitados pelo usuário
            let peso = parseFloat(document.getElementById('peso-imc').value);
            let altura = parseFloat(document.getElementById('altura-imc').value);

            // Verificar se os valores de peso e altura são válidos
            if (isNaN(peso) || isNaN(altura) || peso <= 0 || altura <= 0) {
                alert('Por favor, digite valores válidos para peso e altura.');
                return;
            }

            // Calcular o IMC
            let imc = peso / (altura * altura);

            // Exibir o resultado na página
            let resultado = document.getElementById('resultado-imc');
            resultado.innerHTML = `Seu IMC é: ${imc.toFixed(2)}`;

            // Classificar o IMC
            if (imc < 18.5) {
                resultado.innerHTML += '<br>Abaixo do peso';
            } else if (imc >= 18.5 && imc < 24.9) {
                resultado.innerHTML += '<br>Peso normal';
            } else if (imc >= 24.9 && imc < 29.9) {
                resultado.innerHTML += '<br>Sobrepeso';
            } else if (imc >= 29.9 && imc < 34.9) {
                resultado.innerHTML += '<br>Obesidade Grau I';
            } else if (imc >= 34.9 && imc < 39.9) {
                resultado.innerHTML += '<br>Obesidade Grau II';
            } else {
                resultado.innerHTML += '<br>Obesidade Grau III';
            }
        }
    </script>

    <script>
        function calcularCalorias() {
            // Obter os valores digitados pelo usuário
            let idade = parseInt(document.getElementById('idade-calorias').value);
            let peso = parseFloat(document.getElementById('peso-calorias').value);
            let altura = parseFloat(document.getElementById('altura-calorias').value);
            let genero = document.getElementById('genero').value;
            let nivelAtividade = parseFloat(document.getElementById('nivel-atividade').value);

            // Verificar se os valores são válidos
            if (isNaN(idade) || isNaN(peso) || isNaN(altura) || idade <= 0 || peso <= 0 || altura <= 0) {
                alert('Por favor, preencha todos os campos com valores válidos.');
                return;
            }

            // Calcular a Taxa Metabólica Basal (TMB) usando a fórmula de Harris-Benedict
            let tmb;
            if (genero === 'masculino') {
                tmb = 88.362 + (13.397 * peso) + (4.799 * altura * 100) - (5.677 * idade);
            } else if (genero === 'feminino') {
                tmb = 447.593 + (9.247 * peso) + (3.098 * altura * 100) - (4.330 * idade);
            } else {
                alert('Selecione o gênero.');
                return;
            }

            // Calcular as calorias diárias estimadas baseadas no nível de atividade
            let caloriasEstimadas = tmb * nivelAtividade;

            // Exibir o resultado na página
            let resultado = document.getElementById('resultado-calorias');
            resultado.innerHTML = `Calorias estimadas por dia: ${caloriasEstimadas.toFixed(2)} kcal`;
        }
    </script>

    <script>
        function calcularRM() {
            // Obter os valores digitados pelo usuário
            let unidade = document.getElementById('unidade').value;
            let repeticoes = parseInt(document.getElementById('repeticoes').value);
            let peso = parseFloat(document.getElementById('peso-rm').value);

            // Verificar se os valores são válidos
            if (isNaN(repeticoes) || isNaN(peso) || repeticoes <= 0 || peso <= 0) {
                alert('Por favor, preencha todos os campos com valores válidos.');
                return;
            }

            // Calcular a repetição máxima usando a fórmula de estimativa de 1RM
            let repeticaoMaxima;
            if (unidade === 'libras') {
                // Converter libras para kg (1 libra = 0.453592 kg)
                peso *= 0.453592;
            }

            repeticaoMaxima = peso * (1 + (repeticoes / 30));

            // Exibir o resultado na página
            let resultado = document.getElementById('resultado-rm');
            resultado.innerHTML = `Sua Repetição Máxima estimada é: ${repeticaoMaxima.toFixed(2)} ${unidade}`;
        }
    </script>
</body>

</html>
