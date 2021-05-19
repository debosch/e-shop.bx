let orderState = Object.create({},
	{
		status: {
			value: 'new',
			enumerable: true,
			writable: true
		}
	});

let ordersUrl = '/admin/orders/getOrders?status=' + orderState.status;

const orderButtons = document.querySelectorAll('.admin-order__button');

orderButtons.forEach(button => {
	button.addEventListener('click', () => {
		let url = '/admin/orders/getOrders?status=' + button.dataset.status;
		orderState.status = button.dataset.status;
		console.log(url);
		getOrderItems(url);
		orderButtons.forEach(button => {
			button.classList.add('button--white');
		})
		button.classList.remove('button--white');
	});
});

function renderOrders(orders)
{
	let oldOrders = document.querySelectorAll('.admin-order__item');
	oldOrders.forEach(order => {
		order.remove();
	});
	let templateOrder = document.querySelector('#template-order');
	orders.forEach(function({ ID, USERNAME, PHONE, EMAIL, ITEMS, CREATION, MODIFY = '-'}) {
		let clone = templateOrder.content.cloneNode(true);

		clone.querySelector('.admin-order__name').textContent = USERNAME;
		clone.querySelector('.admin-order__phone').textContent = PHONE;
		clone.querySelector('.admin-order__email').textContent = EMAIL;
		clone.querySelector('.admin-order__date').textContent = CREATION;
		clone.querySelector('.admin-order__date-modify').textContent = MODIFY;
		let list = clone.querySelector('.admin-order__item');
		list.dataset.id = ID
		let templateItem = clone.querySelector('#template-products');
		ITEMS.forEach(item => {
			let clone = templateItem.content.cloneNode(true);
			clone.querySelector('.admin-catalog__product-name').textContent = item.NAME;
			clone.querySelector('.admin-catalog__product-cost').textContent = Number(item.AMOUNT) * Number(item.PRICE) + ' руб.';
			templateItem.parentNode.appendChild(clone);
		});
		let button = clone.querySelector('.admin-order__submit');

		if (orderState.status !== 'completed')
		{
			button.addEventListener('click', () => {
				button.parentElement.remove();
				if (orderState.status === 'new')
				{
					orderState.status = 'processed';
				}
				else
				{
					orderState.status = 'completed';
				}

				let formData = new FormData();
				formData.append('id', ID);

				formData.append('status', orderState.status);

				fetch('/admin/orders/setOrder', {
					method: 'post',
					body: formData
				}).catch(function(err) {
					console.log(err);
				});

			});
		}
		else {
			clone.querySelector('.admin-order__submit').remove();
		}

		templateOrder.parentNode.appendChild(clone);
	});
}

function getOrderItems(ordersUrl)
{
	fetch(ordersUrl).then(function(response) {
		return response.json();
	}).then(function(json) {
		renderOrders(json);
	}).catch(function(err) {
		console.log(err);
	});
}

getOrderItems(ordersUrl);