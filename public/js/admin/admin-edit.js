let editUrl = '/admin/catalog/getItem?id=' + window.localStorage.getItem('productId');

fetch(editUrl).then(function(response) {
	return response.json();
}).then(function(json) {
	renderAdminProduct(json);
}).catch(function(err) {
	console.log(err);
});

function renderAdminProduct({ ID, NAME, PRICE, AMOUNT, SHORT_DESCRIPTION, LONG_DESCRIPTION, CATEGORY, TAG , IMAGE})
{
	document.querySelector('#name').value = NAME;
	document.querySelector('#name').dataset.id = ID;
	document.querySelector('#cost').value = Math.round(PRICE);
	document.querySelector('#count').value = AMOUNT;

/*	document.querySelector('#cat').value = CATEGORY;
	console.log(CATEGORY);*/

	TAG.forEach(tag => {
		document.querySelector('#tag').value += ' '+tag.tag +',';
	});

	document.querySelector('#cinfo').value = SHORT_DESCRIPTION;
	document.querySelector('#info').value = LONG_DESCRIPTION;
	IMAGE.forEach(image =>{
		var picCreate = $("<div class='upload__item'><img src='" + 'data:image/jpeg;base64,'+image + "'" + " class='upload__img' data-name='image'/><a class='upload__del'></a></div>");
		picCreate.insertBefore(document.querySelector('.upload__btn'));
	})

	const cat = document.querySelector('#cat');
	cat.querySelectorAll('option').forEach(option => {
		if (option.value === CATEGORY)
		{
			option.setAttribute("selected", "selected");
		}
	});
}

document.addEventListener('DOMContentLoaded', () => {
	const requestURL = '/admin/main/getTags';

	fetch(requestURL).then(function(response) {
		return response.json();
	}).then(function(json) {
		renderTagInput(json);
	}).catch(function(err) {
		console.log(err);
	});

	form.name.addEventListener('input', handleInput);
	form.cost.addEventListener('input', handleInput);
	form.count.addEventListener('input', handleInput);
	form.cinfo.addEventListener('input', handleInput);

	form.addEventListener('submit', e => {
		e.preventDefault();
		document.querySelector('.admin-add__form-button').disabled = true;
		let formData = new FormData();
		formData.append('id', form.name.dataset.id);
		formData.append('name', form.name.value);
		formData.append('price', form.cost.value);
		formData.append('amount', form.count.value);

		JSON.parse(form.tag.value).forEach(tag => {

			formData.append('tag[]', tag.value);
		})
		JSON.parse(form.cat.value).forEach(cat => {

			formData.append('category', cat.value);

		})
		formData.append('sd', form.cinfo.value);
		formData.append('ld', form.info.value);
		const itemContainer = document.querySelectorAll('.upload__item');
		itemContainer.forEach(item => {
			images.push(item.querySelector('img').src);
			fetch(item.querySelector('img').src)
				.then(res => res.blob())
				.then(blob => {
					const file = new File([blob], 'dot.png', blob)
					formData.append('file[]', file);
				})
		})


		setTimeout(sendRequestWithImages, 1000);
		function sendRequestWithImages() {
			fetch('/admin/catalog/updateItem', {
				method: 'post',
				body: formData
			}).then(function(response) {
				response.text().then(function(data) {
					console.log(data);
					showResponse(data);
				});
			}).then(()=>{
				document.querySelector('.admin-add__form-button').disabled = false;
			}).catch(function(err) {
				console.log(err);
			});
		}
	});

});
