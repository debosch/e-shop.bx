<header class="admin-header">
	<div class="wrap wrap--admin">
		<div class="admin-header__menu">
			<a class="admin-header__menu-logo">
				<img src="/images/logo-icon.svg" alt="Логотип">
			</a>
			<nav class="admin-header__menu-navigation menu-navigation">
				<ul class="menu-navigation__list">
					<li class="menu-navigation__item">
						<a href="/admin/main/catalog" class="menu-navigation__link">Каталог товаров</a>
					</li>
					<li class="menu-navigation__item">
						<a href="/admin/main/order" class="menu-navigation__link menu-navigation__link-notification">Заказы<span id="orders-amount" class="orders-amount orders-amount--disabled"></span></a>
					</li>
				</ul>
			</nav>
			<div class="admin-header__menu-login">
				<a href="/admin/main/register" class="admin-header__menu-registration">Регистрация администратора</a>
				<a href="/admin/logout/action" class="admin-header__menu-logout">Выйти из профиля</a>
			</div>
		</div>
	</div>
</header>
<script src="../../js/admin_notification.js"></script>