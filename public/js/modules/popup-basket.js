document.addEventListener('DOMContentLoaded', function () {
  let openPopupButtons = document.querySelectorAll('.open-popup__button');
  let popup = document.querySelector('.popup-basket');
  let closePopupButton = document.querySelector('.popup-basket__close');
  let continuePopupButton = document.querySelector('.popup-basket__continue');

  //события клика на кнопки "добавить в корзину"
  openPopupButtons.forEach(function (item) {
    item.addEventListener('click', function (event) {
      event.preventDefault();
      popup.classList.add('popup-basket--open')
    });
  });

  //событие закрытия модального окна
  function closePopup() {
	  popup.classList.remove('popup-basket--open')
  };

  closePopupButton.addEventListener('click', closePopup);

  continuePopupButton.addEventListener('click', closePopup);
});