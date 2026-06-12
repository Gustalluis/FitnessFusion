// Definição do objeto Utils para gerar os meses
const Utils = {
  meses: function (opcoes) {
    const meses = [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ];
    return meses.slice(0, opcoes.quantidade);
  },
};

// Definir as variáveis de labels e data para o primeiro gráfico
const rotulos = Utils.meses({ quantidade: 12 });
const data = {
  labels: rotulos,
  datasets: [
    {
      label: "Matrículas novas",
      data: [10, 13, 9, 8, 12, 15, 7, 8, 11, 12, 15, 10],
      fill: false,
      borderColor: "rgb(75, 192, 192)",
      tension: 0.4,
    },
    {
      label: "Matrículas canceladas",
      data: [9, 10, 12, 11, 9, 14, 6, 9, 10, 11, 13, 8],
      fill: false,
      borderColor: "rgb(255, 99, 132)",
      tension: 0.4,
    },
    {
      label: "Total de Matrículas",
      data: [18, 23, 21, 19, 21, 29, 23, 17, 21, 23, 28, 18],
      fill: false,
      borderColor: "rgb(54, 162, 235)",
      tension: 0.4,
    },
  ],
};

// Definir a configuração do primeiro gráfico
const config = {
  type: "line",
  data: data,
};

// Definir as variáveis de labels e dados para o segundo gráfico
const Utils1 = {
  horas: function (opcoes) {
    const horasDoDia = [
      "06:00",
      "07:00",
      "08:00",
      "09:00",
      "10:00",
      "11:00",
      "12:00",
      "13:00",
      "14:00",
      "15:00",
      "16:00",
      "17:00",
      "18:00",
      "19:00",
      "20:00",
      "21:00",
      "22:00",
    ];
    return horasDoDia.slice(0, opcoes.quantidade);
  },
};

// Definir as variáveis de labels e dados para o segundo gráfico
const rotulos1 = Utils1.horas({ quantidade: 17 }); // 17 horas de 06:00 a 22:00
const data1 = {
  labels: rotulos1,
  datasets: [
    {
      label: "Frequência de Alunos com base no Horário",
      data: [
        30, 59, 80, 81, 56, 55, 40, 75, 63, 70, 88, 92, 58, 150, 77, 66, 54,
      ],
      backgroundColor: [
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)",
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)",
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
      ],
      borderColor: [
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
      ],
      borderWidth: 1,
    },
  ],
};

// Definir a configuração do segundo gráfico
const config1 = {
  type: "bar",
  data: data1,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
};

// Esperar até que o DOM esteja completamente carregado
document.addEventListener("DOMContentLoaded", function () {
  // 🔒 Só executa se o elemento #config existir (na página de login ele NÃO existe!)
  const configBtn = document.getElementById("config");
  if (configBtn) {
    configBtn.addEventListener("click", function () {
      var configMenu = document.querySelector(".config");
      if (configMenu) {
        if (configMenu.classList.contains("show")) {
          configMenu.classList.remove("show");
          setTimeout(function () {
            configMenu.style.display = "none";
          }, 300);
        } else {
          configMenu.style.display = "block";
          setTimeout(function () {
            configMenu.classList.add("show");
          }, 10);
        }
      }
    });
  }

  // 🔒 Só cria gráficos se os elementos canvas existirem
  const grafico1 = document.getElementById("grafico1");
  const grafico2 = document.getElementById("grafico2");
  if (grafico1) {
    new Chart(grafico1.getContext("2d"), config);
  }
  if (grafico2) {
    new Chart(grafico2.getContext("2d"), config1);
  }

  // 🔒 Só alterna formulários se os botões existirem (apenas na página de login)
  const signUpButton = document.getElementById("signUp");
  const signInButton = document.getElementById("signIn");
  if (signUpButton && signInButton) {
    toggleSignInSignUp();
  }

  // 🔒 Só adiciona evento de filtro se o botão existir
  const filterButton = document.getElementById("filterButton");
  const filterMenu = document.getElementById("filterMenu");
  if (filterButton && filterMenu) {
    filterButton.addEventListener("click", function () {
      filterMenu.classList.toggle("hidden");
    });
  }
});

// Função para alternar entre formulários de login e cadastro
function toggleSignInSignUp() {
  const signUpButton = document.getElementById("signUp");
  const signInButton = document.getElementById("signIn");
  const container = document.getElementById("container");

  signUpButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
  });

  signInButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
  });
}

// Função para login de aluno
function loginAluno() {
  $("#formLoginAluno").on("submit", function (event) {
    event.preventDefault();

    const formdata = $(this).serialize();

    $.ajax({
      url: "dashboard/class/ClassCliente.php",
      method: "POST",
      data: formdata,
      dataType: "json",
      success: function (data) {
        if (data.success) {
          $("#msgLogin").html(`<div class='msgLogin'>Login bem-sucedido!</div>`);
          window.location.href = "Aluno/index.php?p=dashboard";
        } else {
          $("#msgInvalido").html(
            `<div class='msgInvalido'>${data.message || "E-mail ou senha inválidos!"}</div>`
          );
          // Limpar a mensagem após 3 segundos
          setTimeout(() => { $("#msgInvalido").html(""); }, 3000);
        }
      },
      error: function (xhr, status, error) {
        console.log("Erro AJAX:", error);
        console.log("Resposta:", xhr.responseText);
        $("#msgInvalido").html(
          `<div class='msgInvalido'>Erro de conexão. Verifique o console (F12).</div>`
        );
      },
    });
  });
}

// Inicializar a função de login de aluno
loginAluno();

// Função para login de funcionário
function loginFuncionario() {
  $("#formLoginFuncionario").on("submit", function (event) {
    event.preventDefault();

    const formdata = $(this).serialize();

    $.ajax({
      url: "dashboard/class/ClassFuncionario.php",
      method: "POST",
      data: formdata,
      dataType: "json",
      success: function (data) {
        if (data.success) {
          $("#msgLogin").html(`<div class='msgLogin'>Login bem-sucedido!</div>`);
          window.location.href = "dashboard/index.php?p=dashboard";
        } else {
          $("#msgInvalido").html(
            `<div class='msgInvalido'>${data.message || "E-mail ou senha inválidos!"}</div>`
          );
          // Limpar a mensagem após 3 segundos
          setTimeout(() => { $("#msgInvalido").html(""); }, 3000);
        }
      },
      error: function (xhr, status, error) {
        console.log("Erro AJAX:", error);
        console.log("Resposta:", xhr.responseText);
        $("#msgInvalido").html(
          `<div class='msgInvalido'>Erro de conexão. Verifique o console (F12).</div>`
        );
      },
    });
  });
}

// Inicializar a função de login de funcionário
loginFuncionario();

// Função de pesquisa de cliente
function searchClient() {
  const input = document.getElementById("searchInput").value;
  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `searchClient.php?nomeCliente=${encodeURIComponent(input)}`,
    true
  );
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("searchResults").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

// 🔒 Barra de pesquisa - só executa se #searchInput existir
const searchInput = document.getElementById("searchInput");
if (searchInput) {
searchInput.addEventListener("input", function () {
  const query = this.value;

  if (query.length > 0) {
    fetch("../dashboard/buscar_clientes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ query: query }),
    })
      .then((response) => response.json())
      .then((data) => {
        const suggestionsContainer = document.getElementById("suggestions");
        suggestionsContainer.innerHTML = "";
        if (data.length > 0) {
          data.forEach((cliente) => {
            const div = document.createElement("div");
            div.textContent = cliente.nomeCliente;
            div.addEventListener("click", () => {
              window.location.href = `index.php?p=aluno&c=atualizar&id=${cliente.idCliente}`;
            });
            suggestionsContainer.appendChild(div);
          });
        }
      });
  } else {
    const suggestionsContainer = document.getElementById("suggestions");
    if (suggestionsContainer) {
      suggestionsContainer.innerHTML = "";
    }
  }
});
} // Fim do if (searchInput)

// Clique no elemento de imagem para selecionar uma nova foto
document.addEventListener("DOMContentLoaded", function () {
  const img = document.getElementById("img");
  const fotoInput = document.getElementById("foto");

  if (img && fotoInput) {
    img.addEventListener("click", () => {
      fotoInput.click();
    });

    fotoInput.addEventListener("change", function (event) {
      const arquivo = event.target.files[0];
      if (arquivo) {
        const carregar = new FileReader();
        carregar.onload = function (e) {
          img.src = e.target.result;
        };
        carregar.readAsDataURL(arquivo);
      }
    });
  } else {
    console.warn('Elementos "img" ou "foto" não encontrados.');
  }

  // Formata o campo de CPF enquanto o usuário digita
  const cpfInput = document.getElementById("cpfCliente");
  if (cpfInput) {
    cpfInput.addEventListener("input", function () {
      let cpf = this.value.replace(/\D/g, "");
      if (cpf.length > 0) {
        cpf = cpf.substring(0, 11);
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
      }
      this.value = cpf;
    });
  } else {
    console.warn('Elemento "cpfCliente" não encontrado.');
  }

  // Formata o campo de telefone enquanto o usuário digita
  const telefoneInput = document.getElementById("telefoneCliente");
  if (telefoneInput) {
    telefoneInput.addEventListener("input", function () {
      let telefone = this.value.replace(/\D/g, "");
      if (telefone.length > 0) {
        telefone = telefone.substring(0, 11);
        telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2");
        telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");
      }
      this.value = telefone;
    });
  } else {
    console.warn('Elemento "telefoneCliente" não encontrado.');
  }

  // 🔒 Verifica se as senhas correspondem ao enviar o formulário de cadastro
  const formCadastro = document.getElementById("formCadastro");
  if (formCadastro) {
    formCadastro.addEventListener("submit", function (event) {
      const senha = document.getElementById("senhaCliente").value;
      const confirmaSenha = document.getElementById(
        "confirmaSenhaCliente"
      ).value;

      if (senha !== confirmaSenha) {
        event.preventDefault();
        alert(
          "As senhas não correspondem. Por favor, verifique e tente novamente."
        );
      }
    });
  }
});
//Menu config
