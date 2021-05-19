<head>
	<script src="../../js/libs/Dexie.js"></script>
	<script src="../../js/lib.js"></script>
	<script src="../../js/dexie-connect.js"></script>
</head>
<header class="header">
	<div class="header__menu header-menu wrap">
		<div class="header-menu__logo">
			<a href="/main" class="header-menu__logo-link">
				<img src="/images/logo.png" alt="Логотип" width="56" height="56">
			</a>
		</div>
		<div class="header-menu__buttons">
			<a class="header-menu__basket-link" href="/main/basket">
				<span class="header-menu__basket-counter">0</span>
			</a>
		</div>
	</div>
</header>
<aside class="catalog-menu">
	<div class="catalog-menu__container">
		<nav class="catalog-menu__nav">
			<div class="catalog-menu__nav-head nav-head">
				<button href="" class="nav-head__burger-button">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<div class="nav-head__title">
					<a href="/catalog">Каталог</a>
				</div>
			</div>
			<div class="swiper-container swiper-aside__container">
				<div class="swiper-wrapper swiper-aside__wrapper">
					<ul class="catalog-menu__nav-list nav-list  swiper-slide swiper-aside__slide">
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="processor">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-1.jpg" alt="Процессоры">
                  </span>
								<span class="nav-list__item__text">Процессоры</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="motherboard">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-2.jpg" alt="Материнские платы">
                  </span>
								<span class="nav-list__item__text">Материнские платы</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="ram">
                                  <span class="nav-list__item__img">
                                        <img src="/images/submenu-main-3.jpg" alt="Оперативная память">
                                  </span>
								<span class="nav-list__item__text">Оперативная память</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="gpu">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-4.jpg" alt="Видеокарты" >
                  </span>
								<span class="nav-list__item__text">Видеокарты</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="Hard_Drive">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-5.jpg" alt="Жесткие диски">
                  </span>
								<span class="nav-list__item__text">Жесткие диски</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="ssd">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-6.jpg" alt="SSD-диски">
                  </span>
								<span class="nav-list__item__text">SSD-диски</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="power-block">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-7.jpg" alt="Блоки питания">
                  </span>
								<span class="nav-list__item__text">Блоки питания</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="case">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-8.jpg" alt="Корпуса">
                  </span>
								<span class="nav-list__item__text">Корпуса</span>
							</button>
						</li>
						<li class="nav-list__item">
							<button class="nav-list__item-link js-get" data-id="coolers">
                  <span class="nav-list__item__img">
                    <img src="/images/submenu-main-9.jpg" alt="Кулеры для процессора">
                  </span>
								<span class="nav-list__item__text">Кулеры для процессора</span>
							</button>
						</li>
					</ul>
				</div>
				<div class="swiper-scrollbar swiper-aside__scrollbar"></div>
			</div>
		</nav>
	</div>
</aside>