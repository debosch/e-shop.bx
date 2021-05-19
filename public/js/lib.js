function getItemsAmount(id)
{
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        let url = '/main/getTotalAmountOfItems?id=' + id;

        xhr.open('GET', url);
        xhr.onload = () => {
            if (xhr.status >= 400)
            {
                reject(xhr.response);
            }
            else
            {
                resolve(xhr.response);
            }
        };

        xhr.send();
    });
}

function dbUpdateValue(id, value)
{
    db.basketItems.where('id').equals(id).modify(
        { amount: value }
    ).catch(err => alert('Oooops: ' + err));
}

function deleteItem(item)
{
    db.basketItems
        .where('id').anyOf(item.dataset.id.toString())
        .delete().then(function() {
        updateCounters(basketItemsList.childElementCount - 1);
        item.remove();
        updateTotalPrice();
    });
}

function dbUpdateAmount(items)
{
    items.forEach(function(item) {
        getItemsAmount(item.id)
            .then(function(amount) {
                if (item.totalAmount !== amount)
                {
                    db.basketItems.where('id').equals(item.id).modify(
                        { totalAmount: amount }
                    ).catch(err => alert('Oooops: ' + err));
                }
            })
            .catch(err => alert('Oooops: ' + err));
    })
}

function disableAvailabilityText(item)
{
    item.style.display = 'none';
}

function updateCard(id, item)
{
    getItemsAmount(id).then(function(amount)
    {
        let itemAvailability = item.querySelector('.basket__item-info-unavailable');
        itemAvailability.style.display = 'block';
        setTimeout(disableAvailabilityText, 2500, itemAvailability);
        item.querySelector('.basket__item-info-amount').querySelector('span').innerHTML = amount;
    })
}

function initialize(products, basketProducts)
{
    let template = document.querySelector('#template');
    let counter = 0;
	maxPage = products[0].plast;
    products.forEach(function({ ID, NAME, IMAGE = '/images/product-image-none.jpg', AMOUNT, PRICE }) {
        let clone = template.content.cloneNode(true);
        let image = clone.querySelector('.js-img');
        let name = clone.querySelector('.js-name');
        let cost = clone.querySelector('.js-cost');
        let button = clone.querySelector('.open-popup__button');
        let itemUnavailableText = clone.querySelector('.basket__item-info-unavailable');
        itemUnavailableText.style.display = 'none';

        basketProducts.forEach(function(item) {
            if (item.id === ID)
            {
                counter++;
                button.disabled = true;
            }
        });

        if (parseInt(AMOUNT) < 1)
        {
            button.disabled = true;
            itemUnavailableText.style.display = 'block';
        }

		let imagePath = 'data:image/jpeg;base64,' + IMAGE;
        image.setAttribute('src', imagePath);
        image.setAttribute('alt', NAME);
        name.textContent = NAME;
        name.dataset.id = ID;
        cost.textContent = getBeautifulPrice(PRICE);
        template.parentNode.appendChild(clone);
    });
    updateBasketCounter(counter);
}

function initializeCatalog(catalog)
{
    db.basketItems.toArray().then(function(basketItems) {
        initialize(catalog, basketItems);
        updateCatalog();
        let links = document.querySelectorAll('.js-name');

        links.forEach(link => {
            link.addEventListener('click', () => {
                let getProductUrl = '/main/getProduct?id=' + link.dataset.id;

                //получаем даныне о продукте
				sendRequest('GET', getProductUrl)
					.then(function(items)
					{
						renderProduct(JSON.parse(items));
					})
            });
        });
    });
}

function updateCatalog()
{
    let cards = document.querySelectorAll('.product-card');

    cards.forEach(function(card)
    {
        let name = card.querySelector('.js-name').innerHTML;
        let id = card.querySelector('.js-name').dataset.id;
        let img = card.querySelector('.js-img').getAttribute('src');
        let price = card.querySelector('.js-cost').innerHTML;
        let totalAmount;

        getItemsAmount(id).then(function(amount)
        {
            totalAmount = amount;
            card.querySelector('.open-popup__button').addEventListener('click', function()
            {
                this.disabled = true;
                db.basketItems.put(
                    {
                        id: id,
                        amount: 1,
                        totalAmount: totalAmount,
                        name: name,
                        img: img,
                        price: price
                    }
                ).then(function()
                {
                    updateBasketCounter();
                }).catch(err => alert('Oooops: ' + err));
            })
        }).catch(err => alert('Oooops: ' + err));
    })
}

function sendRequest(method, url, responseType = null, body = null)
{
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        xhr.open(method, url, true);

        if (responseType === 'json')
        {
            xhr.responseType = 'json';
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        }

        xhr.onload = () => {
            if (xhr.status >= 400)
            {
                reject(xhr.response);
            }
            else
            {
                resolve(xhr.response);
            }
        };

        xhr.onerror = () => {
            reject(xhr.response);
        };

        if (body !== null)
        {
            xhr.send(JSON.stringify(body));
        }
        else
        {
            xhr.send();
        }
    });
}

function updateBasketCounter()
{
    let basketItemsCounter = document.querySelector('.header-menu__basket-counter');
    db.basketItems.count().then(function(size)
    {
        basketItemsCounter.innerHTML = size;
    })
}

function clearCatalog()
{
    let catalogList = document.querySelector('.products__list');
    while (catalogList.lastChild)
    {
        if (catalogList.childElementCount !== 1)
        {
            catalogList.lastChild.remove();
        }
        else
        {
            break;
        }
    }
}

function redirectToCatalog()
{
    window.location.href = 'http://team-a-2020/catalog/show';
}

function redirectToCatalogButtons()
{
    let buttons = document.querySelectorAll('.js-get');
    buttons.forEach(function(button)
    {
        button.addEventListener('click', function()
        {
            window.localStorage.setItem('category', button.dataset.id);
            window.localStorage.setItem('categoryName', button.querySelector('.nav-list__item__text').innerHTML);
            redirectToCatalog();
        })
    })
}
function getBeautifulPrice(price)
{
	return String(price).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' руб.';
}

function renderProduct({NAME, PRICE, SHORT_DESCRIPTION, LONG_DESCRIPTION, TAG, IMAGE})
{
	let productPopup = document.querySelector('.product');
	let productName = document.querySelector('.product__name');
	let productPrice = document.querySelector('.product__price');
	let productShortDescription = document.querySelector('.product__short-description');
	let productLongDescription = document.querySelector('.product__long-description');
	let productDescriptionTitle = document.querySelector('.product__description-title');
	//удаление тегов с предыдущего товара
	let tagList = document.querySelector('.product__tags-list');
	let oldTags = tagList.querySelectorAll('.product__tag-item');
	oldTags.forEach(oldTag => {
		oldTag.remove();
	})
	//рендер новых тегов
	let templateTags = document.querySelector('.template-tag');
	TAG.forEach(tag => {
		let cloneTags = templateTags.content.cloneNode(true);
		let tagLink = cloneTags.querySelector('.product__tag-link')
		tagLink.textContent = tag.tag;
		templateTags.parentNode.appendChild(cloneTags);
	})

	//удаление картинок с предыдущего товара
	let galleryTopContainer = document.querySelector('.gallery-top');
	let oldGalleryTopSlides = galleryTopContainer.querySelectorAll('.gallery-slider__slide');
	oldGalleryTopSlides.forEach(oldSlides => {
		oldSlides.remove();
	})
	let sliderContainer = document.querySelector('.gallery-thumbs');
	let oldSliderSlides = sliderContainer.querySelectorAll('.gallery-slider__slide');
	oldSliderSlides.forEach(oldSlides => {
		oldSlides.remove();
	})

	//рендер новых картинок
	let templateGallery = document.querySelector('.template-gallery-thumbs-image');
	let templateSlider = document.querySelector('.template-gallery-slider-image');

	IMAGE.forEach(img => {
		let cloneGallery = templateGallery.content.cloneNode(true);
		let GalleryImage = cloneGallery.querySelector('.gallery-slider__img')
		GalleryImage.setAttribute('src', 'data:image/jpeg;base64,' + img);
		GalleryImage.setAttribute('alt', NAME);

		let cloneSlider = templateSlider.content.cloneNode(true);
		let GallerySlider = cloneSlider.querySelector('.gallery-slider__img')
		GallerySlider.setAttribute('src', 'data:image/jpeg;base64,' + img);
		GallerySlider.setAttribute('alt', NAME);

		templateGallery.parentNode.appendChild(cloneGallery);
		templateSlider.parentNode.appendChild(cloneSlider);
	})

	var galleryThumbs = new Swiper('.gallery-thumbs', {
		spaceBetween: 10,
		slidesPerView: 3,
		loop: true,
		freeMode: true,
		loopedSlides: 3,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
	});

	var galleryTop = new Swiper('.gallery-top', {
		spaceBetween: 10,
		loop: true,
		loopedSlides: 3,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		thumbs: {
			swiper: galleryThumbs,
		},
	});
	productDescriptionTitle.textContent = 'Описание ' + NAME;
	productName.textContent = NAME;
	productPrice.textContent = getBeautifulPrice(PRICE);
	productShortDescription.textContent = SHORT_DESCRIPTION;
	productLongDescription.textContent = LONG_DESCRIPTION;

	//открытие описания товара
	productPopup.classList.add('product--open');

	//закрытие описания товара
	let closeProductPopup = document.querySelector('.product__close');
	closeProductPopup.addEventListener('click', function() {
		productPopup.classList.remove('product--open');
	});
}