var swiperAside = new Swiper('.swiper-aside__container', {
  direction: 'vertical',
  slidesPerView: 'auto',
  freeMode: true,
  scrollbar: {
    el: '.swiper-scrollbar',
  },
  mousewheel: true,
  on: {
    scroll: function (_, evt) {
      evt.preventDefault();
    },
  }
});

var swiperNewProducts = new Swiper('.swiper-novelty__container', {
  slidesPerView: 3,
  spaceBetween: 30,
  autoplay: {
    delay: 2500,
    disableOnInteraction: true,
  },
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
