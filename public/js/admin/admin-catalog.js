let category = 'processor';

function loadCatalog()
{
	let url = '/admin/catalog/get?category=' + category;
	fetch(url).then(function(response) {
		return response.json();
	}).then(function(json) {
		renderAdminCatalog(json);
	}).catch(function(err) {
		console.log(err);
	});
}

loadCatalog();

function renderAdminCatalog(products)
{
	document.querySelectorAll('.admin-catalog__table-inner').forEach(oldItem => {
		oldItem.remove();
	})
	let template = document.querySelector('#template');
	products.forEach(function({ ID, NAME, AMOUNT, PRICE }) {
		let clone = template.content.cloneNode(true);

		let id = clone.querySelector('.admin-catalog__product-id');
		let name = clone.querySelector('.admin-catalog__product-name');
		let cost = clone.querySelector('.admin-catalog__product-cost');
		let amount = clone.querySelector('.admin-catalog__product-amount');
		let link = clone.querySelector('.admin-catalog__product-link');

		link.dataset.index = ID;
		link.addEventListener('click', () => {
			window.localStorage.setItem('productId', ID);
			window.location.href = '/admin/main/red';
		});
		id.textContent = ID;
		name.textContent = NAME;
		cost.textContent = getBeautifulPrice(PRICE);
		amount.textContent = AMOUNT;

		template.parentNode.appendChild(clone);
	});
}

function getBeautifulPrice(price)
{
	return String(price).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' руб.';
}

const categoriesButtons = document.querySelectorAll('.admin-catalog__categories-button');

categoriesButtons.forEach(button => {
	button.addEventListener('click', ()=>{
		category = button.textContent;
		categoriesButtons.forEach(button=> {
			button.classList.add('button--white');
		})
		button.classList.remove('button--white')
		loadCatalog();
	})
});
