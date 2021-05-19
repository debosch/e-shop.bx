const [form] = document.forms;

const [
	nameFeedback,
	costFeedback,
	countFeedback,
	cinfoInfoFeedback
] = document.querySelectorAll('.admin-add__feature-feedback');

const isNameValid = name => {
	return name.length > 2 && name.length <= 100 && /^[A-Za-zА-ЯЁа-яё0-9_ ]*$/g.test(name);
};

const isCostValid = cost => {
	return cost.length > 2 && cost.length <= 20 && /^[0-9]+$/.test(cost);
};

const isCountValid = count => {
	return count.length > 1 && count.length <= 20 && /^[0-9]+$/.test(count);
};

const isCInfoValid = cinfo => {
	return cinfo.length > 1 && cinfo.length <= 200 && /^[A-Za-zА-ЯЁа-яё0-9_ ]*$/g.test(cinfo);
};

const validation = (name, cost, count, cinfo) => {
	return (
		isNameValid(name) &&
		isCostValid(cost) &&
		isCountValid(count) &&
		isCInfoValid(cinfo)
	);
};

const getElement = (name, e) => {
	return {
		name(e)
		{
			e.target.classList.toggle('border-danger', !isNameValid(e.target.value));
			nameFeedback.textContent = isNameValid(e.target.value) ? null : 'Название должно содержать от 3 до 100 символов и содержать только буквы, цифры, подчеркивание и пробелы.';
		},
		cost(e)
		{
			e.target.classList.toggle('border-danger', !isCostValid(e.target.value));
			costFeedback.textContent = isCostValid(e.target.value) ? null : 'Цена должна содержать от 3 до 20 символов и содержать только цифры.';
		},
		count(e)
		{
			e.target.classList.toggle('border-danger', !isCountValid(e.target.value));
			countFeedback.textContent = isCountValid(e.target.value) ? null : 'Количество должно содержать от 2 до 20 символов и содержать только цифры.';
		},
		cinfo(e)
		{
			e.target.classList.toggle('border-danger', !isCInfoValid(e.target.value));
			cinfoInfoFeedback.textContent = isCInfoValid(e.target.value) ? null : 'Краткое описание должно содержать от 3 до 200 символов и содержать только буквы, цифры, подчеркивание и пробелы.';
		}
	}[name](e);
};

const handleInput = e => {
	const { name: formName, cost, count, cinfo, button_add } = form;
	const { name } = e.target;

	getElement(name, e);

	button_add.disabled = !validation(formName.value, cost.value, count.value, cinfo.value);
};

//модальное окно с ответом от сервера
function showResponse(message)
{
	const popupAdmin = document.querySelector('.popup-admin');
	const closePopupButton = document.querySelector('.popup-admin__close');
	if (message !== 'success')
	{
		document.querySelector('.popup-admin__order').classList.add('popup-admin__order--hide');
		document.querySelector('.popup-admin__close').classList.remove('popup-admin__close--hide');
	}
	else
	{
		document.querySelector('.popup-admin__order').classList.remove('popup-admin__order--hide');
		document.querySelector('.popup-admin__close').classList.add('popup-admin__close--hide');
	}
	document.querySelector('.popup-basket__title-text').innerHTML = message;

	popupAdmin.classList.add('popup-admin--open');

	//событие закрытия модального окна
	closePopupButton.addEventListener('click', () => {
		popupAdmin.classList.remove('popup-admin--open')
	});
}

//отрисовка тегов
function renderTagInput(tags)
{

	let tagArray = [];
	tags.forEach(tag => {
		tagArray.push(tag.NAME);
	});

	var input = document.querySelector('input[name="tag"]'),
		// init Tagify script on the above inputs
		tagify = new Tagify(input, {
			whitelist: tagArray,
			maxTags: 10,
			dropdown: {
				maxItems: 20,           // <- mixumum allowed rendered suggestions
				classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
				enabled: 0,             // <- show suggestions on focus
				closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
			}
		});
}

//поле каталог товаров
var input = document.querySelector('input[name=cat]');

tagifyCat = new Tagify(input, {
	mode: "select",
	whitelist: ["Processor", "Motherboard", "GPU", "RAM", "Hard Drive"],
	blacklist: ['foo', 'bar'],
	keepInvalidTags: false,   // do not auto-remove invalid tags
	dropdown: {
		// closeOnSelect: false
	}
});