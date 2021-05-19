<link rel="stylesheet" href="/css/libs/tagify.css">

<section class="admin-add">
	<div class="wrap admin-contents__wrap wrap--admin">
		<h1 class="admin-add__title">Изменение товара</h1>
		<form class="admin-add__form">

			<div class="admin-add__feature">
				<label for="name" class="admin-add__feature-label">Наименование товара:</label>
				<input class="admin-add__feature-input Check" type="text" id="name" name="name">
				<small class="admin-add__feature-feedback"></small>
			</div>

			<div class="admin-add__feature">
				<label for="cost" class="admin-add__feature-label">Цена:</label>
				<input class="admin-add__feature-input Check" type="text" id="cost" name="cost">
				<small class="admin-add__feature-feedback"></small>
			</div>

			<div class="admin-add__feature">
				<label for="count" class="admin-add__feature-label">Количество:</label>
				<input class="admin-add__feature-input Check" type="text" id="count" name="count">
				<small class="admin-add__feature-feedback"></small>
			</div>

			<div class="admin-add__feature">
				<label for="tag" class="admin-add__feature-label">Теги:</label>
				<input class="admin-add__feature-input Check" type="text" id="tag" name="tag" >
			</div>

			<div class="admin-add__feature">
				<label for="cat" class="admin-add__feature-label">Категория:</label>
				<input class="admin-add__feature-input Check" type="text" id="cat" name="cat">
			</div>

			<div class="admin-add__feature">
				<label for="cinfo" class="admin-add__feature-label">Краткое описание:</label>
				<textarea class="admin-add__feature-input Check" type="text" id="cinfo" name="cinfo"></textarea>
				<small class="admin-add__feature-feedback"></small>
			</div>

			<div class="admin-add__feature">
				<label for="info" class="admin-add__feature-label">Полное описание</label>
				<textarea class="admin-add__feature-input Check" type="text" id="info" name="info"></textarea>
			</div>

			<div class="admin-add__feature admin-add__feature-images">
				<label for="images" class="admin-add__feature-label">Изображения</label>

				<div class="upload upload">
					<div class="upload__wrap">
						<div class="upload__btn">
							<input class="upload__input " type="file" name="upload[]" multiple="multiple" data-max-count="4" ="" accept="image/*"/>
						</div>
					</div>
					<div class="upload__mess">
						<p class="count_img hidden_ms">Максимальное число фотографий:<strong class="count_img_var">8</strong></p>
						<p class="size_img hidden_ms">Максимальный размер фотографии:<strong class="size_img_var">5 Mb</strong></p>
						<p class="file_types hidden_ms">Разрешенные типы файлов:<strong class="file_types_var">jpg, png</strong></p>
					</div>
				</div>
			</div>
			<button class="button admin-add__form-button" name="button_add" id="admin-update" disabled>Изменить товар</button>
		</form>
	</div>
</section>
<div class="popup-admin">
	<div class="overflow">
		<div class="box">
			<button class="popup-admin__close">
				<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 1280 1280"><path d="M1000 145l-6 1-10 2-4 1-5 1-5 1a71 71 0 00-14 7l-3 1-4 2-1 1-1 1-9 6-8 6-290 300-3 3-147-142-153-148-17-13-6-3-18-8h-4l-3-1-5-2-5-1a126 126 0 00-40 1l-4 1-8 3-7 2a195 195 0 00-25 14 289 289 0 00-30 31l-3 4-2 4-1 3-1 1-10 28c-2 10-2 28 1 43a101 101 0 0011 31l2 5 4 5c0 3 30 33 161 159l151 147-142 148a4900 4900 0 00-160 170 104 104 0 00-17 54c0 13 2 28 5 36l3 10a125 125 0 0015 27 413 413 0 0037 33l4 2 5 2c8 3 15 6 25 8 7 1 24 2 34 1a125 125 0 0045-16l5-3c4-1 26-24 159-161l147-152a42599 42599 0 01309 297c5 4 6 5 18 11a107 107 0 0029 9c12 3 38 2 50-2a153 153 0 0031-14 133 133 0 0037-38l8-16 2-8 3-7v-3l2-7v-36a83 83 0 00-7-25l-2-3-1-4-3-4-2-5-10-13-3-3-151-147-151-146a22596 22596 0 01293-305l3-4 5-7 7-14 2-4 3-6 6-32a112 112 0 00-20-69l-35-34a103 103 0 00-33-13l-5-1c-2-2-27-3-28-3z"/></svg>
			</button>
			<div class="popup-admin__title">
				<p class="popup-basket__title-text"></p>
			</div>
			<a href="/admin/main/catalog" class="popup-admin__order button">Перейти в каталог товаров</a>
		</div>
	</div>
</div>
<script src="../../js/libs/jquery.js"></script>
<script defer src='../../js/libs/tagify.min.js'></script>
<script defer src='../../js/admin/admin-product-form.js'></script>
<script src='../../js/admin/admin-edit.js'></script>
<script src='../../js/admin/admin-images.js'></script>
