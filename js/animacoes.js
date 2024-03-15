$(document).ready(function(){
  $('.comentario').slick({
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
});

$('.bannerEvento').slick({
  slidesToShow: 1, /*quantos quer visualizar*/
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000, /*velocidade*/ 
});

/* WOW */ 
new WOW().init();


document.addEventListener("DOMContentLoaded", function() {
  var imageContainers = document.querySelectorAll(".blog section > div");

  imageContainers.forEach(function(container) {
      container.addEventListener("mouseover", function() {
          var overlay = this.querySelector(".blog section div div");
          overlay.style.display = "block";
      });

      container.addEventListener("mouseout", function() {
          var overlay = this.querySelector(".blog section div div");
          overlay.style.display = "none";
      });
  });
});