function bytesToSize(bytes)
{
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	if (!bytes)
	{
		return '0 Byte';
	}
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	return Math.round(bytes / Math.pow(1024, i)) + ' ' + sizes[i];
}

function upload(selector, options)
{
	let files = [];

	const input = document.querySelector(selector);
	const prevew = document.createElement('div');
	prevew.classList.add('preview');

	const open = document.createElement('btn');
	open.classList.add('btn');
	open.textContent = 'Загрузить';

	if (options.multi)
	{
		input.setAttribute('multiple', true);
	}
	if (options.accept && Array.isArray(options.accept))
	{
		input.setAttribute('accept', options.accept.join(','));
	}

	input.insertAdjacentElement('afterend', prevew);
	input.insertAdjacentElement('afterend', open);

	const triggerInput = () => input.click();

	const changeHandler = event => {
		if (!event.target.files.length)
		{
			return;
		}
		files = Array.from(event.target.files);

		files.forEach(file => {
			if (!file.type.match('image'))
			{
				return;
			}
			const reader = new FileReader();

			reader.onload = ev => {

				const src = ev.target.result;
				prevew.insertAdjacentHTML('afterbegin', `
				<div class="preview-image">
					<div class="preview-remove" data-name="${file.name}">&times</div>
					<img src="${src}" alt="${file.name}" class="upload-image" data-name="${file.name}"/>
					<div class="preview-info">
					<span>${file.name}</span>
					${bytesToSize(file.size)}
					</div>
				<div>
				`);
			};

			reader.readAsDataURL(file);

		});

	};

	const removeHandler = event => {
		console.log('event', event.target.dataset);
		if (!event.target.dataset.name)
		{
			return;
		}
		const { name } = event.target.dataset;
		files = files.filter(file => file.name !== name);

		const block = prevew.querySelector(`[data-name="${name}"]`)
			.closest('.preview-image');

		block.classList.add('removing');
		setTimeout(() => block.remove(), 100);
	};

	open.addEventListener('click', triggerInput);

	input.addEventListener('change', changeHandler);
	prevew.addEventListener('click', removeHandler);
}

upload('#file', {
	multi: true,
	accept: ['.png', '.jpg', '.jpeg']
});