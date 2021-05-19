const submit = 'button__submit';
const sendOrderURL = '/main/sendOrderFromBasket';
let cartItemsList = document.querySelector('tbody');
let popupReady = document.querySelector('.js-popup-response');
let closeReady = document.querySelector('.js-popup-response__close');
let body = {};

closeReady.addEventListener('click', function() {
    popupReady.classList.remove('popup-response--open');
});

document.getElementById(submit).onclick = function(e) {
	e.preventDefault();
    db.basketItems.toArray().then(function(items) {
        dbUpdateAmount(items);

        //Валидация полей

        if (verifyAmount(items) === true)
        {
            body =
                {
                    username: document.getElementById('order__name').value,
                    email: document.getElementById('order__email').value,
                    phone: document.getElementById('order__phone').value,
                    items: getOrderData()
                };

            sendRequest('POST', sendOrderURL, 'json', body)
                .then(function()
                {
                    popupReady.classList.add('popup-response--open');
                    clearBasket();
                })
                .catch(err => alert('Oooops ' + err));
        }
    });
};

function verifyAmount(items)
{
    let nodes = cartItemsList.children;
    let notEqualCounter = 0;
    for (let i = 0; i < items.length; i++)
    {
        let amount = parseInt(nodes[i].querySelector('.basket__item-amount-quantity').value);
        if (amount > parseInt(items[i]['totalAmount']))
        {
            updateCard(items[i].id, nodes[i]);
            notEqualCounter++;
        }
    }

    return notEqualCounter === 0;
}

function getOrderData()
{
    let itemsObj = {};
    let nodes = cartItemsList.children;
    for (let i = 0; i < nodes.length; i++)
    {
        let id = nodes[i].dataset.id;
        itemsObj[id] = nodes[i].querySelector('.basket__item-amount-quantity').value;
    }
    return itemsObj;
}