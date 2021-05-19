const [form] = document.forms;
const [
	search_barFeedback
] = document.querySelectorAll('.feedback');

const isSearchValid = search_bar => {
	return search_bar.length > 1 && search_bar.length <= 60 && /^[A-Za-zА-ЯЁа-яё0-9 -]*$/g.test(search_bar);
}

const validation = (search_bar) => {
	return (
		isSearchValid(search_bar)
	);
}

const getElement = (name, e) => {
	return {
		search_bar(e) {
			e.target.classList.toggle('border-danger', !isSearchValid(e.target.value));
			search_barFeedback.textContent = isSearchValid(e.target.value) ? null : null ;
		}
	}[name](e);
}

const handleInput = e => {
	const { search_bar, search_bar__button } = form;
	const { name } = e.target;

	getElement(name, e);

	search_bar__button.disabled = !validation(search_bar.value);
}

document.addEventListener('DOMContentLoaded', () => {

	form.search_bar.addEventListener('input', handleInput);

});