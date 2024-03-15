$('.boxcomentarios').slick({
  slidesToShow: 4, /*quantos quer visualizar*/
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000, /*velocidade*/ 
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