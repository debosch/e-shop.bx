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
		formData.append('name', form.name.value);
		formData.append('price', form.cost.value);
		formData.append('amount', form.count.value);

		JSON.parse(form.tag.value).forEach(tag => {

			formData.append('tag[]', tag.value);
		});
		JSON.parse(form.cat.value).forEach(cat => {

			formData.append('category', cat.value);

		});
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
			fetch('/admin/catalog/addItem', {
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
