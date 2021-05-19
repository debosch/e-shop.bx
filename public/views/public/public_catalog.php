<section class="products  wrap">
	<h1 class="products__title"></h1>
	<div class="products__tags-block tags-block">
		<ul class="tags-block__list">
			<template class="template-tag-filter">
				<li class="tags-block__item">
					<a href="#" class="tags-block__link button button--white"></a>
				</li>
			</template>
		</ul>
	</div>
	<ul class="products__sort">
		<li class="filter-btn">
			<button class="products__filter-button">Фильтр</button>
		</li>
		<li class="products__sort-item">
			<a href="" class="products__sort-link" data-name="alph" data-sort="0">По наименованию</a>
		</li>
		<li class="products__sort-item">
			<a href="" class="products__sort-link" data-name="cost"  data-sort="0">По цене</a>
		</li>
		<li class="products__sort-item">
			<a href="" class="products__sort-link" data-name="count" data-sort="0">По количеству</a>
		</li>
	</ul>
	<div class="products__content">
		<div class="filter">
			<h3 class="filter__title">Подбор параметров</h3>
			<form class="filter__form">
				<div class="filter__form-item form-item">
					<p class="form-item__title">Розничная цена</p>
					<div class="form-item__param-container">
						<div class="form-item__price-container form-item__price-container--max">
							<input type="text" class="form-item__min-price">
						</div>
						<div class="form-item__price-container">
							<input type="text" class="form-item__max-price">
						</div>
						<div class="form-item__slider">
							<div id="slider" class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr"></div>
						</div>
					</div>
				</div>
				<div class="filter__form-item form-item">
					<button class="form-item__submit button">Показать</button>
				</div>
			</form>
		</div>
		<ul class="products__list">
			<template class="template-card" id="template">
				<div class="products__item js-item" data-id="">
					<div class="product-card js-card">
						<div class="product-card__img-wrap">
							<img src="" alt="product" class="js-img">
						</div>
						<button class="product-card__link js-name"></button>
						<p class="product-card__cost js-cost"></p>
						<button class="product-card__basket button open-popup__button">В корзину</button>
                        <p class="basket__item-info-unavailable">Нет в наличии</p>
					</div>
				</div>
			</template>
		</ul>
		<div class="products__pagination">
			<ul class="products__pagination-list">
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1"></button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1"></button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1">1</button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1">2</button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1">3</button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1"></button>
				</li>
				<li class="products__pagination-item button button--white">
					<button class="products__pagination-link js-pagination__link" data-page="1"></button>
				</li>
			</ul>
		</div>
	</div>
	<div class="product">
		<div class="overflow">
			<div class="box">
				<button class="button--close product__close"></button>
				<div class="product__brief">
					<div class="product__slider gallery-slider">
						<div class="swiper-container gallery-top gallery-slider__container gallery-slider__top-container">
							<div class="swiper-wrapper gallery-slider__wrapper">
								<template class="template-gallery-slider-image">
									<div class="swiper-slide gallery-slider__slide">
										<div class="gallery-slider__img-container">
											<img src="" alt="product-1" class="gallery-slider__img" >
										</div>
									</div>
								</template>
							</div>
							<!-- Add Arrows -->
							<div class="swiper-button-next swiper-button-white swiper-gallery__button-next"></div>
							<div class="swiper-button-prev swiper-button-white swiper-gallery__button-prev"></div>
						</div>
						<div class="swiper-container gallery-thumbs">
							<div class="swiper-wrapper gallery-slider__wrapper">
								<template class="template-gallery-thumbs-image">
									<div class="swiper-slide gallery-slider__slide">
										<div class="gallery-slider__img-container">
											<img src="" class="gallery-slider__img" alt="">
										</div>
									</div>
								</template>
							</div>
						</div>
					</div>
					<div class="product__aside">
						<div class="product__aside-wrap">
							<p class="product__name">Процессор LGA1200 Intel Core i9-10900KF</p>
							<p class="product__price">7 530 руб</p>
							<p class="product__short-description">Настольный процессор 10 поколения, созданный на архитектуре Comet Lake, INTEL Core i3 10100 </p>
						</div>
						<div class="product__tags">
							<p class="product__tags-title">Подборки товаров в категории </p>
							<ul class="product__tags-list">
								<template class="template-tag">
									<li class="product__tag-item">
										<a href="" class="product__tag-link button"></a>
									</li>
								</template>
							</ul>
						</div>
					</div>
				</div>
				<div class="product__description">
					<p class="product__description-title">Описание Процессор LGA1200 Intel Core i9-10900KF</p>
					<p class="product__long-description">4-ядерный процессор Intel Core i3-10100F OEM – представитель 10-го поколения процессоров Intel, произведенный с использованием архитектуры Comet Lake. Устройство отлично подходит для комплектации системных блоков, рассчитанных на решение рабочих задач. Производительность процессора достаточна для обеспечения комфортных условий работы с абсолютным большинством распространенных в настоящее время программ. Модель использует сокет LGA 1200.
						Процессор Intel Core i3-10100F OEM характеризуется базовой частотой 3600 МГц. В турборежиме частота может достигать 4300 МГц. Интегрированное графическое ядро отсутствует: вам потребуется дискретный видеоадаптер. Совместимая память – DDR4. Максимальный объем памяти равен 128 ГБ. Кулер в комплектацию процессора не входит. При выборе устройства охлаждения нужно ориентироваться на показатель TDP устройства, равный 65 Вт.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="../../js/catalog/pagination.js"></script>
<script src="../../js/libs/nouislider.js"></script>
<script src="../../js/catalog/products-filter-sort.js"></script>
<script defer src="../../js/catalog/catalog_load.js"></script>


