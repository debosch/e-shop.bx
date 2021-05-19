let searchButton = document.getElementById('search_bar__button');
let searchBar = document.getElementById('search_bar');

searchButton.addEventListener('click', function()
{
    let searchValue = searchBar.value.trim();
    if (searchValue.length > 0)
    {
        window.localStorage.setItem('search', searchValue);
        redirectToCatalog();
    }
})