let countText = document.querySelector('.basket__header-count-text');
let basketItemsCounter = document.querySelector('.header-menu__basket-counter');
let clearBasketButton = document.querySelector('.basket__header__clear');
let basketItemsList = document.querySelector('tbody');
let totalPriceText = document.querySelector('.basket__aside-price');
let totalPrice = 0;

db.basketItems.toArray().then(function(items)
{
    dbUpdateAmount(items);
    initBasket(items);
    updateCounters(items.length);
    updateTotalPrice();
})

clearBasketButton.addEventListener('click', function()
{
    clearBasket();
});

redirectToCatalogButtons();

function initBasket(itemsData)
{
    let template = document.querySelector('#template');
    itemsData.forEach(function(item)
    {
        let clone = template.content.cloneNode(true);
        let name = clone.querySelector('.basket__item-info-name-link').querySelector('span');
        let img = clone.querySelector('.basket__item-image-link').querySelector('img');
        let price = clone.querySelector('.basket__item-price__current-text');
        let amount = clone.querySelector('.basket__item-amount-quantity');
        let amountInStorage = clone.querySelector('.basket__item-info-amount').querySelector('span');
        let total = clone.querySelector('.basket__item-total-text');
        let minusButton = clone.querySelector('.basket__item-amount-minus');
        let plusButton = clone.querySelector('.basket__item-amount-plus');
        let itemAvailability = clone.querySelector('.basket__item-info-unavailable');
        let row = document.createElement('tr');

        row.dataset.id = item.id;
        row.classList.add('basket__item');

        itemAvailability.style.display = 'none';

        clone.querySelector('.basket__item-remove-button').addEventListener('click', function()
        {
            deleteItem(row);
        });

        minusButton.addEventListener('click', function()
        {
            let value = parseInt(amount.value.toString());
            if (value > 1)
            {
                value--;
                amount.setAttribute('value', value);
                total.innerHTML = getBeautifulPrice(value * parsePrice(price.innerHTML));
                itemAvailability.style.display = 'none';
                updateTotalPrice();
                dbUpdateValue(item.id, value);
            }
        });

        plusButton.addEventListener('click', function()
        {
            let value = parseInt(amount.value.toString());

            if (value++ < parseInt(item.totalAmount))
            {
                amount.setAttribute('value', value);
                total.innerHTML = getBeautifulPrice(value * parsePrice(price.innerHTML));
                updateTotalPrice();
                dbUpdateValue(item.id, value);
            }
            else
            {
                itemAvailability.style.display = 'block';
                setTimeout(disableAvailabilityText, 2500, itemAvailability);
            }
        })

        img.setAttribute('src', item.img);
        amount.setAttribute('value', item.amount);

        amountInStorage.innerHTML = item.totalAmount;
        name.innerHTML = item.name;
        price.innerHTML = item.price;
        total.innerHTML = getBeautifulPrice(parsePrice(item.price) * item.amount);

        row.appendChild(clone);
        template.parentNode.appendChild(row);
    })

    template.remove();
}

function updateCounters(count)
{
    countText.innerHTML = 'КОЛИЧЕСТВО ТОВАРОВ: ' + count;
    basketItemsCounter.innerHTML = count.toString();
}

function clearBasket()
{
    let childNodes = basketItemsList.children;
    for (let i = 0; i < childNodes.length; i++)
    {
        deleteItem(childNodes[i]);
    }
    updateTotalPrice();
}

function parsePrice(price)
{
    let slicedPrice = price.slice(0, price.length - 5)
    return parseInt(slicedPrice.replace(/\s/g, ''));
}

function updateTotalPrice()
{
    let items = basketItemsList.querySelectorAll('.basket__item-total-text');
    let localPrice = 0;
    items.forEach(function(item)
    {
        localPrice += parsePrice(item.innerHTML);
    })

    totalPrice = localPrice;
    totalPriceText.innerHTML = getBeautifulPrice(totalPrice);
}