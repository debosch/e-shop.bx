const [form] = document.forms;
const [
	order__nameFeedback,
	order__emailFeedback,
	order__phoneFeedback
] = document.querySelectorAll('.feedback');

const isNameValid = order__name => {
	return order__name.length > 3 && order__name.length <= 60 && /^[А-ЯA-Z][а-яa-zА-ЯA-Z\-]*\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]+(\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]+)?$/.test(order__name);
}

const isEmailValid = order__email => {
	return /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g.test(order__email);
}

const isPhoneValid = order__phone => {
	return /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(order__phone);
}

const validation = ( order__name, order__email, order__phone) => {
	return (
		isNameValid(order__name) &&
		isEmailValid(order__email) &&
		isPhoneValid(order__phone)
	);
}

const getElement = (name, e) => {
	return {
		order__name(e) {
			e.target.classList.toggle('border-danger', !isNameValid(e.target.value));
			order__nameFeedback.textContent = isNameValid(e.target.value) ? null : 'Введите корректные Ф.И.О. (Каждое слово с большой буквы)';
		},
		order__email(e) {
			e.target.classList.toggle('border-danger', !isEmailValid(e.target.value));
			order__emailFeedback.textContent = isEmailValid(e.target.value) ? null : 'Введен неверный email';
		},
		order__phone(e) {
			e.target.classList.toggle('border-danger', !isPhoneValid(e.target.value));
			order__phoneFeedback.textContent = isPhoneValid(e.target.value) ? null : 'Введен неверный телефон';
		}
	}[name](e);
}

const handleInput = e => {
	const { order__name, order__email, order__phone, button__submit } = form;
	const { name } = e.target;

	getElement(name, e);

	button__submit.disabled = !validation( order__name.value, order__email.value, order__phone.value);
}

document.addEventListener('DOMContentLoaded', () => {

	form.order__name.addEventListener('input', handleInput);

	form.order__email.addEventListener('input', handleInput);

	form.order__phone.addEventListener('input', handleInput);

});