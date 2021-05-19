<section class="basket wrap">
	<h1 class="basket__title">Моя корзина</h1>
	<div class="basket__content">
		<div class="basket__main">
			<div class="basket__header">
				<div class="basket__search-field visually-hidden">
					<input type="text" class="basket__search-field-input">
					<button class="button--close basket__search-field-clear"></button>
				</div>
				<p class="basket__header-count-text"></p>
				<button class="basket__header__clear button button--white">Очистить корзину</button>
			</div>
			<table class="basket__item-list">
				<tbody>
				<template class="basket__item" id="template">
					<td class="basket__item-description">
						<div class="basket__item-description-inner">
							<div class="basket__item-image">
								<a href="product.html" class="basket__item-image-link">
									<img src="" alt="product">
								</a>
							</div>
							<div class="basket__item-info">
								<h2 class="basket__item-info-name">
									<a href="/public/catalog/product" class="basket__item-info-name-link">
										<span></span>
									</a>
								</h2>
                                <p class="basket__item-info-amount"><span></span> на складе</p>
                                <p class="basket__item-info-unavailable">Извините, товара нет в таком количестве</p>
							</div>
						</div>
					</td>
					<td class="basket__item-price-for-one">
						<div class="basket__item-price">
							<div class="basket__item-price__current">
								<span class="basket__item-price__current-text" data-id=""></span>
							</div>
							<p class="basket__item-price-title">цена за 1 шт</p>
						</div>
					</td>
					<td class="basket__item-amount">
						<div class="basket__item-amount-wrap">
							<button class="button--minus basket__item-amount-minus" data-id="1"></button>
							<input type="text" value="1" class="basket__item-amount-quantity" data-id="1">

							<button class="button--plus basket__item-amount-plus" data-id="1"></button>
						</div>
					</td>
					<td class="basket__item-total">
						<p class="basket__item-total-text" id="totalforone" data-id="1"></p>
					</td>
					<td class="basket__item-remove">
						<button class="button--close basket__item-remove-button"></button>
					</td>
				</template>
				</tbody>
			</table>
		</div>
		<div class="basket__aside">
			<div class="basket__aside-checkout">
				<p class="basket__aside-total">Итого:</p>
				<p class="basket__aside-price">0</p>
			</div>
			<div class="basket__user">
				<div class="basket__user-header popup-order__header">
					<span class="basket__user-title">Данные покупателя</span>
				</div>
				<form class="basket__user-content">
					<div class="basket__user-form-group">
						<label for="order__name" class="basket__user-label">Ф.И.О.<span class="basket__user-star-required">*</span></label>
						<input required id="order__name" name="order__name" type="text" class="basket__user-input form-control border">
						<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
					</div>
					<div class="basket__user-form-group">
						<label for="order__email" class="basket__user-label">E-Mail<span class="basket__user-star-required">*</span></label>
						<input required id="order__email" name="order__email" type="email" class="basket__user-input form-control border">
						<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
					</div>
					<div class="basket__user-form-group">
						<label for="order__phone" class="basket__user-label">Телефон<span class="basket__user-star-required">*</span></label>
						<input required id="order__phone" name="order__phone" type="tel" class="basket__user-input form-control border" placeholder="+7(___)-___-__-__">
						<small class="form-text text-danger feedback admin-add__feature-feedback"></small>
					</div>
					<div class="popup-order__footer">
						<button type="submit" id="button__submit" class="popup-order__submit button js-popup-order__submit" disabled>Оформить заказ</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<div class="popup-response js-popup-response">
	<div class="overflow">
		<div class="box">
			<button class="button--close popup-response__close js-popup-response__close"></button>
			<div class="popup-response__title">
				<p>Заказ успешно оформлен</p>
			</div>
		</div>
	</div>
</div>
<script defer src="../../js/basket/basket-loading.js"></script>
<script defer src="../../js/order.js"></script>
<script defer src="../../js/order_validate.js"></script>