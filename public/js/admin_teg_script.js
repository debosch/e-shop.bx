const dropedElements = document.querySelector('#dropBtn');
const dropDownDiv = document.querySelector('#dropDownDiv');

let usedTags = [' '];

const pickOfDroped = event => {
	let interlocutor = false;

	for (var i = 0; i < usedTags.length; i++)
	{
		if (usedTags[i] === event.target.value || event.target.value === undefined)
		{
			interlocutor = false;
			break;
		}
		else
		{
			interlocutor = true;
		}
	}

	if (interlocutor === true)
	{

		const appearedTag = document.createElement('div');
		appearedTag.classList.add('appearedTags');

		appearedTag.insertAdjacentHTML('beforeend', `
			<div class="tagName">
				${event.target.value}
				<div class="removeTag" data-name="${event.target.value}"> 
				&times;
				</div>
			<div>
			`);
		dropDownDiv.insertAdjacentElement('beforeend', appearedTag);
		usedTags.push(event.target.value);
		// console.log(usedTags);
	}
};

const removeTagsFunc = event => {
	// console.log('event', event.target.dataset)
	if (!event.target.dataset.name)
	{
		return;
	}
	const { name } = event.target.dataset;
	usedTags = usedTags.filter(tag => tag !== name);

	const tagBlock = dropDownDiv.querySelector(`[data-name="${name}"]`).closest('.appearedTags');
	// tagBlock.remove()
	tagBlock.classList.add('removing');
	setTimeout(() => tagBlock.remove(), 100);

	// console.log(tagBlock)
	console.log(usedTags);

};

dropedElements.addEventListener('click', pickOfDroped);
dropDownDiv.addEventListener('click', removeTagsFunc);

// console.log(dropedElements)

const requestURL = '/admin/main/getTags';

fetch(requestURL).then(function(response) {
	return response.json();
}).then(function(json) {
	renderTags(json);
}).catch(function(err) {
	console.log(err);
});

function renderTags(tags)
{
	let templateTags = document.querySelector('.template-tag');
	tags.forEach(tag => {
		let cloneTags = templateTags.content.cloneNode(true);
		let tagLink = cloneTags.querySelector('.btn');
		tagLink.textContent = tag.NAME;
		tagLink.setAttribute('value', tag.NAME);
		templateTags.parentNode.appendChild(cloneTags);
	});
	// console.log(tags);
}

//рендер новых тегов
/*
<ul class="product__tags-list">
	<template class="template-tag">
		<li class="product__tag-item">
			<a href="" class="product__tag-link button"></a>
		</li>
	</template>
</ul>*/

// let div = document.createElement('div');
// div.innerHTML = "<div class=\"chip\" id=\"chip\">" +
// 	"<span class=\"addbtn\" onclick=\"\">&plus;</span>" +
// 	"</div>";
// chip.after(div);

// const dropBtn = document.querySelector('#dropdownMenuButton')
//
// console.log(dropBtn);
//
// const tags = document.createElement('btn');
// tags.classList.add('chip');
// tags.innerHTML = '&#10010';
// chip.after(tags)
//
// const triggerDrop = () => dropBtn.click()
//
// tags.addEventListener('click', triggerDrop)

