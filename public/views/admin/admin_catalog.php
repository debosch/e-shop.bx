<section class="admin-catalog">
	<div class="wrap admin-contents__wrap wrap--admin">
		<h1 class="admin-catalog__title">Каталог товаров</h1>
		<div class="admin-catalog__actions">
			<a href="/admin/main/add" class="button admin-catalog__add-product">Добавить товар</a>
		</div>

		<div class="admin-catalog__categories">
			<h2 class="admin-catalog__title">Категории:</h2>
			<ul class="admin-catalog__categories-list">
				<li class="admin-catalog__categories-item">
					<button class="button admin-catalog__categories-button">Processor</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">Motherboard</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">GPU</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">RAM</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">Hard_Drive</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">ssd</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">power_block</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">case</button>
				</li>
				<li class="admin-catalog__categories-item">
					<button class="button button--white admin-catalog__categories-button">coolers</button>
				</li>
			</ul>
		</div>

		<table class="admin-catalog__table">
			<thead>
				<tr>
					<th>№ товара</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Нажать для редактирование</th>
				</tr>
			</thead>
			<tbody>
				<template id="template">
					<tr class="admin-catalog__table-inner">
						<td class="admin-catalog__product-id">id</td>
						<td class="admin-catalog__product-name">name</td>
						<td class="admin-catalog__product-cost">cost</td>
						<td class="admin-catalog__product-amount">amount</td>
						<td class="admin-catalog__product-edit">
							<a class="admin-catalog__product-link" data-index>Редактировать</a>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</section>
<script src="../../js/admin/admin-catalog.js"></script>
