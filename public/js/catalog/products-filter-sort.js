//объект состояния фильтра
let filterState = Object.create(
	{
		getTagsString()
		{
			let getTagsString = '';
			this.tags.forEach(tag => {
				getTagsString += '&tag=' + tag;
			});
			return getTagsString + '&cmax='+ this.maxPrice + '&cmin=' + this.minPrice;
		}
	},
	{
		minPrice: {
			value: 0,
			enumerable: true,
			writable: true
		},
		maxPrice: {
			value: 0,
			enumerable: true,
			writable: true
		},
		tags: {
			value: [],
			enumerable: true,
			writable: true
		}
	});

let sortState = Object.create(
	{
		getSortString()
		{
			return '&sort=' + this.name + '&revert=' + this.direction;
		}
	},
	{
		name: {
			value: '',
			enumerable: true,
			writable: true
		},
		direction: {
			value: '',
			enumerable: true,
			writable: true
		}
	});

//настройка слайдера с ценой
let priceSlider = document.getElementById('slider');
noUiSlider.create(priceSlider, {
	start: [0, 100000],
	connect: true,
	range: {
		'min': 0,
		'max': 100000
	}
});

//inputs
let minPrice = document.querySelector('.form-item__min-price');
let maxPrice = document.querySelector('.form-item__max-price');

let priceInputs = [minPrice, maxPrice];

priceSlider.noUiSlider.on('update', function(values, handle) {
	priceInputs[handle].value =  Math.round(values[handle]);

	let value = values[handle];

	if (handle)
	{
		filterState.maxPrice = Math.round(value);
	}
	else
	{
		filterState.minPrice = Math.round(value);
	}
});

priceInputs.forEach(function(input, handle) {
	input.addEventListener('change', function() {
		priceSlider.noUiSlider.setHandle(handle, this.value);
	});
});

let openFilterButton = document.querySelector('.products__filter-button');
let priceFilter = document.querySelector('.filter');

openFilterButton.addEventListener('click', function() {
	this.classList.toggle('products__filter-button--active');
	priceFilter.classList.toggle('filter--open');
});

let getTagsUrl = '/catalog/getTags';

//получение тегов с бд, отрисовка
fetch(getTagsUrl).then(function(response) {
	return response.json();
}).then(function(json) {
	renderTags(json);
	tagsFilter();
}).catch(function(err) {
	console.log(err);
});

let renderTags = function(tags) {
	let templateTags = document.querySelector('.template-tag-filter');
	tags.forEach(tag => {
		let cloneTags = templateTags.content.cloneNode(true);
		let tagLink = cloneTags.querySelector('.tags-block__link');
		tagLink.textContent = tag.NAME;
		tagLink.setAttribute('value', tag.NAME);
		templateTags.parentNode.appendChild(cloneTags);
	});
};

let tagsFilter = function() {
	const tags = document.querySelectorAll('.tags-block__link');
	tags.forEach(tag => {
		tag.addEventListener('click', () => {
			//изменение стиля кнопки
			tag.classList.toggle('button--white');

			//если нет в фильтре такого тега, то добавить тег
			if ((filterState.tags.indexOf(tag.textContent) === -1) || (filterState.tags.length === 0))
			{
				filterState.tags.push(tag.textContent);
			}
			//если есть в фильтре такой тег, то удалит
			else
			{
				let removedTag = filterState.tags.indexOf(tag.textContent);
				filterState.tags.splice(removedTag, 1);
			}
			loadCatalog(filterState.getTagsString(), sortState.getSortString());
		});
	});
};

let sorts = document.querySelectorAll(".products__sort-link");

sorts.forEach(function(link) {
	link.addEventListener('click', function(e) {
		e.preventDefault();

		sorts.forEach(link => {
			link.classList.remove('active');
			link.dataset.sort = 'increase';
		});

		link.classList.add('active');

		if ((link.classList.contains('products__sort-link--decrease')))
		{
			link.classList.remove('products__sort-link--decrease');
			link.classList.add('products__sort-link--increase');
			link.dataset.sort = 'increase';
		}
		else
		{
			link.classList.remove('products__sort-link--increase');
			link.classList.add('products__sort-link--decrease');
			link.dataset.sort = 'decrease';
		}
		if (!(link.classList.contains('products__sort-link--increase')) && !(link.classList.contains('products__sort-link--decrease')))
		{
			link.classList.add('products__sort-link--increase');
		}

		sorts.forEach(link => {
			if (!(link.classList.contains('active')))
			{
				link.classList.remove('products__sort-link--decrease');
				link.classList.remove('products__sort-link--increase');
			}
		});

		sortState.name = link.dataset.name;
		sortState.direction = link.dataset.sort;
		loadCatalog(filterState.getTagsString(), sortState.getSortString());
	});
});

const priceSubmit = document.querySelector('.form-item__submit');

priceSubmit.addEventListener('click', (e) => {
	e.preventDefault();
	priceFilter.classList.remove('filter--open');
	loadCatalog(filterState.getTagsString(), sortState.getSortString());
});