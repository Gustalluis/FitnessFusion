$('.boxcomentarios').slick({
  slidesToShow: 4, /*quantos quer visualizar*/
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000, /*velocidade*/ 
});

$('.bannerEvento').slick({
  dots: true,
  slidesToShow: 1, /*quantos quer visualizar*/
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000, /*velocidade*/ 
});

/* WOW */ 
new WOW().init();