let currentPage = 1;
let maxPage;
const paginationItems = document.querySelectorAll('.products__pagination-item');

paginationItems.forEach(link => {
	link.addEventListener('click', (e) => {
		//paginationItems[0].setAttribute('page',1)
		//if (e.target == paginationItems[0])

		if (currentPage === 1) {
			paginationItems[0].disabled = true;
			paginationItems[1].disabled = true;
		}
		paginationItems.forEach(allLinks => {
			allLinks.classList.remove('active');
			allLinks.classList.add('button--white')
		})
		link.classList.add('active');
		link.classList.remove('button--white');
		console.log(maxPage);
	})
})