$(document).ready(function () {
  $(".carousel").slick({
    centerMode: true,
    centerPadding: "60px",
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 1700,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: "40px",
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 1348,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: "40px",
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: "40px",
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 700,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
    ],
  });
});

$(".banner").slick({
  slidesToShow: 1 /*quantos quer visualizar*/,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000 /*velocidade*/,
});

$(".fitfusion").slick({
  slidesToShow: 1 /*quantos quer visualizar*/,
  slidesToScroll: 1,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 2000 /*velocidade*/,
});

/* WOW */
new WOW().init();

document.addEventListener("DOMContentLoaded", function () {
  var imageContainers = document.querySelectorAll(".blog section > div");

  imageContainers.forEach(function (container) {
    container.addEventListener("mouseover", function () {
      var overlay = this.querySelector(".blog section div div");
      overlay.style.display = "block";
    });

    container.addEventListener("mouseout", function () {
      var overlay = this.querySelector(".blog section div div");
      overlay.style.display = "none";
    });
  });
});

/* MENU MOBILE */
const menuCheckbox = document.getElementById("menuCheckbox");
const navegacao = document.querySelector(".navegacao");
const main = document.getElementsByTagName("main")[0];
const menu = document.querySelector(".menu");

document.getElementById("menu").addEventListener("click", function () {
  menuCheckbox.checked = !menuCheckbox.checked; // Alterna o estado da caixa de seleção
  if (menuCheckbox.checked) {
    main.style.padding = "148px 0 40px 0";
    menu.style.position = "fixed";
    navegacao.style.right = "0"; // Move a navegação para a direita
  } else {
    main.style.padding = "0"; // Reverte o padding ao valor original
    menu.style.position = "relative"; // Reverte a posição ao valor original
    navegacao.style.right = "-600px"; // Move a navegação de volta para fora da tela
  }
});
/* MENU FIXO */
window.onscroll = function () {
  let top = document.documentElement.scrollTop;

  if (top > 700) {
    document.getElementById("menu-fixo").classList.add("menuFixo");
  } else {
    document.getElementById("menu-fixo").classList.remove("menuFixo");
  }
};


