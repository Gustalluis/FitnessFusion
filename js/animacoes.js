$(".comentarios > div").slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 5,
  slidesToScroll: 2,
  autoplay: true,
  autoplaySpeed: 1000,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

$(".bannerEvento").slick({
  slidesToShow: 1 /*quantos quer visualizar*/,
  slidesToScroll: 1,
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
