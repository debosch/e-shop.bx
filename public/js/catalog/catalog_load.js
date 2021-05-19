function sideButtons()
{
    let buttons = document.querySelectorAll('.js-get');
    buttons.forEach(function(button)
        {
            button.addEventListener('click', function()
            {
                let category = button.dataset.id;
				window.localStorage.setItem('category', category);
                let categoryName = button.querySelector('.nav-list__item__text').innerHTML;

                window.localStorage.setItem('category', category);
                window.localStorage.setItem('categoryName', categoryName);

               let url = '/catalog/get?category=' + category;
					sendRequest('GET', url)
                    .then(function(items)
                    {
                        clearCatalog();
                        document.querySelector('.products__title').innerHTML = categoryName;
                        initializeCatalog(JSON.parse(items));
                    })
            })
        })
}

function loadCatalog(filter='', sort='',page = '')
{
    let searchQuery = window.localStorage.getItem('search');
    let category = window.localStorage.getItem('category');

    if (searchQuery !== '')
    {
        let url = '/catalog/search?item=' + encodeURIComponent(searchQuery);
        window.localStorage.setItem('search', '');

        sendRequest('GET', url)
            .then(function(items)
            {
                let itemsArr = JSON.parse(String(items));
                document.querySelector('.products__title').innerHTML = 'Найдено ' + itemsArr.length + ' результатов'
                        + ' по запросу "' + searchQuery + '"' + ':';

                clearCatalog();
                initializeCatalog(itemsArr);
            })
    }
    else if (category !== '')
    {
        document.querySelector('.products__title').innerHTML = window.localStorage.getItem('categoryName');

        let category = window.localStorage.getItem('category');
        let url = '/catalog/get?category=' + category + filter + sort + '&p=1';
        sendRequest('GET', url)
            .then(function(items)
            {
                clearCatalog();
                initializeCatalog(JSON.parse(String(items)));
            })
    }
}

loadCatalog();
sideButtons();
