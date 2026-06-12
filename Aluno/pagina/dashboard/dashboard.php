<section>
    <div class="dadoPrimario">
        <div> <!-- Boas-vindas -->
            <div>
                <img src="../dashboard/img/cliente.png" alt="Icone Aluno">
            </div>
            <div>
                <h2><?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?></h2>
                <h3>Bem-vindo ao seu painel</h3>
            </div>
        </div>
    </div>
</section>
<!-- GRAFICOS -->
<section>
    <div class="grafico">
        <div>
            <canvas id="grafico1"></canvas>
        </div>
        <div>
            <canvas id="grafico2"></canvas>
        </div>
    </div>
</section>