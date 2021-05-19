const [form] = document.forms;
const [
	loginFeedback,
	passwordFeedback,
	confirmPasswordFeedback
] = document.querySelectorAll('.feedback');

const isLoginValid = login => {
	return login.length > 3 && login.length <= 20 && /^[A-Za-z0-9]*$/g.test(login);
}

const isPasswordValid = password => {
	return /^((?=.*[\d])(?=.*[a-z])(?=.*[A-Z])|(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\d\s])|(?=.*[\d])(?=.*[A-Z])(?=.*[^\w\d\s])|(?=.*[\d])(?=.*[a-z])(?=.*[^\w\d\s])).{7,30}$/gm.test(password);
}

const isPasswordMatch = (password, confirmPassword) => {
	return !!confirmPassword && password === confirmPassword;
}

const validation = (login, password, confirmPassword) => {
	return (
		isLoginValid(login) &&
		isPasswordValid(password) &&
		isPasswordMatch(password, confirmPassword)
	);
}

const toggleShowPassword = (toggler, elements) => {
	toggler.addEventListener('change', e => {
		elements.forEach(element => {
			element.setAttribute('type', e.target.checked ? 'text' : 'password');
		});
	});
};

const getElement = (name, e) => {
	return {
		login(e) {
			e.target.classList.toggle('border-danger', !isLoginValid(e.target.value));
			loginFeedback.textContent = isLoginValid(e.target.value) ? null : 'Логин должен быть от 3 до 20 символов и содержать только латинские буквы и цифры';
		},
		password(e) {
			e.target.classList.toggle('border-danger', !isPasswordValid(e.target.value));
			passwordFeedback.textContent = isPasswordValid(e.target.value) ? null : 'Пароль должен быть длиной хотя бы 7 символов и содержать хотя бы 1 большую букву и 1 цифру';

			form.confirmPassword.classList.toggle('border-danger', !isPasswordMatch(e.target.value, form.confirmPassword.value));
			confirmPasswordFeedback.textContent = isPasswordMatch(e.target.value, form.confirmPassword.value) ? null : 'Пароли не совпадают';
		},
		confirmPassword(e) {
			e.target.classList.toggle('border-danger', !isPasswordMatch(form.password.value, e.target.value));
			confirmPasswordFeedback.textContent = isPasswordMatch(form.password.value, e.target.value) ? null : 'Пароли не совпадают';
		}
	}[name](e);
}

const handleInput = e => {
	const { login, password, confirmPassword, btn } = form;
	const { name } = e.target;

	getElement(name, e);

	btn.disabled = !validation(login.value, password.value, confirmPassword.value);
}

document.addEventListener('DOMContentLoaded', () => {
	toggleShowPassword(form.showPassword, [form.password, form.confirmPassword]);

	form.login.addEventListener('input', handleInput);

	form.password.addEventListener('input', handleInput);

	form.confirmPassword.addEventListener('input', handleInput);

});