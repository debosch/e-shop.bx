<section class="admin-catalog">
	<div class="wrap admin-contents__wrap wrap--admin">

		<h1 class="admin-catalog__title">Заказы</h1>

		<div class="admin-catalog__actions">
			<button class="button admin-order__button" data-status="new">Текущие заказы</button>
			<button class="button button--white admin-order__button" data-status="processed">Обработанные заказы</button>
			<button class="button button--white admin-order__button" data-status="completed">Выполненные заказы</button>
		</div>

		<ul class="admin-order__list">
			<template id="template-order">
				<li class="admin-order__item" data-id>
					<div class="admin-order__item-content">
						<ul class="admin-order__user-list">
							<li class="admin-order__user-item">
								<p class="admin-order__title">Ф. И. О.: </p>
								<p class="admin-order__name"></p>
							</li>
							<li class="admin-order__user-item">
								<p class="admin-order__title">Телефон: </p>
								<p class="admin-order__phone"></p>
							</li>
							<li class="admin-order__user-item">
								<p class="admin-order__title">Почта: </p>
								<p class="admin-order__email"></p>
							</li>
							<li class="admin-order__user-item">
								<p class="admin-order__title">Дата добавления: </p>
								<p class="admin-order__date"></p>
							</li>
							<li class="admin-order__user-item">
								<p class="admin-order__title">Взято в обработку: </p>
								<p class="admin-order__date-modify"></p>
							</li>
						</ul>
						<table class="admin-catalog__table admin-order__table">
							<thead>
							<tr>
								<th>Название</th>
								<th>Сумма</th>
							</tr>
							</thead>
							<tbody>
							<template id="template-products">
								<tr>
									<td class="admin-catalog__product-name">name</td>
									<td class="admin-catalog__product-cost">cost</td>
									</td>
								</tr>
							</template>
							</tbody>
						</table>
					</div>

					<button class="button button--white admin-order__submit" data-id>Submit</button>
				</li>
			</template>
		</ul>
	</div>
</section>
<script src="../../js/admin/admin-orders.js"></script>
