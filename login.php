<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Equipe GKR">
    <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
    <link rel="icon" href="img/logo/logoFitnessvazio.svg" type="image/svg+xml">
    <title>Login- Academia Fitness Fusion</title>
    <!--############# Links/Referencias ##################-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,800">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" id="formLoginFuncionario">
                <h1>Funcionários</h1>
                <span>Para login como funcionário</span>
                <input type="email" name="email" placeholder="E-mail" required />
                <input type="password" name="password" placeholder="Senha" required />
                <button class="cssbuttons-io-button" type="submit">
                    Entrar
                    <div class="icon">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                        </svg>
                    </div>
                </button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" id="formLoginAluno">
                <h1>Bem-vindo aluno!</h1>
                <span>Para login como aluno</span>
                <input type="email" name="email" placeholder="E-mail" required />
                <input type="password" name="password" placeholder="Senha" required />
                <button class="cssbuttons-io-button" type="submit">
                    Entrar
                    <div class="icon">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                        </svg>
                    </div>
                </button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem-vindo de Volta!</h1>
                    <p>Lembre-se de sempre fazer um bom atendimento</p>
                    <button class="ghost" id="signIn" onclick="toggleSignInSignUp()">acesso para clientes</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá, Aluno!</h1>
                    <p>Insira seus dados pessoais e comece a sua jornada Fusion</p>
                    <button class="ghost" id="signUp" onclick="toggleSignInSignUp()">Acesso para funcionarios</button>
                </div>
            </div>
        </div>

        <!-- DIV PARA EXIBIR MENSAGENS DE ERRO/SUCESSO -->
        <div id="msgLogin"></div>
        <div id="msgInvalido"></div>
    </div>

    <!-- jQuery LOCAL (do XAMPP) + fallback -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
    // Fallback: se jQuery da CDN não carregar, usa a versão local
    window.jQuery || document.write('<script src="js/jquery-3.7.1.min.js"><\/script>');
    </script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="dashboard/js/animaDash.js"></script>

</body>

</html>